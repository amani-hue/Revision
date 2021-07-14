<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Form\AddProjetType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ProjetController extends AbstractController
{
    /**
     * @Route("/projet", name="projet")
     */
    public function index(): Response
    {
        return $this->render('projet/index.html.twig', [
            'controller_name' => 'ProjetController',
        ]);
    }
    /**
     * @Route("/add", name="addProjet")
     */
    public function add(Request $request)
    {
        $projet = new Projet();
        $form = $this->createForm(AddProjetType::class, $projet);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($projet);
            $em->flush();
            return $this->redirectToRoute("projet");
        }
        return $this->render("projet/add.html.twig", array("formajouter" => $form->createView()));
    }
    /**
     * @Route("/update/{id}", name="updateClassroom")
     */
    public function update($id, Request $request)
    {
        $projet = $this->getDoctrine()->getRepository(Projet::class)->find($id);
        $form = $this->createForm(AddProjetType::class, $projet);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("projet");
        }
        return $this->render("projet/update.html.twig", array("formajouter" => $form->createView()));
    }
    /**
     * @Route("/remove/{id}", name="removeClassroom")
     */
    public function delete($id)
    {
        $projet = $this->getDoctrine()->getRepository(Projet::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($projet);
        $em->flush();
        return $this->redirectToRoute("projet");
    }
}
