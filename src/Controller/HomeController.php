<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app')]
    public function home(): Response
    {
        if($this->getUser()) {
            return $this->redirectToRoute('app_home');
        }
        return $this->render('base.html.twig');
    }

    #[Route('/home', name: 'app_home')]
    public function homeAfterConnection(): Response
    {
        return $this->render('home.html.twig');
    }
}
