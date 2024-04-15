<?php

namespace App\Trait;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class UploaderFileSercvice 
{
    public function __construct(private SluggerInterface $slugger)
    {
        
    }

    public function uploadableFile(UploadedFile $file, string $directoryFolder)
    {
        $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFileName = $this->slugger->slug($fileName);
        $newFileName = $safeFileName."-".uniqid()."-".$file->guessExtension();

        try {
            $file->move(
                $directoryFolder,
                $newFileName
            );
        } catch (FileException $e) {
            // $this->addFlash('danger', $e->getMessage());
        }

        return $newFileName;
    }
}