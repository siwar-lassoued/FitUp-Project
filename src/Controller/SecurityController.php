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
            return $this->redirectToRoute('target_path'); // Replace 'target_path' with your desired route
        }

        // Get the login error, if any
        $error = $authenticationUtils->getLastAuthenticationError();
        // Retrieve the last username entered
        $lastUsername = $authenticationUtils->getLastUsername();

        // Redirect to /register if no username and no error (user might not have an account)
        if (!$lastUsername && !$error) {
            return $this->redirectToRoute('app_register');
        }

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
