<?php

namespace App\Controller;

use App\Repository\TransactionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function profile(TransactionRepository $transactionRepository): Response
    {
        $template = 'profile/index.html.twig';
        $argsArray = [];

        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
            'transactions' => $transactionRepository->findAll()
        ]);
    }
}