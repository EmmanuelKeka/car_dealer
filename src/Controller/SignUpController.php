<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\SignUpType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SignUpController extends AbstractController
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    #[Route('/signup', name: 'app_sign_up')]
    public function index(Request $request,EntityManagerInterface $entityManager): Response
    {
        if($this->getUser() !=null){
            $this->addFlash('success', 'sorry - you are already logged in');
            return $this->redirectToRoute('home');
        }
        $user = new User();
        $user->setRole("ROLE_CUSTOMER");
        $form = $this->createForm(SignUpType::class, $user,[
            'action' => $this->generateUrl('app_sign_up'),
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // hash password before persisting in DB
            $plainPassword = $user->getPassword();
            $hashedPassword = $this->passwordHasher->hashPassword($user, $plainPassword);
            $user->setPassword($hashedPassword);

            try
            {
                $entityManager->persist($user);
                $entityManager->flush();
            }
            catch (Exception $e)
            {
                //Error handing code
            }

            return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('sign_up/index.html.twig',[
            'signUp_form' => $form->createView()
        ]);
    }
}
