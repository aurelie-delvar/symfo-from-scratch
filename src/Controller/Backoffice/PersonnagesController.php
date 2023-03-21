<?php

namespace App\Controller\Backoffice;

use App\Entity\Personnages;
use App\Form\Personnages1Type;
use App\Repository\PersonnagesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/backoffice/personnages")
 * 
 */
class PersonnagesController extends AbstractController
{
    /**
     * @Route("/", name="app_backoffice_personnages_index", methods={"GET"})
     */
    public function index(PersonnagesRepository $personnagesRepository): Response
    {
        return $this->render('backoffice/personnages/index.html.twig', [
            'personnages' => $personnagesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_backoffice_personnages_new", methods={"GET", "POST"})
     * 
     */
    public function new(Request $request, PersonnagesRepository $personnagesRepository): Response
    {
        $personnage = new Personnages();
        $form = $this->createForm(Personnages1Type::class, $personnage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $personnagesRepository->add($personnage, true);

            return $this->redirectToRoute('app_backoffice_personnages_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('backoffice/personnages/new.html.twig', [
            'personnage' => $personnage,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_backoffice_personnages_show", methods={"GET"})
     */
    public function show(Personnages $personnage): Response
    {
        return $this->render('backoffice/personnages/show.html.twig', [
            'personnage' => $personnage,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_backoffice_personnages_edit", methods={"GET", "POST"})
     * 
     */
    public function edit(Request $request, Personnages $personnage, PersonnagesRepository $personnagesRepository): Response
    {
        // @IsGranted("ROLE_ADMIN", message="Seuls les admins peuvent aller sur cette page.")
        $form = $this->createForm(Personnages1Type::class, $personnage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $personnagesRepository->add($personnage, true);

            return $this->redirectToRoute('app_backoffice_personnages_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('backoffice/personnages/edit.html.twig', [
            'personnage' => $personnage,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_backoffice_personnages_delete", methods={"POST"})
     * 
     */
    public function delete(Request $request, Personnages $personnage, PersonnagesRepository $personnagesRepository): Response
    {
        // @IsGranted("ROLE_ADMIN", message="Seuls les admins peuvent aller sur cette page.")
        if ($this->isCsrfTokenValid('delete'.$personnage->getId(), $request->request->get('_token'))) {
            $personnagesRepository->remove($personnage, true);
        }

        return $this->redirectToRoute('app_backoffice_personnages_index', [], Response::HTTP_SEE_OTHER);
    }
}
