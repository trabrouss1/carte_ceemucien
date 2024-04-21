<?php

namespace App\Controller;

use App\Entity\Membre;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CarteMembreController extends AbstractController
{
    #[Route('/carte-membre', name: 'carte-membre', methods: ['GET', 'POST'])]
    public function carteMembre(Request $request, EntityManagerInterface $manager): Response
    {
        if ($request->isMethod('POST')) {
            $data = $request->request->all();
            $nom = $data["nom"];
            $prenom = $data["prenom"];
            $contact = $data["contact"];
            $contactCasUrgent = $data["contactCasUrgent"];
            $dateNaissance = $data["dateNaissance"];
            $lieuNaissance = $data["lieuNaissance"];
            $niveau = $data["niveau"];
            $matricule = $data["matricule"];
            $qualite = $data["qualite"];
            $villeActuelle = $data["villeActuelle"];
            $coordination = $data["coordination"];
            $photo = $data["photo"];
            $genre = $data["genre"];

            $errors = null;
            if ($nom == "" || $nom == null) {
                $errors .= '<li>le nom doit être renseigné</li>';
            }
           
            if ($errors != null) {
                $this->addFlash('danger', 'Impossible de continuer car les erreurs suivantes sont survenues: ' . $errors);
                return $this->redirectToRoute($request->attributes->get('_route'));
            }


            $carteMembre = new Membre();
            $carteMembre->setNom($nom);
            $carteMembre->setPrenom($prenom);
            $carteMembre->setGenre($genre);
            $carteMembre->setVilleActuelle($villeActuelle);
            $carteMembre->setPhoto($photo);
            $carteMembre->setCoordination($coordination);
            $carteMembre->setQualite($qualite);
            $carteMembre->setMatricule($matricule);
            $carteMembre->setLieuNaissance($lieuNaissance);
            $carteMembre->setDateNaissance($dateNaissance);
            $carteMembre->setContact($contact);
            $carteMembre->setContactCasUrgent($contactCasUrgent);
            $manager->persist($carteMembre);

            try {
                $manager->flush();
                $this->addFlash("success", "Votre message a bien été envoyé");
            } catch(\Exception $e) {
                $this->addFlash('danger', $e->getMessage());
            }
            $this->redirectToRoute($request->attributes->get('_route'));
        }
        return $this->render('carte-membre.html.twig');
    }
}
