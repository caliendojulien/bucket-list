<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'accueil_index')]
    public function index(): Response
    {
        return $this->render('accueil/index.html.twig', [
        ]);
    }

    #[Route('/about_us', name: 'accueil_about_us')]
    public function about_us(): Response
    {
        return $this->render('accueil/about_us.html.twig', [
        ]);
    }
}
