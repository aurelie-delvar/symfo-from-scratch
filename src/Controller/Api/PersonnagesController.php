<?php

namespace App\Controller\Api;

use App\Repository\PersonnagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class PersonnagesController extends AbstractController
{
    /**
     * @Route("/api/personnages", name="app_api_personnages", methods={"GET"})
     */
    public function browse(PersonnagesRepository $personnagesRepository): JsonResponse
    {
        $personnages = $personnagesRepository->findAll();

        return $this->json(
            $personnages,
            200,
            [],
            [
                "groups" => [
                    "browse_persos",
                ]
            ],
        );
    }
}
