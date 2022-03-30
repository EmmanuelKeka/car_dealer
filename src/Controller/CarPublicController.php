<?php

namespace App\Controller;

use App\Entity\Car;
use App\Repository\CarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarPublicController extends AbstractController
{
    #[Route('/Cars', name: 'App_Car_Public')]
    public function cars(CarRepository $carRepository): Response
    {
        $template = 'carPublic/index.html.twig';
        $argsArray = [];

        return $this->render($template, [
            'controller_name' => 'CarPublicController',
            'cars' => $carRepository->findAll()
        ]);
    }

    #[Route('/car/{id}', name: 'App_car_show_public', methods: ['GET'])]
    public function show(Car $car): Response
    {
        return $this->render('carPublic/show.html.twig', [
            'car' => $car,
        ]);
    }
}