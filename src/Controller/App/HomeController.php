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
        return $this->render('app/base.html.twig');
    }
}