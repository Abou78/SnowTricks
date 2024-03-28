<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Figure;
use App\Entity\Media;
use App\Form\CommentType;
use App\Form\FigureType;
use App\Form\MediaType;
use App\Handler\UploadHandler;
use App\Repository\CommentRepository;
use App\Repository\FigureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class FigureController extends AbstractController
{
    #[Route('/create', name: 'figure_create')]
    public function create(
        Request $request,
        EntityManagerInterface $entityManager): Response
    {
        $figure = new Figure();
        $figure->setCreatedAt(new \DateTimeImmutable());
        $figureForm = $this->createForm(FigureType::class, $figure);

        $figureForm->handleRequest($request);
        if ($figureForm->isSubmitted() and $figureForm->isValid()){
            $entityManager->persist($figure);
            $entityManager->flush();

            $this->addFlash('figure', 'Votre figure a bien été ajoutée !');
            return $this->redirectToRoute('home_home');
        }

        return $this->render('figure/create.html.twig', [
            'figureForm' => $figureForm->createView(),
        ]);
    }


    #[Route('/details/{id}', name: 'figure_details')]
    public function detail(figureRepository $figureRepository,
                           int $id,
                           EntityManagerInterface $entityManager,
                           Request $request,
                           CommentRepository $commentRepository ): Response
    {
        $figure = $figureRepository->find($id);

        $comment = new Comment();
        $comment->setCreatedAt(new \DateTimeImmutable());

        $commentForm = $this->createForm(CommentType::class, $comment);
        $commentForm->handleRequest($request);
        if ($commentForm->isSubmitted() and $commentForm->isValid()){
            $entityManager->persist($comment);
            $entityManager->flush();

           $this->addFlash('comment', 'Votre commentaire a bien été ajoutée !');
        }

        $comments = $commentRepository->findAll();

        return $this->render('figure/detail.html.twig', [
            "figure" => $figure,
            "commentForm" => $commentForm->createView(),
            "comments" => $comments,
        ]);
    }

    #[Route('/media', name: 'figure_media')]
    public function createMedia(Request $request, UploadHandler $uploadHandler)
    {
        $media = new Media();
        $media->setCreatedAt(new \DateTimeImmutable());

        $mediaForm = $this->createForm(MediaType::class, $media);
        $mediaForm->handleRequest($request);
        if($mediaForm->isSubmitted() and $mediaForm->isValid()){
            $path = $mediaForm->get('media')->getData();
            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded

            $isUploadedMedia=$uploadHandler->handle($path, $media);
            if ($isUploadedMedia) {
                ($path);}


            $this->addFlash('media', 'Votre media a bien été ajoutée !');

            return $this->redirectToRoute('figure_create');
        }

        return $this->render('figure/media.html.twig', [
            "media" => $media,
            "mediaForm" => $mediaForm->createView(),
        ]);


    }


    #[Route('/figure/delete/{id}', name: 'figure_delete')]
    public function delete(EntityManagerInterface $entityManager, Figure $figure)
    {
        $entityManager->remove($figure);
        $entityManager->flush();

        return $this->redirectToRoute('home_home');
    }

    #[Route('/figure/update/{id}', name: 'figure_update')]
    public function update(
        Request $request,
        EntityManagerInterface $entityManager,
        Figure $figure ): Response
    {
        $figure->setUpdateAt(new \DateTimeImmutable());
        $figureForm = $this->createForm(FigureType::class, $figure);

        $figureForm->handleRequest($request);
        if ($figureForm->isSubmitted() and $figureForm->isValid()){
            $entityManager->persist($figure);
            $entityManager->flush();

            $this->addFlash('figure', 'Votre figure a bien été modifiée !');
            return $this->redirectToRoute('home_home');
        }

        return $this->render('figure/update.html.twig', [
            'figureForm' => $figureForm->createView(),
            'figure' => $figure,
        ]);
    }

}
