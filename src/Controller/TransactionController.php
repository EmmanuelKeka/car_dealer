<?php

namespace App\Controller;

use App\Entity\Transaction;
use App\Form\Transaction1Type;
use App\Repository\TransactionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[IsGranted('ROLE_ADMIN')]
#[Route('/transaction')]
class TransactionController extends AbstractController
{
    private function hasValidUserRole()
    {
        if($this->getUser() ==null){
            return false;
        }
        $user = $this->getUser();
        $roles = $user->getRoles();

        if(in_array('ROLE_MANAGER', $roles))
            return true;
        if(in_array('ROLE_ADMIN', $roles))
            return true;

        return false;
    }
    #[Route('/', name: 'transaction_index', methods: ['GET'])]
    public function index(TransactionRepository $transactionRepository): Response
    {
        if(!$this->hasValidUserRole()){
            $this->addFlash('success', 'sorry - you tried to access a page for which you do not have permission');
            return $this->redirectToRoute('home');
        }
        return $this->render('transaction/index.html.twig', [
            'transactions' => $transactionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'transaction_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        if(!$this->hasValidUserRole()){
            $this->addFlash('success', 'sorry - you tried to access a page for which you do not have permission');
            return $this->redirectToRoute('home');
        }
        $transaction = new Transaction();
        $form = $this->createForm(Transaction1Type::class, $transaction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($transaction);
            $entityManager->flush();

            return $this->redirectToRoute('transaction_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('transaction/new.html.twig', [
            'transaction' => $transaction,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'transaction_show', methods: ['GET'])]
    public function show(Transaction $transaction): Response
    {
        if(!$this->hasValidUserRole()){
            $this->addFlash('success', 'sorry - you tried to access a page for which you do not have permission');
            return $this->redirectToRoute('home');
        }
        return $this->render('transaction/show.html.twig', [
            'transaction' => $transaction,
        ]);
    }

    #[Route('/{id}/edit', name: 'transaction_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Transaction $transaction, EntityManagerInterface $entityManager): Response
    {
        if(!$this->hasValidUserRole()){
            $this->addFlash('success', 'sorry - you tried to access a page for which you do not have permission');
            return $this->redirectToRoute('home');
        }
        $form = $this->createForm(Transaction1Type::class, $transaction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('transaction_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('transaction/edit.html.twig', [
            'transaction' => $transaction,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'transaction_delete', methods: ['POST'])]
    public function delete(Request $request, Transaction $transaction, EntityManagerInterface $entityManager): Response
    {

        if ($this->isCsrfTokenValid('delete'.$transaction->getId(), $request->request->get('_token'))) {
            $entityManager->remove($transaction);
            $entityManager->flush();
        }

        return $this->redirectToRoute('transaction_index', [], Response::HTTP_SEE_OTHER);
    }
}
