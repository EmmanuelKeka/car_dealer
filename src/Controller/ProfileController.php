<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\TransactionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[IsGranted('ROLE_USER')]
class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function profile(TransactionRepository $transactionRepository): Response
    {
        $user = $this->getUser();
        $transactions = $user->getTransactions();
//
//        print('<pre>');
//        var_dump($transactions);
//        die();

        $template = 'profile/index.html.twig';
        $argsArray = [
            'controller_name' => 'ProfileController',
            'transactions' => $transactions
            ];


        return $this->render('profile/index.html.twig', $argsArray);
    }
}