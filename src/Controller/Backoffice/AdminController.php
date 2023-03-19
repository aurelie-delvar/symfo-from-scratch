<?php

namespace App\Controller\Backoffice;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/backoffice/admin", name="app_backoffice_admin")
     */
    public function index(): Response
    {
        return $this->render('backoffice/admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
}
