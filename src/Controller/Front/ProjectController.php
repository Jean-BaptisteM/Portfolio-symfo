<?php

namespace App\Controller\Front;

use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/projets", name="project_", requirements={"id"="\d+"})
 */
class ProjectController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(ProjectRepository $projectRepository): Response
    {
        return $this->render('front/project/index.html.twig', [
            'projects' => $projectRepository->findBy([], ['id' => 'DESC']),
        ]);
    }
    
}
