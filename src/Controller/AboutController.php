<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{
    #[Route('/About', name: 'about')]
    public function about(): Response
    {
        $template = 'about/index.html.twig';
        $argsArray = [];

        return $this->render($template, $argsArray);
    }
}