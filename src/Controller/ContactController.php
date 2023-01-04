<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route("/contact", name: 'contact_app', methods: ['GET'])]
    public function index()
    {
        return $this->render('contact/index.html.twig');
    }
}