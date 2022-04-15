<?php

namespace App\Controller\Back;

use App\Entity\Versionning;
use App\Form\VersionningType;
use App\Repository\VersionningRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 * @Route("/back/versionning", name="app_back_versionning_", requirements={"id"="\d+"})
 */
class VersionningController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(VersionningRepository $versionningRepository): Response
    {
        return $this->render('back/versionning/index.html.twig', [
            'versionnings' => $versionningRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="new", methods={"GET", "POST"})
     */
    public function new(Request $request, VersionningRepository $versionningRepository): Response
    {
        $versionning = new Versionning();
        $form = $this->createForm(VersionningType::class, $versionning);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $versionningRepository->add($versionning);
            $this->addFlash('message', 'Le versionning a bien été ajouté');
            return $this->redirectToRoute('app_back_versionning_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/versionning/new.html.twig', [
            'versionning' => $versionning,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(Versionning $versionning): Response
    {
        return $this->render('back/versionning/show.html.twig', [
            'versionning' => $versionning,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Versionning $versionning, VersionningRepository $versionningRepository): Response
    {
        $form = $this->createForm(VersionningType::class, $versionning);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $versionningRepository->add($versionning);
            $this->addFlash('message', 'Le versionning a bien été modifié');
            return $this->redirectToRoute('app_back_versionning_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/versionning/edit.html.twig', [
            'versionning' => $versionning,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"POST"})
     */
    public function delete(Request $request, Versionning $versionning, VersionningRepository $versionningRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$versionning->getId(), $request->request->get('_token'))) {
            $versionningRepository->remove($versionning);
            $this->addFlash('message', 'Le versionning a bien été supprimé');
        }

        return $this->redirectToRoute('app_back_versionning_index', [], Response::HTTP_SEE_OTHER);
    }
}
