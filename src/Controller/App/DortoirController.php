<?php

namespace App\Controller\App;

use App\Entity\Batiment;
use App\Entity\Dortoirs;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route("/app/dortoir")]
class DortoirController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $manager,
        private RequestStack $request
    )
    {
    }

    #[Route('/liste', name: 'list_dortoir')]
    public function list_dortoir(): Response
    {
        $request = $this->request->getCurrentRequest();

        if ($request->isMethod('POST')) {
            $data   = $request->request->all();
            $nom    = $data["nom"];
            $batiment  = $this->manager->getRepository(Batiment::class)->find($data["batiment"]);
            $nbPlace  = $data["nbPlace"];
//            dd($data);

            $errors = '';
            if ($nom == '') {
                $errors .= 'Le nom est obligatoire';
            }
            if ($batiment == '') {
                $errors .= 'Le batiment est obligatoire';
            }
            if ($errors != '') {
                $this->addFlash('error', $errors);
                return $this->redirectToRoute('list_dortoir');
            }

            $dortoir = new Dortoirs();
            $dortoir->setGenre($batiment->getGenre())
                ->setBatiment($batiment)
                ->setLibelle($nom)
                ->setPlaceDisponible($nbPlace)
                ->setNombreDePlaces($nbPlace);
            $this->manager->persist($dortoir);

            try {
                $this->manager->flush();
                $this->addFlash('success', 'Le dortoir a bien été ajouté');
            } catch (\Exception $e) {
                $this->addFlash('error', $e->getMessage());
            }
            return $this->redirectToRoute('list_dortoir');
        }
        $dortoirs = $this->manager->getRepository(Dortoirs::class)->findAll();
        $batiments = $this->manager->getRepository(Batiment::class)->findAll();
        return $this->render('app/dortoir/list_dortoir.html.twig', compact('dortoirs', 'batiments'));
    }
}