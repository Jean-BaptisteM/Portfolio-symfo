<?php

namespace App\Controller\Back;

use App\Entity\Cms;
use App\Form\CmsType;
use App\Repository\CmsRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 * @Route("/back/cms", name="app_back_cms_", requirements={"id"="\d+"})
 */
class CmsController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(CmsRepository $cmsRepository): Response
    {
        return $this->render('back/cms/index.html.twig', [
            'cmss' => $cmsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="new", methods={"GET", "POST"})
     */
    public function new(Request $request, CmsRepository $cmsRepository): Response
    {
        $cms = new Cms();
        $form = $this->createForm(CmsType::class, $cms);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cmsRepository->add($cms);
            $this->addFlash('message', 'Le CMS a bien été ajouté');
            return $this->redirectToRoute('app_back_cms_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/cms/new.html.twig', [
            'cms' => $cms,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(Cms $cms): Response
    {
        return $this->render('back/cms/show.html.twig', [
            'cms' => $cms,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Cms $cms, CmsRepository $cmsRepository): Response
    {
        $form = $this->createForm(CmsType::class, $cms);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cmsRepository->add($cms);
            $this->addFlash('message', 'Le CMS a bien été modifié');
            return $this->redirectToRoute('app_back_cms_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/cms/edit.html.twig', [
            'cms' => $cms,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"POST"})
     */
    public function delete(Request $request, Cms $cms, CmsRepository $cmsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cms->getId(), $request->request->get('_token'))) {
            $cmsRepository->remove($cms);
            $this->addFlash('message', 'Le CMS a bien été supprimé');
        }

        return $this->redirectToRoute('app_back_cms_index', [], Response::HTTP_SEE_OTHER);
    }
}
