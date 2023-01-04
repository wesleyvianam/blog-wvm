<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route("/", name: 'home_app', methods: ['GET'])]
    public function index()
    {
        return $this->render('home/index.html.twig');
    }
}