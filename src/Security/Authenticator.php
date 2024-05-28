<?php

namespace App\Security;

use App\Repository\AnneeRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\RememberMeBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\SecurityRequestAttributes;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class Authenticator extends AbstractLoginFormAuthenticator
{
    use TargetPathTrait;

    public const LOGIN_ROUTE = 'app_login';

    public function __construct(
        private UrlGeneratorInterface $urlGenerator,
        private UserRepository $userRepository,
        private EntityManagerInterface $manager,
        private AnneeRepository $anneeRepository,
        private RequestStack $requestStack
    )
    {
    }

    public function authenticate(Request $request): Passport
    {
        $username = $request->getPayload()->getString('username');

        $request->getSession()->set(SecurityRequestAttributes::LAST_USERNAME, $username);

        return new Passport(
            new UserBadge($username, function ($userIdentifier) {
                $user = $this->userRepository->findOneByUsername($userIdentifier);
                if (!$user) {
                    throw new CustomUserMessageAuthenticationException(sprintf('Nom d\'utilisateur et/ou mot de passe incorrect.'));
                }

                if ($user && !$user->isActive()) {
                    throw new CustomUserMessageAuthenticationException(sprintf('Votre compte est désactivé.'));
                }

                $this->manager->flush();
                return $user;
            }),
            new PasswordCredentials($request->getPayload()->getString('password')),
            [
                new CsrfTokenBadge('authenticate', $request->getPayload()->getString('_csrf_token')),
                new RememberMeBadge(),
            ]
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
            return new RedirectResponse($targetPath);
        }

        $annee = $this->anneeRepository->findOneByAchevee(false);
//        dd($annee);
        $this->requestStack->getSession()->set('currentAnnee', [
            "anneeId" => $annee->getId(),
            "libelleAnnee" => $annee->getLibelle(),
        ]);

        $token->getUser()->setLastConnection(new \DateTime());

        $this->manager->flush();

        // For example:
         return new RedirectResponse($this->urlGenerator->generate('home_connection'));
//        throw new \Exception('TODO: provide a valid redirect inside '.__FILE__);
    }

    protected function getLoginUrl(Request $request): string
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }
}
