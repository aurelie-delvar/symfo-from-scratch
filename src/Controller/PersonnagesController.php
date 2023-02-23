<?php

namespace App\Controller;

use App\Repository\PersonnagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
}
