<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarType;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Security;

#[Route('/car')]

//#[Security("is_granted('ROLE_HR') or is_granted('ROLE_ROLE_MANAGER')") ]

//#[IsGranted('ROLE_CUSTOMER')]
//#[IsGranted('ROLE_HR')]
#[IsGranted('ROLE_USER')]

class CarController extends AbstractController
{
    private function hasValidUserRole()
    {
        $user = $this->getUser();
        $roles = $user->getRoles();

        if(in_array('ROLE_HR', $roles))
            return true;

        if(in_array('ROLE_MANAGER', $roles))
            return true;

        return false;
    }

    #[Route('/', name: 'car_index', methods: ['GET'])]
    public function index(CarRepository $carRepository): Response
    {
        if(!$this->hasValidUserRole()){
            $this->addFlash('success', 'sorry - you tried to access a page for which you do not have permission');
            return $this->redirectToRoute('home');
        }

        return $this->render('car/index.html.twig', [
            'cars' => $carRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'car_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        if(!$this->hasValidUserRole()){
            $this->addFlash('success', 'sorry - you tried to access a page for which you do not have permission');
            return $this->redirectToRoute('home');
        }
        $car = new Car();
        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($car);
            $entityManager->flush();

            return $this->redirectToRoute('car_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('car/new.html.twig', [
            'car' => $car,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'car_show', methods: ['GET'])]
    public function show(Car $car): Response
    {
        if(!$this->hasValidUserRole()){
            $this->addFlash('success', 'sorry - you tried to access a page for which you do not have permission');
            return $this->redirectToRoute('home');
        }
        return $this->render('car/show.html.twig', [
            'car' => $car,
        ]);
    }

    #[Route('/{id}/edit', name: 'car_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Car $car, EntityManagerInterface $entityManager): Response
    {
        if(!$this->hasValidUserRole()){
            $this->addFlash('success', 'sorry - you tried to access a page for which you do not have permission');
            return $this->redirectToRoute('home');
        }
        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('car_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('car/edit.html.twig', [
            'car' => $car,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'car_delete', methods: ['POST'])]
    public function delete(Request $request, Car $car, EntityManagerInterface $entityManager): Response
    {
        if(!$this->hasValidUserRole()){
            $this->addFlash('success', 'sorry - you tried to access a page for which you do not have permission');
            return $this->redirectToRoute('home');
        }
        if ($this->isCsrfTokenValid('delete'.$car->getId(), $request->request->get('_token'))) {
            $entityManager->remove($car);
            $entityManager->flush();
        }

        return $this->redirectToRoute('car_index', [], Response::HTTP_SEE_OTHER);
    }
}
