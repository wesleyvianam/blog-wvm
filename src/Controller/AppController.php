<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    #[Route("/", name: 'home_app', methods: ['GET'])]
    public function index()
    {
        return $this->render('pages/home.html.twig');
    }

    #[Route("/about", name: 'about_app', methods: ['GET'])]
    public function about()
    {
        return $this->render('pages/about.html.twig');
    }

    #[Route("/contact", name: 'contact_app', methods: ['GET'])]
    public function contact()
    {
        return $this->render('pages/contact.html.twig');
    }
}