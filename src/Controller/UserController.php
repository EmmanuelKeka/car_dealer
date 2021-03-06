<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[IsGranted('ROLE_USER')]
#[Route('/user')]
class UserController extends AbstractController
{
    private UserPasswordHasherInterface $passwordHasher;

    private function hasValidUserRole()
    {
        if($this->getUser() ==null){
            return false;
        }
        $user = $this->getUser();
        $roles = $user->getRoles();

        if(in_array('ROLE_HR', $roles))
            return true;

        if(in_array('ROLE_ADMIN', $roles))
            return true;

        return false;
    }

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    #[Route('/', name: 'user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        if(!$this->hasValidUserRole()){
            $this->addFlash('success', 'sorry - you tried to access a page for which you do not have permission');
            return $this->redirectToRoute('home');
        }
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        if(!$this->hasValidUserRole()){
            $this->addFlash('success', 'sorry - you tried to access a page for which you do not have permission');
            return $this->redirectToRoute('home');
        }
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // hash password before persisting in DB
            $plainPassword = $user->getPassword();
            $hashedPassword = $this->passwordHasher->hashPassword($user, $plainPassword);
            $user->setPassword($hashedPassword);

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        if(!$this->hasValidUserRole()){
            $this->addFlash('success', 'sorry - you tried to access a page for which you do not have permission');
            return $this->redirectToRoute('home');
        }
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if(!$this->hasValidUserRole()){
            $this->addFlash('success', 'sorry - you tried to access a page for which you do not have permission');
            return $this->redirectToRoute('home');
        }
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // hash password before persisting in DB
            $plainPassword = $user->getPassword();
            $hashedPassword = $this->passwordHasher->hashPassword($user, $plainPassword);
            $user->setPassword($hashedPassword);

            $entityManager->flush();

            return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if(!$this->hasValidUserRole()){
            $this->addFlash('success', 'sorry - you tried to access a page for which you do not have permission');
            return $this->redirectToRoute('home');
        }
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
    }
}
