<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{
    #[Route("/about", name: 'about_app', methods: ['GET'])]
    public function index()
    {
        return $this->render('about/index.html.twig');
    }
}