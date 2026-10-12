<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class Page2Controller extends AbstractController
{
    #[Route('/page2', name: 'app_page2')]
    public function index(): Response
    {
        return $this->render('page2.html.twig');
    }
}