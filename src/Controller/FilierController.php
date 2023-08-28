<?php

namespace App\Controller;

use App\Entity\Filier;
use App\Form\FilierType;
use App\Repository\FilierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/filier')]
class FilierController extends AbstractController
{
    #[Route('/', name: 'app_filier_index', methods: ['GET'])]
    public function index(FilierRepository $filierRepository): Response
    {
        return $this->render('filier/index.html.twig', [
            'filiers' => $filierRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_filier_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $filier = new Filier();
        $form = $this->createForm(FilierType::class, $filier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($filier);
            $entityManager->flush();

            return $this->redirectToRoute('app_filier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('filier/new.html.twig', [
            'filier' => $filier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_filier_show', methods: ['GET'])]
    public function show(Filier $filier): Response
    {
        return $this->render('filier/show.html.twig', [
            'filier' => $filier,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_filier_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Filier $filier, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FilierType::class, $filier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_filier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('filier/edit.html.twig', [
            'filier' => $filier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_filier_delete', methods: ['POST'])]
    public function delete(Request $request, Filier $filier, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$filier->getId(), $request->request->get('_token'))) {
            $entityManager->remove($filier);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_filier_index', [], Response::HTTP_SEE_OTHER);
    }
}
