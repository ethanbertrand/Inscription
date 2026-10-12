<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class Page3Controller extends AbstractController
{
    #[Route('/page3', name: 'app_page3')]
    public function index(): Response
    {
        return $this->render('page3.html.twig');
    }
}