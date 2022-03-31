<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\Transaction;
use App\Form\TransactionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\BuyType;

class BuyController extends AbstractController
{
    #[Route('/car/{id}/buy', name: 'App_car_buy', methods: ['GET', 'POST'])]
    public function buy(Car $car,Request $request,EntityManagerInterface $entityManager): Response
    {
        $transaction = new Transaction();
        $transaction->setCar($car);
        $transaction->setBuyer($this->getUser());
        $form = $this->createForm(BuyType::class, $transaction);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($transaction);
            $entityManager->flush();

            return $this->redirectToRoute('app_profile', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('buy/index.html.twig', [
            'transaction' => $transaction,
            'form' => $form,
        ]);
    }
}