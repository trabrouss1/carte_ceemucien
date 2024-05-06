<?php

namespace App\Controller\Site;

use App\Entity\Coordination;
use App\Entity\Seminaire;
use App\Entity\Seminariste;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SeminaireController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $manager,
        private RequestStack $requestStack
    )
    {
    }
    #[Route('/seminaire-national', name: 'seminaire_national')]
    public function seminaire_national(): Response
    {
        $request = $this->requestStack->getCurrentRequest();
        if ($request->isMethod('POST')) {
            $data = $request->request->all();
//            dd($data);
            $typeSeminaire = $this->manager->getRepository(Seminaire::class)->find($data['typeSeminaire']);
            $nom = $data['nom'];
            $pnom = $data['pnom'];
            $dateNaissance = new \DateTime($data["dateNaissance"]);
            $lieuNaissance = $data['lieuNaissance'];
            $contact = $data['contact'];
            $genre = $data['genre'];
            $niveauEtude = $data['niveauEtude'];
            $coordination = $this->manager->getRepository(Coordination::class)->find($data['coordination']);
            $section = $data['section'];
            $djinn = $data['djinn'];
            $ulcere = $data['ulcere'];
            $tuberculose = $data['tuberculose'];
            $asthme = $data['asthme'];
            $grossesse = $data['grossesse'];
            $diabete = $data['diabete'];
            $autreMaladie = $data['autreMaladie'];
            $remedeMaladie = $data['remedeMaladie'];
            $nomParent = $data['nomParent'];
            $contactParent = $data['contactParent'];

            $errors = null;
            if ($nom == "" || $nom == null) {
                $errors .= '<li>le nom doit être renseigné</li>';
            }
            if ($pnom == "" || $pnom == null) {
                $errors .= '<li>le prénom doit être renseigné</li>';
            }
            if ($dateNaissance == "" || $dateNaissance == null) {
                $errors .= '<li>la date de naissance doit être renseignée</li>';
            }
            if ($lieuNaissance == "" || $lieuNaissance == null) {
                $errors .= '<li>le lieu de naissance doit être renseigné</li>';
            }
            if ($djinn == "" || $djinn == null) {
                $errors .= '<li>as-tu djinn</li>';
            }
            if ($ulcere == "" || $ulcere == null) {
                $errors .= '<li>as-tu l\'ulcère</li>';
            }
            if ($tuberculose == "" || $tuberculose == null) {
                $errors .= '<li>as-tu la tuberculose</li>';
            }
            if ($asthme == "" || $asthme == null) {
                $errors .= '<li>as-tu l\'asthme</li>';
            }
            if ($grossesse == "" || $grossesse == null) {
                $errors .= '<li>as-tu enciente</li>';
            }
            if ($diabete == "" || $diabete == null) {
                $errors .= '<li>as-tu le diabete</li>';
            }
            if ($nomParent == "" || $nomParent == null) {
                $errors .= '<li>le nom et prénom du parent doivent être renseignés </li>';
            }
            if ($contactParent == "" || $contactParent == null) {
                $errors .= '<li>le contact du parent doit être renseigné</li>';
            }
            if ($errors != null) {
                $this->addFlash('danger', 'Impossible de continuer car les erreurs suivantes sont survenues: ' . $errors);
                return $this->redirectToRoute($request->attributes->get('_route'));
            }

            $seminariste = new Seminariste();
            $seminariste->setNom($nom)
                        ->setPnom($pnom)
                        ->setContact($contact)
                        ->setCoordination($coordination)
                        ->setNiveau($niveauEtude)
                        ->setSection($section)
                        ->setDateNaissance($dateNaissance)
                        ->setLieuNaissance($lieuNaissance)
                        ->setSeminaire($typeSeminaire)
                        ->setAsthme($this->isTrue($asthme))
                        ->setDjinn($this->isTrue($djinn))
                        ->setTuberculose($this->isTrue($tuberculose))
                        ->setUlcere($this->isTrue($ulcere))
                        ->setDiabète($this->isTrue($diabete))
                        ->setGrossesse($this->isTrue($grossesse))
                        ->setAutreMalidie($autreMaladie)
                        ->setRemedeAutreMalidie($remedeMaladie)
                        ->setNomPrenomParent($nomParent)
                        ->setContact($contactParent)
                        ->setCreatedBy($this->getUser());
            $this->manager->persist($seminariste);


            try {
                $manager->flush();
                $this->addFlash("success", "Booooooooonnnnnnn");
            } catch(\Exception $e) {
                $this->addFlash('danger', $e->getMessage());
            }
        }
        $coordinations = $this->manager->getRepository(Coordination::class)->findAll();
        $seminaires = $this->manager->getRepository(Seminaire::class)->findBy(['active' => true]);
        return $this->render('site/seminaire/inscription.html.twig', compact('coordinations','seminaires'));
    }

    public function isTrue(bool $bool)
    {
        return $bool == 1 ? true : false;
    }
}
