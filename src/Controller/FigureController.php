<?php

namespace App\Controller;

use App\Repository\FigureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FigureController extends AbstractController
{
    #[Route('/', name: 'home_home')]
    public function home(figureRepository $figureRepository): Response
    {
        $figures = $figureRepository->findby([]);

        return $this->render('figure/home.html.twig', [
            "figures" => $figures,
        ]);
    }


}
