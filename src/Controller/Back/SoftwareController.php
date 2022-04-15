<?php

namespace App\Controller\Back;

use App\Entity\Software;
use App\Form\SoftwareType;
use App\Repository\SoftwareRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 * @Route("/back/software", name="app_back_software_", requirements={"id"="\d+"})
 */
class SoftwareController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(SoftwareRepository $softwareRepository): Response
    {
        return $this->render('back/software/index.html.twig', [
            'softwares' => $softwareRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="new", methods={"GET", "POST"})
     */
    public function new(Request $request, SoftwareRepository $softwareRepository): Response
    {
        $software = new Software();
        $form = $this->createForm(SoftwareType::class, $software);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $softwareRepository->add($software);
            $this->addFlash('message', 'Le software a bien été ajouté');
            return $this->redirectToRoute('app_back_software_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/software/new.html.twig', [
            'software' => $software,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(Software $software): Response
    {
        return $this->render('back/software/show.html.twig', [
            'software' => $software,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Software $software, SoftwareRepository $softwareRepository): Response
    {
        $form = $this->createForm(SoftwareType::class, $software);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $softwareRepository->add($software);
            $this->addFlash('message', 'Le software a bien été modifié');
            return $this->redirectToRoute('app_back_software_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/software/edit.html.twig', [
            'software' => $software,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"POST"})
     */
    public function delete(Request $request, Software $software, SoftwareRepository $softwareRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$software->getId(), $request->request->get('_token'))) {
            $softwareRepository->remove($software);
            $this->addFlash('message', 'Le software a bien été supprimé');
        }

        return $this->redirectToRoute('app_back_software_index', [], Response::HTTP_SEE_OTHER);
    }
}
