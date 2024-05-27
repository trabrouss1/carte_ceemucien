<?php

namespace App\Controller;

use App\Entity\Coordination;
use App\Entity\Membre;
use App\Entity\Niveau;
use App\Service\PdfService;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Qipsius\TCPDFBundle\Controller\TCPDFController;


class CarteMembreController extends AbstractController
{
    public function __construct(private TCPDFController $tcpdf)
    {
        $this->tcpdf = $tcpdf;
    }

    #[Route('/inscription-carte-membre', name: 'inscription_carte_membre', methods: ['GET', 'POST'])]
    public function inscriptionCarteMembre(Request $request, EntityManagerInterface $manager): Response
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

    #[Route('/carte-membre', name: 'carte_membre')]
    public function carte_membre(Membre $membre, PdfService $pdfService): Response
    {
        return $pdfService->generate(
//            "carte_membre_single.html.twig",
            "carte_membre_single1.html.twig",
            'carte-membre-ceemuci',
            compact('membre'),
            [
                'orientation'              => 'portrait',
                'enable-javascript'        => false,
                'javascript-delay'         => 1000,
                'no-stop-slow-scripts'     => true,
                'background'               => true,
                'lowquality'               => false,
                'page-width'               => 86,
                'page-height'              => 54,
                'margin-bottom'            => 0,
                'margin-left'              => 0,
                'margin-right'             => 0,
                'margin-top'               => 0,
                'encoding'                 => 'utf-8',
                'images'                   => true,
                'cookie'                   => [],
                'dpi'                      => 300,
                'enable-external-links'    => false,
                'enable-internal-links'    => false,
                'enable-local-file-access' => true
            ]
        );
    }

    #[Route('/carte', name: 'carte')]
    public function carte(){
        $pdf = new \TCPDF('L', 'mm', array(57,96), true, 'UTF-8', false);
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $imgFile = '/Users/trabrouss/Documents/Projects/php/carte_ceemucien/tcpdf/examples/images/carte_loko.jpg';
        $pdf->AddPage();
        $htmlpersiantranslation =
            '<span color="#000000">Hi, At last Problem of Persian PDF Solved completely. This is a example for it.
                <br />Special thanks to "Nicola Asuni" and "Mohamad Ali Golkar" for Persian support.
            </span>';
        $pdf->setRTL(true);

        $pdf->WriteHTML($htmlpersiantranslation, true, 0, true, 0);
        $pdf->Image($imgFile, 0, 0, 96, 57, '', '', '', false, 300, '', false, false, 0);
        $pdf->Output('carte_membre_ceemuci.pdf', 'I');
    }
}
