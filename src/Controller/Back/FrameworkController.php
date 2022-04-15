<?php

namespace App\Controller\Back;

use App\Entity\Framework;
use App\Form\FrameworkType;
use App\Repository\FrameworkRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 * @Route("/back/framework", name="app_back_framework_", requirements={"id"="\d+"})
 */
class FrameworkController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(FrameworkRepository $frameworkRepository): Response
    {
        return $this->render('back/framework/index.html.twig', [
            'frameworks' => $frameworkRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="new", methods={"GET", "POST"})
     */
    public function new(Request $request, FrameworkRepository $frameworkRepository): Response
    {
        $framework = new Framework();
        $form = $this->createForm(FrameworkType::class, $framework);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $frameworkRepository->add($framework);
            $this->addFlash('message', 'Le framework a bien été ajouté');
            return $this->redirectToRoute('app_back_framework_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/framework/new.html.twig', [
            'framework' => $framework,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(Framework $framework): Response
    {
        return $this->render('back/framework/show.html.twig', [
            'framework' => $framework,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Framework $framework, FrameworkRepository $frameworkRepository): Response
    {
        $form = $this->createForm(FrameworkType::class, $framework);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $frameworkRepository->add($framework);
            $this->addFlash('message', 'Le framework a bien été modifié');
            return $this->redirectToRoute('app_back_framework_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/framework/edit.html.twig', [
            'framework' => $framework,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"POST"})
     */
    public function delete(Request $request, Framework $framework, FrameworkRepository $frameworkRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$framework->getId(), $request->request->get('_token'))) {
            $frameworkRepository->remove($framework);
            $this->addFlash('message', 'Le framework a bien été supprimé');
        }

        return $this->redirectToRoute('app_back_framework_index', [], Response::HTTP_SEE_OTHER);
    }
}
