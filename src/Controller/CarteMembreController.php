<?php

namespace App\Controller;

use App\Entity\CarteMembre;
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
            $phone = $data["phone"];
            $lieuNaissance = $data["lieuNaissance"];
            $niveauEtude = $data["niveauEtude"];
            $genre = $data["genre"];

            $errors = null;
            if ($nom == "" || $nom == null) {
                $errors .= '<li>le nom doit être renseigné</li>';
            }
           
            if ($errors != null) {
                $this->addFlash('danger', 'Impossible de continuer car les erreurs suivantes sont survenues: ' . $errors);
                return $this->redirectToRoute($request->attributes->get('_route'));
            }


            $contact = new CarteMembre();
            $contact->setNom($nom);
            $contact->setPrenom($prenom);
            $contact->setGenre($genre);
            $contact->setNiveauEtude($niveauEtude);
            $contact->setLieuNaissance($lieuNaissance);
            $contact->setPhone($phone);
            $manager->persist($contact);

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
