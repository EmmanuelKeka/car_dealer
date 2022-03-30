<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/ContactUs', name: 'contact')]
    public function contact(): Response
    {
        $template = 'contact/index.html.twig';
        $argsArray = [];

        return $this->render($template, $argsArray);
    }
}