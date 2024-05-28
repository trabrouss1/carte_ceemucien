<?php

namespace App\Controller\App;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route("/app")]
class HomeController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $manager,
        private RequestStack $requestStack
    )
    {
    }

    #[Route('/home', name: 'home_connection')]
    public function homeAfterConnection(): Response
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('admin_index');
        } elseif ($this->isGranted('ROLE_INSCRIPTION_SEMINARISTE')) {
            return $this->redirectToRoute('seminaire_national');
        }
        return $this->render('home.html.twig');
    }
}