<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\UserRepository;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
        Wish $id
    ): Response
    {
        return $this->render('wish/detail.html.twig', [
            "wish" => $id
        ]);
    }

    #[Route('/wish/ajout',
        name: 'wish_ajout',
    )]
    public function ajout(
        Request                $request,
        EntityManagerInterface $entityManager,
        UserRepository         $userRepository
    ): Response
    {
        $wish = new Wish();
//        $utilisateur = $userRepository->findOneBy(
//            ['email' => $this->getUser()->getUserIdentifier()]
//        );
        $utilisateur = $userRepository->findOneBy(
            ['username' => $this->getUser()->getUserIdentifier()]
        );
        $wish->setAuthor($utilisateur->getUsername());
        $formWish = $this->createForm(WishType::class, $wish);
        $formWish->handleRequest($request);

        if ($formWish->isSubmitted() && $formWish->isValid()) {
            $wish->setDateCreated(new \DateTime());
            $wish->setIsPublished(true);
            $entityManager->persist($wish);
            $entityManager->flush();
            return $this->redirectToRoute('wish_detail', ["id" => $wish->getId()]);
        }

        return $this->render('wish/ajout.html.twig', [
            "formWish" => $formWish->createView()
        ]);
    }
}
