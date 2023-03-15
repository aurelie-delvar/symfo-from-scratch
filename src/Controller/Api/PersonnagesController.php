<?php

namespace App\Controller\Api;

use App\Entity\Personnages;
use App\Repository\PersonnagesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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

    /**
     * @Route("/api/personnages/{id}", name = "app_api_personnages_read", methods={"GET"}, requirements = {"id" = "\d+"})
     *
     */
    public function read(Personnages $personnage = null) 
    {
        if($personnage === null) {
            return $this->json("Le personnage n'existe pas", Response::HTTP_NOT_FOUND);
        }
        
        return $this->json($personnage, Response::HTTP_FOUND, [], [ "groups" => ["browse_persos"]]);
    }

    /**
     * @Route("/api/personnages/{id}", name = "app_api_personnages_edit", methods = {"PUT", "PATCH"}, requirements = {"id" = "\d+"})
     *
     */
    public function edit(Personnages $personnage = null, Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager, ValidatorInterface $validator)
    {
        if($personnage ===  null) {
            return $this->json("Personnage pas trouvé", Response::HTTP_NOT_FOUND);
        }

        // je récup le contenu de la requête des fronts
        $persoJson = $request->getContent();
        
        // j'utilise un try/catch au cas où j'aurais des données erronées
        try {

        // je désérialize ce contenu pour en faire une entité
        $serializer->deserialize(
            $persoJson, 
            Personnages::class, 
            'json', 
            [AbstractNormalizer::OBJECT_TO_POPULATE => $personnage]);  

        } catch (\Throwable $erreur) {

            return $this->json($erreur->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY);

        }

        $listErrors = $validator->validate($personnage);
        if(count($listErrors) > 0) {
            
            return $this->json($listErrors, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $entityManager->flush();

        return $this->json(null, Response::HTTP_NO_CONTENT);

    }

    /**
     * @Route("/api/personnages", name = "app_api_personnages_add", methods = {"POST"})
     *
     */
    public function add(Request $request, SerializerInterface $serializer, PersonnagesRepository $personnagesRepository, ValidatorInterface $validator)
    {
        // je récup le contenu json de la requete
        $jsonContent = $request->getContent();

        try {

            // je veux le convertir en entité
            $jsonPerso = $serializer->deserialize($jsonContent, Personnages::class, 'json');

        } catch (\Throwable $e) {

            return $this->json(

                $e->getMessage(),

                Response::HTTP_UNPROCESSABLE_ENTITY

            );
        }
    
    $listError = $validator->validate($jsonPerso);

    if (count($listError) > 0) {

        return $this->json(

            $listError,

            Response::HTTP_UNPROCESSABLE_ENTITY
        );
    }

        $personnagesRepository->add($jsonPerso, true);

        return $this->json($jsonPerso, Response::HTTP_CREATED, [], ["groups" => ["browse_persos"]]);

    }

    // /**
    //  * @Route()
    //  *
    //  */
    // public function delete()
    // {

    // }
}
