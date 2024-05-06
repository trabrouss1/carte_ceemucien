<?php

namespace App\Controller;

use App\Entity\Coordination;
use App\Entity\Membre;
use App\Entity\Niveau;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CarteMembreController extends AbstractController
{
    #[Route('/carte-membre', name: 'carte_membre', methods: ['GET', 'POST'])]
    public function carteMembre(Request $request, EntityManagerInterface $manager): Response
    {
        if ($request->isMethod('POST')) {
            $data             = $request->request->all();
            $nom              = $data["nom"];
            $prenom           = $data["prenom"];
            $contact          = $data["contact"];
            $fonction         = $data["fonction"];
            $contactCasUrgent = $data["contactCasUrgent"];
            $dateNaissance    = new \DateTime($data["dateNaissance"]);
            $lieuNaissance    = $data["lieuNaissance"];
            $niveau           = $data["niveau"];
            $qualite          = $data["qualite"];
            $villeActuelle    = $data["villeActuelle"];
            $coordination     = $data["coordination"];
            $genre            = $data["genre"];

            $errors = null;
            if ($nom == "" || $nom == null) {
                $errors .= '<li>le nom doit être renseigné</li>';
            }
            if ($prenom == "" || $prenom == null) {
                $errors .= '<li>le prenom doit être renseigné</li>';
            }
            if ($contact == "" || $contact == null) {
                $errors .= '<li>le contact doit être renseigné</li>';
            }
            if ($coordination == "" || $coordination == null) {
                $errors .= '<li>la coordination doit être renseignée</li>';
            }
            if ($niveau == "" || $niveau == null) {
                $errors .= '<li>le niveau doit être renseigné</li>';
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
            $carteMembre->setCoordination($manager->getRepository(Coordination::class)->find($coordination));
            $carteMembre->setNiveau($manager->getRepository(Niveau::class)->find($niveau));
            $carteMembre->setQualite($qualite);
//            $carteMembre->setMatricule($matricule);
            $carteMembre->setLieuNaissance($lieuNaissance);
            $carteMembre->setDateNaissance($dateNaissance);
            $carteMembre->setContact($contact);
            $carteMembre->setContactCasUrgent($contactCasUrgent);
            $manager->persist($carteMembre);

            try {
                $manager->flush();
                $this->addFlash("success", "Vos informations ont bien été pris en compte. Votre carte sera disponible dans les jours avenir.");
            } catch(\Exception $e) {
                $this->addFlash('danger', $e->getMessage());
            }
            $this->redirectToRoute($request->attributes->get('_route'));
        }

        $coordinations = $manager->getRepository(Coordination::class)->findAll();
        $niveaux       = $manager->getRepository(Niveau::class)->findAll();
        return $this->render('carte-membre.html.twig', compact('coordinations', 'niveaux'));
    }
}
