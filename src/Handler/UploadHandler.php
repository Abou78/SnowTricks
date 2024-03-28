<?php

namespace App\Handler;

use App\Entity\Media;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;

class UploadHandler
{
    public function __construct(public readonly EntityManagerInterface $entityManager, public readonly SluggerInterface $slugger)
    {
    }

    public function handle(array $paths, Media $media)
    {
        foreach ($paths as $path){
            $originalFilename = pathinfo($path->getClientOriginalName(), PATHINFO_FILENAME);
            // this is needed to safely include the file name as part of the URL
            $safeFilename = $this->slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$path->guessExtension();

            // Move the file to the directory where brochures are stored
            try {
                $path->move(
                    $this->getParameter('brochures_directory'),
                    $newFilename
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }
        }

        // updates the 'brochureFilename' property to store the PDF file name
        // instead of its contents
        $media->setPath($newFilename);

        $this->entityManager->persist($media);
        $this->entityManager->flush();
    }

}