<?php

namespace App\Controller;

use App\Entity\Figure;
use App\Form\FigureType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FigureController extends AbstractController
{
    #[Route('/create', name: 'create_home')]
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


}
