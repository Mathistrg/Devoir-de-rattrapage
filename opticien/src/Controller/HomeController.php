<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(
        EntityManagerInterface $entityManager,
        AuthenticationUtils $authenticationUtils
    ): Response
    {
        $existingUsers = $entityManager->getRepository(Utilisateur::class)->count([]);
        if ($existingUsers === 0) {
            return $this->redirectToRoute('app_register');
        }
        if ($this->getUser()) {
            return $this->redirectToRoute('app_lunette_index');
        }

        // Affiche directement le formulaire de connexion sur /
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }
}
