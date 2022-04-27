<?php

namespace App\Controller;

use App\Repository\TransactionRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Transaction;
use App\Entity\Car;

#[IsGranted('ROLE_MANAGER')]
class ManagerController  extends AbstractController
{
    #[Route('/view_sales', name: 'view_sales', methods: ['GET', 'POST'])]
    public function view_sales(Request $request,TransactionRepository $transactionRepository): Response
    {
        $transactions = $transactionRepository->findAll();
        $total = 0.0;
        foreach ($transactions as $transtaction){
            $total = $total + $transtaction->getCar()->getPrice();
        }
        return $this->renderForm('manager/index.html.twig', [
            'transactions' => $transactions,
            'total' => $total,
        ]);
    }
}