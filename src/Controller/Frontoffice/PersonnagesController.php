<?php

namespace App\Controller\Frontoffice;

use App\Entity\Personnages;
use App\Form\PersonnagesType;
use App\Form\SearchCharacterType;
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
    public function index(PersonnagesRepository $persorepo, Request $request): Response
    {
        $persos = $persorepo->findAll();

        // je fais les manips habituelles sur le formulaire barre de recherche
        $form = $this->createForm(SearchCharacterType::class);

        $search = $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            // chercher les personnages correspondants aux mots-clés entrés par l'utilisateur
            // on récupère en argument ce qui a été donné par l'utilisateur
            $persos = $persorepo->search($search->get('mots')->getData());

        }

        return $this->render('frontoffice/personnages/index.html.twig', [
            'persos' => $persos,
            'form' => $form->createView(),
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

        return $this->render('frontoffice/personnages/show.html.twig', [
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

        return $this->renderForm('frontoffice/personnages/new.html.twig', [
            'form' => $form,
            'perso' => $perso,
        ]);
    }
}
