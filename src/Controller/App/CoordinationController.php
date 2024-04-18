<?php

namespace App\Controller\App;

use App\Entity\Coordination;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route("/app")]
class CoordinationController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $manager,
        private RequestStack $requestStack
    )
    {
    }

    #[Route('/liste-coordination', name: 'list_coordination')]
    public function list_coordination(): Response
    {       
        $request = $this->requestStack->getCurrentRequest();
        if ($request->isMethod('POST')) {
            $data           = $request->request->all();
            $deleteMode     = $data['deleteMode'] ?? null;

            if ($deleteMode == "delete"){
                $coordinationIdToDelete = $data['coordinationIdToDelete'];
                $coordination = $this->manager->getRepository(Coordination::class)->find($coordinationIdToDelete);
                $coordination->setDeletedBy($this->getUser());
                $message = 'La coordination <strong>' . $coordination->getNom() . '</strong> à été supprimée avec succès.';
            }else{
                $mode           = $data["mode"];
                $nom            = $data["nom"];
                $localite       = $data["localite"];
                $president      = $data["president"];
                $nombreMembre   = $data["nombreMembre"];
                $coordinationId = $data["coordinationId"];

                if ($nom == "" || $nom == null) {
                    $errors .= '<li>le nom doit être renseigné</li>';
                }
                if ($localite == "" || $localite == null) {
                    $errors .= '<li>la localité doit être renseigné</li>';
                }
                if ($president == "" || $president == null) {
                    $errors .= '<li>le nom du president de la coordination $nom doit être renseigné</li>';
                }
                if ($errors != null) {
                    $this->addFlash('danger', 'Impossible de continuer car les erreurs suivantes sont survenues: ' . $errors);
                    return $this->redirectToRoute($request->attributes->get('_route'));
                }
                
                $coordinationExiste = $this->manager->getRepository(Coordination::class)->findOneBy(["nom" => $nom, "localite" => $localite]);
                if ($mode == "add" && $coordinationId == null){
                    if ($coordinationExiste){
                        $this->addFlash('warning', "La coordination <strong>$nom</strong> est déjà enregistrée");
                        return $this->redirectToRoute('list_coordination');
                    }
                    
                    $coordination = new Coordination();
                    $coordination->setCreatedBy($this->getUser());
                    $message = "La coordination <strong>$nom</strong> à été sauvegardée avec succès.";
                }elseif($mode == "edit" && $coordinationId != null) {
                    $coordination = $this->manager->getRepository(Coordination::class)->find($coordinationId);
                    $coordination->setUpdatedBy($this->getUser());
                    $message = "La coordination <strong>$nom</strong> à été mise à jours avec succès.";
                }
                $coordination->setNom($nom)
                    ->setLocalite($localite)
                    ->setPresident($president)
                    ->setNombreMembre($nombreMembre);
            }
            
            try {
                $manager->flush();
                $this->addFlash("success", $message);
            } catch(\Exception $e) {
                $this->addFlash('danger', $e->getMessage());
            }
        }
        return $this->render('app/coordination/list.html.twig');
    }
}
