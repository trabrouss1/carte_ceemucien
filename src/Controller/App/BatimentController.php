<?php

namespace App\Controller\App;

use App\Entity\Batiment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route("/app/batiment")]
class BatimentController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $manager,
        private RequestStack $request
    )
    {
    }

    #[Route('/liste', name: 'list_batiment')]
    public function list_batiment(): Response
    {
        $request = $this->request->getCurrentRequest();
        if ($request->isMethod('POST')) {
            $data   = $request->request->all();
            $nom    = $data["nom"];
            $genre  = $data["genre"];

            $errors = '';
            if ($nom == '') {
                $errors .= 'Le nom est obligatoire';
            }
            if ($genre == '') {
                $errors .= 'Le genre est obligatoire';
            }
            if ($errors != '') {
                $this->addFlash('error', $errors);
                return $this->redirectToRoute('list_batiment');
            }

            $this->manager->getRepository(Batiment::class)->addBatiment($nom, $genre);
            try {
                $this->manager->flush();
                $this->addFlash('success', 'Le batiment a bien été ajouté');
            } catch (\Exception $e) {
                $this->addFlash('error', $e->getMessage());
            }
            return $this->redirectToRoute('list_batiment');
        }
        $batiments = $this->manager->getRepository(Batiment::class)->findAll();
        return $this->render('app/batiment/list_batiment.html.twig', compact('batiments'));
    }
}