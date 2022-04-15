<?php

namespace App\Controller\Back;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 * @Route("/back/dashboard", name="app_back_dashboard_", requirements={"id"="\d+"})
 */
class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->render('back/dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }
}