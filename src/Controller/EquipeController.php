<?php

namespace App\Controller;

use App\Entity\Equipe;
use App\Form\EquipeformType;
use App\Repository\EquipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
class EquipeController extends AbstractController
{
    /**
     * @Route("/equipe", name="equipe")
     */
    public function index(): Response
    {
        return $this->render('equipe/index.html.twig', [
            'controller_name' => 'EquipeController',
        ]);
    }
    /**
     * @Route("/addequipe", name="addequipe")
     */
    public function add(EquipeRepository $repository,Request $request)
    {
        $listesequipes=$repository->findAll();
        $equipe = new Equipe();

        $form = $this->createForm(EquipeformType::class, $equipe);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($equipe);
            $em->flush();

            return $this->redirectToRoute("addequipe");
        }
        return $this->render("equipe/add.html.twig", array("formajouter" => $form->createView()));
    }
}
