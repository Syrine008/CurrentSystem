<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Form\CoursType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CoursController extends AbstractController
{

    /**
     * @Route("/cours", name="app_cours")
     */
    public function home()
    {
        $cours = $this->getDoctrine()->getRepository(Cours::class)->findAll();
        $form = $this->createForm(CoursType::class); // Créer le formulaire sans données
        return $this->render('cours/cours.html.twig', ['cours' => $cours, 'form' => $form->createView()]);
        
    }
    
    
    /**
     * @Route("/cours/edit/{id}", name="cours_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        // Récupérer le cours à modifier depuis la base de données
        $cours = $entityManager->getRepository(Cours::class)->find($id);

        // Vérifier si le cours existe
        if (!$cours) {
            throw $this->createNotFoundException('Cours non trouvé avec l\'identifiant ' . $id);
        }

        $form = $this->createForm(CoursType::class, $cours);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cours->setDate(new \DateTime());
            // Enregistrer les modifications dans la base de données
            $entityManager->flush();

            // Redirection vers une autre page après la modification
            return $this->redirectToRoute('app_cours');
        }

        return $this->render('cours/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }


    
    // public function index(Request $request): Response
    // {
    //     $entityManager = $this->getDoctrine()->getManager();
    //     $cours = $entityManager->getRepository(Cours::class)->findAll();
    //     return $this->render('cours/cours.html.twig', ['cours' => $cours]);

    //     $form = $this->createForm(CoursType::class, null, [
    //         'cours' => $cours,
    //     ]);

    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $cours = $form->getData();
    //         $entityManager->persist($cours);
    //         $entityManager->flush();

    //         return $this->redirectToRoute('app_cours');
    //     }

    //     return $this->render('cours/cours.html.twig', [
    //         'form' => $form->createView(),
    //     ]);
    // }
}
