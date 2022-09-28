<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Repository\WishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{
    #[Route('/wish/liste', name: 'wish_liste')]
    public function liste(
        WishRepository $wishRepository
    ): Response
    {
        $wishes = $wishRepository->findBy(
            ['isPublished' => true]
        );
        return $this->render('wish/liste.html.twig', [
            "wishes" => $wishes
        ]);
    }

    #[Route('/wish/detail/{id}',
        name: 'wish_detail',
        requirements: ['id' => '\d+']
    )]
    public function detail(
        Wish           $id
    ): Response
    {
        return $this->render('wish/detail.html.twig', [
            "wish" => $id
        ]);
    }
}
