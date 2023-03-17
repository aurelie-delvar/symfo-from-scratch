<?php

namespace App\Controller\Frontoffice;

use App\Repository\MonstresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MonstresController extends AbstractController
{
    /**
     * @Route("/monstres", name="app_monstres")
     */
    public function index(MonstresRepository $monstresRepository): Response
    {
        $monstres = $monstresRepository->findAll();

        return $this->render('monstres/index.html.twig', [
            'monstres' => $monstres,
        ]);
    }
}
