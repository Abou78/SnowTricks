<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FigureController extends AbstractController
{
    #[Route('/', name: 'home_figure')]
    public function home(): Response
    {
        return $this->render('figure/home.html.twig', [
            'controller_name' => 'FigureController',
        ]);
    }
}
