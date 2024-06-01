<?php

namespace App\Controller\App;

use App\Entity\Classe;
use App\Entity\EcheanceVersement;
use App\Entity\EventCalendar;
use App\Entity\Expense;
use App\Entity\Inscription;
use App\Entity\Interned;
use App\Entity\Matiere;
use App\Entity\PaymentTransport;
use App\Entity\Seminariste;
use App\Entity\User;
use App\Service\CheckSubscriptionService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    public function __construct(
        private RequestStack $requestStack,
        private EntityManagerInterface $manager,
        public ?int $currentAnneeId = null,
    ) {
        $this->currentAnneeId       = $requestStack->getSession()->get('currentAnnee')['anneeId'];
    }

    #[Route('/admin-home', name: 'admin_index')]
    public function admin_index()
    {
        $nombreSeminariste = $this->manager->getRepository(Seminariste::class)->count(['deletedAt' => null]);
//        dd($nombreSeminariste);
        return $this->render('app/base.html.twig', compact('nombreSeminariste'));
    }
}