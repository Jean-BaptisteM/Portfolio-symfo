<?php

namespace App\Controller\Front;

use App\Repository\CmsRepository;
use App\Repository\UserRepository;
use App\Repository\ProjectRepository;
use App\Repository\CategoryRepository;
use App\Repository\DatabaseRepository;
use App\Repository\LanguageRepository;
use App\Repository\SoftwareRepository;
use App\Repository\FrameworkRepository;
use App\Repository\VersionningRepository;
use App\Repository\OperatingSystemRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(UserRepository $userRepository, CategoryRepository $categoryRepository, CmsRepository $cmsRepository, DatabaseRepository $databaseRepository,FrameworkRepository $frameworkRepository, LanguageRepository $languageRepository, OperatingSystemRepository $operatingSystemRepository, ProjectRepository $projectRepository, SoftwareRepository $softwareRepository, VersionningRepository $versionningRepository): Response
    {
        return $this->render('front/home/index.html.twig', [
            'categories' => $categoryRepository->findBy([], ['name' => 'ASC']),
            'cmss' => $cmsRepository->findBy([], ['name' => 'ASC']),
            'databases' => $databaseRepository->findBy([], ['name' => 'ASC']),
            'frameworks' => $frameworkRepository->findBy([], ['name' => 'ASC']),
            'languages' => $languageRepository->findBy([], ['name' => 'ASC']),
            'operating_systems' => $operatingSystemRepository->findBy([], ['name' => 'ASC']),
            'projects' => $projectRepository->findBy([], ['id' => 'DESC']),
            'softwares' => $softwareRepository->findBy([], ['name' => 'ASC']),
            'versionnings' => $versionningRepository->findBy([], ['name' => 'ASC']),
            'user' => $userRepository->findOneBy(['firstname' => 'Jean-Baptiste']),
        ]);
    }
}
