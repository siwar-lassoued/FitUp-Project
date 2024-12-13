<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // If the user is already logged in, redirect to a specific route
        if ($this->getUser()) {
            return $this->redirectToRoute('home');
        }

        // Get the login error, if any
        $error = $authenticationUtils->getLastAuthenticationError();
        // Retrieve the last username entered
        $lastUsername = $authenticationUtils->getLastUsername();


        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        // Symfony handles logout logic; this method can remain empty
        throw new \LogicException('This method is intercepted by the logout firewall handler.');
    }
}
