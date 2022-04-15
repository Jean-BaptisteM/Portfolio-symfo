<?php

namespace App\Controller\Front;

use App\Repository\ProjectRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FilterController extends AbstractController
{
    /**
     * @Route("/filtre", name="filter")
     */
    public function filterByCategory(Request $request, ProjectRepository $projectRepository): Response
    {
        $filterCategory = $request->get('filterCategory');
        $projectFilterCategoryResults = $projectRepository->filterAllProjectFilterByCategory($filterCategory);

        return $this->render('front/filter/index.html.twig', [
            'projectFilterCategoryResults' => $projectFilterCategoryResults,
            'filterCategory' => $filterCategory,
        ]);
    }
}
