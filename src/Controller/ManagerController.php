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
        $moths = ['01'=>"Jan",'02'=>"Feb",'03'=>"Mar",'04'=>"Apr",'05'=>"May",'06'=>"Jun",'07'=>"Jul",'08'=>"Aug",'09'=>"Sep",'10'=>'Oct','11'=>"Nov",'12'=>"Dec"];
        $transactions = $transactionRepository->findAll();
        $totalMoth = null;
        $totalMothtemp =0;
        $total = 0.0;
        $fist = (int)$transactions[0]->getDate()->format("m");
        $temp = null;
        $transactionbyMoth = null;
        $i = 0;
        foreach ($transactions as $transtaction){
            $total = $total + $transtaction->getCar()->getPrice();
            if ($i == count($transactions)-1){
                if( $i>0 &&((int)$transactions[$i-1]->getDate()->format("m") == (int)$transtaction->getDate()->format("m"))){
                    $totalMothtemp = $totalMothtemp + $transtaction->getCar()->getPrice();
                    $temp[] = $transtaction;
                    $transactionbyMoth[] = $temp;
                    $totalMoth[$transtaction->getDate()->format("m")] = $totalMothtemp;
                }
                else {
                    $totalMothtemp = $transtaction->getCar()->getPrice();
                    $temp[] = $transtaction;
                    $transactionbyMoth[] = $temp;
                    $totalMoth[$transtaction->getDate()->format("m")] = $totalMothtemp;
                }
            }
            elseif($fist == (int)$transtaction->getDate()->format("m")){
                $temp[] = $transtaction;
                $totalMothtemp = $totalMothtemp + $transtaction->getCar()->getPrice();
                if(!($fist == (int)$transactions[$i+1]->getDate()->format("m"))){
                    $totalMoth[$transtaction->getDate()->format("m")] = $totalMothtemp;
                    $transactionbyMoth[] =$temp;
                    $temp = null;
                    $totalMothtemp =0;
                    $fist = (int)$transactions[$i+1]->getDate()->format("m");
                }
            }
            $i=$i+1;
        }
        return $this->renderForm('manager/index.html.twig', [
            'transactions' => $transactionbyMoth,
            'total' => $total,
            'moths' =>$moths,
            'mothSell' => $totalMoth
        ]);
    }
}