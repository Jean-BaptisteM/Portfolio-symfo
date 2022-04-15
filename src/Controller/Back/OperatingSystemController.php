<?php

namespace App\Controller\Back;

use App\Entity\OperatingSystem;
use App\Form\OperatingSystemType;
use App\Repository\OperatingSystemRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 * @Route("/back/operating/system", name="app_back_operating_system_", requirements={"id"="\d+"})
 */
class OperatingSystemController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(OperatingSystemRepository $operatingSystemRepository): Response
    {
        return $this->render('back/operating_system/index.html.twig', [
            'operating_systems' => $operatingSystemRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="new", methods={"GET", "POST"})
     */
    public function new(Request $request, OperatingSystemRepository $operatingSystemRepository): Response
    {
        $operatingSystem = new OperatingSystem();
        $form = $this->createForm(OperatingSystemType::class, $operatingSystem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $operatingSystemRepository->add($operatingSystem);
            $this->addFlash('message', 'L\'OS a bien été ajouté');
            return $this->redirectToRoute('app_back_operating_system_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/operating_system/new.html.twig', [
            'operating_system' => $operatingSystem,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(OperatingSystem $operatingSystem): Response
    {
        return $this->render('back/operating_system/show.html.twig', [
            'operating_system' => $operatingSystem,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, OperatingSystem $operatingSystem, OperatingSystemRepository $operatingSystemRepository): Response
    {
        $form = $this->createForm(OperatingSystemType::class, $operatingSystem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $operatingSystemRepository->add($operatingSystem);
            $this->addFlash('message', 'L\'OS a bien été modifié');
            return $this->redirectToRoute('app_back_operating_system_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/operating_system/edit.html.twig', [
            'operating_system' => $operatingSystem,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"POST"})
     */
    public function delete(Request $request, OperatingSystem $operatingSystem, OperatingSystemRepository $operatingSystemRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$operatingSystem->getId(), $request->request->get('_token'))) {
            $operatingSystemRepository->remove($operatingSystem);
            $this->addFlash('message', 'L\'OS a bien été supprimé');
        }

        return $this->redirectToRoute('app_back_operating_system_index', [], Response::HTTP_SEE_OTHER);
    }
}
