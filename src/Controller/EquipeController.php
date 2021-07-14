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
    public function add(Request $request)
    {

        $equipe = new Equipe();

        $form = $this->createForm(EquipeformType::class, $equipe);


        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($equipe);
            $em->flush();

            return $this->redirectToRoute("addequipe");
        }
        return $this->render("equipe/add.html.twig", array("formajouter" => $form->createView()));
    }
    /**
     * @Route("/liste", name="liste")
     */
    public function liste(Request $req)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $equipes= $entityManager->getRepository(Equipe::class)->findAll();
        return $this->render('equipe/liste.html.twig', array('equipes' => $equipes));
    }
}
