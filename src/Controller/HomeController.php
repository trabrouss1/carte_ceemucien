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
        if ($this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('admin_index');
        } elseif ($this->isGranted('ROLE_INSCRIPTION_SEMINARISTE')) {
            return $this->redirectToRoute('seminaire_national');
        }
        return $this->render('home.html.twig');
    }
}
