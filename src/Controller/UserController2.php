<?php

namespace App\Controller;

use App\Entity\User2;
use App\Form\UserType;
use App\Repository\UserRepository2;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user2")
 */
class UserController2 extends AbstractController
{
    /**
     * @Route("/", name="user2_index", methods={"GET"})
     */
    public function index(UserRepository2 $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository2->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="user2_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $user2 = new User2();
        $form = $this->createForm(UserType::class, $user2);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user2);
            $entityManager->flush();

            return $this->redirectToRoute('user2_index');
        }

        return $this->render('user2/new.html.twig', [
            'user2' => $user2,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user2_show", methods={"GET"})
     */
    public function show(User2 $user2): Response
    {
        return $this->render('user/show.html.twig', [
            'user2' => $user2,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user2_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User2 $user2): Response
    {
        $form = $this->createForm(UserType::class, $user2);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user2_index');
        }

        return $this->render('user2/edit.html.twig', [
            'user2' => $user2,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user2_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User2 $user2): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user2->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user2);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user2_index');
    }
}
