<?php

namespace App\Controller\Back;

use App\Entity\Database;
use App\Form\DatabaseType;
use App\Repository\DatabaseRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 * @Route("/back/database", name="app_back_database_", requirements={"id"="\d+"})
 */
class DatabaseController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(DatabaseRepository $databaseRepository): Response
    {
        return $this->render('back/database/index.html.twig', [
            'databases' => $databaseRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="new", methods={"GET", "POST"})
     */
    public function new(Request $request, DatabaseRepository $databaseRepository): Response
    {
        $database = new Database();
        $form = $this->createForm(DatabaseType::class, $database);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $databaseRepository->add($database);
            $this->addFlash('message', 'Le langage de database a bien été ajouté');
            return $this->redirectToRoute('app_back_database_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/database/new.html.twig', [
            'database' => $database,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(Database $database): Response
    {
        return $this->render('back/database/show.html.twig', [
            'database' => $database,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Database $database, DatabaseRepository $databaseRepository): Response
    {
        $form = $this->createForm(DatabaseType::class, $database);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $databaseRepository->add($database);
            $this->addFlash('message', 'Le langage de database a bien été modifié');
            return $this->redirectToRoute('app_back_database_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/database/edit.html.twig', [
            'database' => $database,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"POST"})
     */
    public function delete(Request $request, Database $database, DatabaseRepository $databaseRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$database->getId(), $request->request->get('_token'))) {
            $databaseRepository->remove($database);
            $this->addFlash('message', 'Le langage de database a bien été supprimé');
        }

        return $this->redirectToRoute('app_back_database_index', [], Response::HTTP_SEE_OTHER);
    }
}
