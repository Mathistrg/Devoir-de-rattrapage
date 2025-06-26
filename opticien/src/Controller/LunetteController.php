<?php

namespace App\Controller;

use App\Entity\Lunette;
use App\Form\LunetteForm;
use App\Repository\LunetteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/lunettes')]
final class LunetteController extends AbstractController
{
    #[Route(name: 'app_lunette_index', methods: ['GET'])]
    public function index(LunetteRepository $lunetteRepository): Response
    {
        return $this->render('lunette/index.html.twig', [
            'lunettes' => $lunetteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_lunette_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $lunette = new Lunette();
        $form = $this->createForm(LunetteForm::class, $lunette);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($lunette);
            $entityManager->flush();

            return $this->redirectToRoute('app_lunette_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('lunette/new.html.twig', [
            'lunette' => $lunette,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_lunette_show', methods: ['GET'])]
    public function show(Lunette $lunette): Response
    {
        return $this->render('lunette/show.html.twig', [
            'lunette' => $lunette,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_lunette_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Lunette $lunette, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LunetteForm::class, $lunette);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_lunette_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('lunette/edit.html.twig', [
            'lunette' => $lunette,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_lunette_delete', methods: ['POST'])]
    public function delete(Request $request, Lunette $lunette, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lunette->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($lunette);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_lunette_index', [], Response::HTTP_SEE_OTHER);
    }
}
