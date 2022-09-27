<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{
    #[Route('/wish/liste', name: 'wish_liste')]
    public function liste(): Response
    {
        return $this->render('wish/liste.html.twig', [
        ]);
    }

    #[Route('/wish/detail/{id}',
        name: 'wish_detail',
        requirements: ['id' => '\d+']
    )]
    public function detail(
        int $id
    ): Response
    {
        return $this->render('wish/detail.html.twig', [
        ]);
    }
}
