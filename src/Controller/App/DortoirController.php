<?php

namespace App\Controller\App;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route("/app/dortoir")]
class DortoirController extends AbstractController
{

    #[Route('/liste', name: 'list_dortoir')]
    public function list_dortoir(): Response
    {
        return $this->render('app/dortoir/list_dortoir.html.twig');
    }
}