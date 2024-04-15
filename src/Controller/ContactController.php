<?php

namespace App\Controller;

use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact', methods: ['GET', 'POST'])]
    public function contact(Request $request, EntityManagerInterface $manager): Response
    {
        if ($request->isMethod('POST')) {
            $data = $request->request->all();
            $nom = $data["nom"];
            $email = $data["email"];
            $phone = $data["phone"];
            $sujet = $data["sujet"];
            $message = $data["message"];

            $errors = null;
            if ($nom == "" || $nom == null) {
                $errors .= '<li>le nom doit être renseigné</li>';
            }
            if ($email == "" || $email == null) {
                $errors .= '<li>le email doit être renseigné</li>';
            }
            if ($phone == "" || $phone == null) {
                $errors .= '<li>le numero de téléphone doit être renseigné</li>';
            }
            if ($sujet == "" || $sujet == null) {
                $errors .= '<li>le sujet doit être renseigné</li>';
            }
            if ($message == "" || $message == null) {
                $errors .= '<li>le message doit être renseigné</li>';
            }
            if ($errors != null) {
                $this->addFlash('danger', 'Impossible de continuer car les erreurs suivantes sont survenues: ' . $errors);
                return $this->redirectToRoute($request->attributes->get('_route'));
            }


            $contact = new Contact();
            $contact->setNom($nom);
            $contact->setEmail($email);
            $contact->setPhone($phone);
            $contact->setSujet($sujet);
            $contact->setMessage($message);
            $manager->persist($contact);

            try {
                $manager->flush();
                $this->addFlash("success", "Votre message a bien été envoyé");
            } catch(\Exception $e) {
                $this->addFlash('danger', $e->getMessage());
            }
            $this->redirectToRoute($request->attributes->get('_route'));
        }
        return $this->render('contact.html.twig');
    }
}
