<?php

namespace App\Controller\Backoffice;

use App\Entity\Monstres;
use App\Form\MonstresType;
use App\Repository\MonstresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backoffice/monstres")
 */
class MonstresController extends AbstractController
{
    /**
     * @Route("/", name="app_backoffice_monstres_index", methods={"GET"})
     */
    public function index(MonstresRepository $monstresRepository): Response
    {
        return $this->render('backoffice/monstres/index.html.twig', [
            'monstres' => $monstresRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_backoffice_monstres_new", methods={"GET", "POST"})
     */
    public function new(Request $request, MonstresRepository $monstresRepository): Response
    {
        $monstre = new Monstres();
        $form = $this->createForm(MonstresType::class, $monstre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $monstresRepository->add($monstre, true);

            return $this->redirectToRoute('app_backoffice_monstres_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('backoffice/monstres/new.html.twig', [
            'monstre' => $monstre,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_backoffice_monstres_show", methods={"GET"})
     */
    public function show(Monstres $monstre): Response
    {
        return $this->render('backoffice/monstres/show.html.twig', [
            'monstre' => $monstre,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_backoffice_monstres_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Monstres $monstre, MonstresRepository $monstresRepository): Response
    {
        $form = $this->createForm(MonstresType::class, $monstre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $monstresRepository->add($monstre, true);

            return $this->redirectToRoute('app_backoffice_monstres_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('backoffice/monstres/edit.html.twig', [
            'monstre' => $monstre,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_backoffice_monstres_delete", methods={"POST"})
     */
    public function delete(Request $request, Monstres $monstre, MonstresRepository $monstresRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$monstre->getId(), $request->request->get('_token'))) {
            $monstresRepository->remove($monstre, true);
        }

        return $this->redirectToRoute('app_backoffice_monstres_index', [], Response::HTTP_SEE_OTHER);
    }
}
