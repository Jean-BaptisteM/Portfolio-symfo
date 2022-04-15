<?php

namespace App\Controller\Back;

use App\Entity\Language;
use App\Form\LanguageType;
use App\Repository\LanguageRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 * @Route("/back/language", name="app_back_language_", requirements={"id"="\d+"})
 */
class LanguageController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(LanguageRepository $languageRepository): Response
    {
        return $this->render('back/language/index.html.twig', [
            'languages' => $languageRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="new", methods={"GET", "POST"})
     */
    public function new(Request $request, LanguageRepository $languageRepository): Response
    {
        $language = new Language();
        $form = $this->createForm(LanguageType::class, $language);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $languageRepository->add($language);
            $this->addFlash('message', 'Le langage a bien été ajouté');
            return $this->redirectToRoute('app_back_language_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/language/new.html.twig', [
            'language' => $language,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(Language $language): Response
    {
        return $this->render('back/language/show.html.twig', [
            'language' => $language,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Language $language, LanguageRepository $languageRepository): Response
    {
        $form = $this->createForm(LanguageType::class, $language);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $languageRepository->add($language);
            $this->addFlash('message', 'Le langage a bien été modifié');
            return $this->redirectToRoute('app_back_language_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/language/edit.html.twig', [
            'language' => $language,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"POST"})
     */
    public function delete(Request $request, Language $language, LanguageRepository $languageRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$language->getId(), $request->request->get('_token'))) {
            $languageRepository->remove($language);
            $this->addFlash('message', 'Le langage a bien été supprimé');
        }

        return $this->redirectToRoute('app_back_language_index', [], Response::HTTP_SEE_OTHER);
    }
}
