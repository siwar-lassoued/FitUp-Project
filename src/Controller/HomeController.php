<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/home/contact', name: 'app_contact')]
    public function contact(): Response
    {
        return $this->render('contact.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/home/blog', name: 'app_blog')]
    public function blog(): Response
    {
        return $this->render('blog.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/home/success', name: 'app_success')]
    public function success(): Response
    {
        return $this->render('success-stories.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/home/about', name: 'app_about')]
    public function about(): Response
    {
        return $this->render('about.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/home/coach', name: 'app_coach')]
    public function coach(): Response
    {
        return $this->render('coach.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/home/pricing', name: 'app_pricing')]
    public function pricing(): Response
    {
        return $this->render('pricing.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/home/services', name: 'app_services')]
    public function services(): Response
    {
        return $this->render('services.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

}
