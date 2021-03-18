<?php

namespace App\Controller;

use App\Entity\Solidaire;
use App\Form\SolidaireType;
use App\Repository\SolidaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/solidaire")
 */
class SolidaireController extends AbstractController
{
    /**
     * @Route("/", name="solidaire_index", methods={"GET"})
     */
    public function index(SolidaireRepository $solidaireRepository): Response
    {
        return $this->render('solidaire/index.html.twig', [
            'solidaires' => $solidaireRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="solidaire_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $solidaire = new Solidaire();
        $form = $this->createForm(SolidaireType::class, $solidaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($solidaire);
            $entityManager->flush();

            return $this->redirectToRoute('solidaire_index');
        }

        return $this->render('solidaire/new.html.twig', [
            'solidaire' => $solidaire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="solidaire_show", methods={"GET"})
     */
    public function show(Solidaire $solidaire): Response
    {
        return $this->render('solidaire/show.html.twig', [
            'solidaire' => $solidaire,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="solidaire_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Solidaire $solidaire): Response
    {
        $form = $this->createForm(SolidaireType::class, $solidaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('solidaire_index');
        }

        return $this->render('solidaire/edit.html.twig', [
            'solidaire' => $solidaire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="solidaire_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Solidaire $solidaire): Response
    {
        if ($this->isCsrfTokenValid('delete'.$solidaire->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($solidaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('solidaire_index');
    }
}
