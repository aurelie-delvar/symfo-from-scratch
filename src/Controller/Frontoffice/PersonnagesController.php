<?php

namespace App\Controller\Frontoffice;

use App\Entity\Personnages;
use App\Form\PersonnagesType;
use App\Repository\PersonnagesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PersonnagesController extends AbstractController
{
    /**
     * @Route("/", name="app_personnages")
     */
    public function index(PersonnagesRepository $persorepo): Response
    {
        $persos = $persorepo->findAll();

        return $this->render('personnages/index.html.twig', [
            'persos' => $persos,
        ]);
    }

    /**
     * Route pour afficher un perso
     *
     * @Route("/perso/{id}", name="app_show", requirements={"id" = "\d+"})
     */
    public function show($id, PersonnagesRepository $persorepo) : Response 
    {
        $persoso = $persorepo->find($id);

        return $this->render('personnages/show.html.twig', [
            'persoso' => $persoso,
        ]);
    }

    /**
     * Route pour ajouter un perso
     * 
     * @Route("/perso/nouveau", name="app_new")
     */
    public function new(Request $request, PersonnagesRepository $personnagesRepository) : Response
    {
        $perso = new Personnages();
        $form = $this->createForm(PersonnagesType::class, $perso);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $personnagesRepository->add($perso, true);

            return $this->redirectToRoute('app_personnages');
        }

        return $this->renderForm('personnages/new.html.twig', [
            'form' => $form,
            'perso' => $perso,
        ]);
    }
}
