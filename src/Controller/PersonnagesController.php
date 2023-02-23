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
}
