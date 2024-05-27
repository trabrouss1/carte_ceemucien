<?php

namespace App\Service;

use Knp\Snappy\Pdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class PdfService extends AbstractController
{
    public function __construct(private Pdf $snappy)
    {
    }

    public function generate(string $view, string $filename, array $context = [], array $options = [])
    {
        ini_set("memory_limit", "512M");
        $this->snappy->setOption("encoding", "UTF-8");
        // $this->snappy->setOption("orientation", "Landscape");
//        $this->snappy->setOption("orientation", "portrait");
        $html = $this->renderView($view, $context);
        // $header = $this->renderView('header.html.twig');
        // $footer = $this->renderView( '::footer.html.twig' );
        $options = array_merge($options, [
            // 'header-html' => $header,
            // 'footer-html' => $footer,
            // 'page-size'           => 'A4',
            'enable-local-file-access' => true
        ]);
        // Tcpdf
        // $this->returnPDFResponseFromHTML($html);
//        dd($this->snappy->getOptions());
        return new Response(
            $this->snappy->getOutputFromHtml($html, $options),
            200,
            [
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $filename . '.pdf"'
            ]
        );
    }
}
