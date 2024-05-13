<?php

namespace App\Controller;

use App\Entity\Achat;
use App\Form\AchatType;
use App\Entity\Devise;
use App\Form\DeviseType;
use App\Entity\Cours;
use App\Form\CoursType;
use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use App\Repository\AchatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AchatController extends AbstractController
{

 /**
     * @Route("/achat", name="app_achat")
     */
    public function home()
    {
        $client = $this->getDoctrine()->getRepository(Client::class)->findAll();
        $form = $this->createForm(ClientType::class); // Créer le formulaire sans données
        return $this->render('achat/client.html.twig', ['client' => $client, 'form' => $form->createView()]);
        
    }    
/**
 * @Route("/achat/newClient",name="app_achat", methods={"GET","POST"})
 */
 public function new(Request $request, ClientRepository $clientRepository): Response
     {
         $client = new Client();
         $form = $this->createForm(ClientType::class, $client);
         $form->handleRequest($request);

         if ($form->isSubmitted() && $form->isValid()) {
             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($client);
             $entityManager->flush();

             return $this->redirectToRoute('app_conversion');
         }

         return $this->render('achat/client.html.twig', [
             'client' => $client,
             'form' => $form->createView(),
         ]);
     }

      /**
     * @Route("/achat/info", name="app_conversion")
     */
    public function achat()
    {
        $achat = $this->getDoctrine()->getRepository(Achat::class)->findAll();
        $form = $this->createForm(AchatType::class); // Créer le formulaire sans données
        return $this->render('achat/achat.html.twig', ['achat' => $achat, 'form' => $form->createView()]);
        
    } 

     /**
 * @Route("/achat/Conversion",name="app_conversion", methods={"GET","POST"})
 */
public function conversion(Request $request, AchatRepository $achatRepository): Response
     {
         $achat = new Achat();
         $form = $this->createForm(AchatType::class, $achat);
         $form->handleRequest($request);

         if ($form->isSubmitted() && $form->isValid()) {
             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($achat);
             $entityManager->flush();

             return $this->redirectToRoute('app_achat');
         }

         return $this->render('achat/achat.html.twig', [
             'achat' => $achat,
             'form' => $form->createView(),
         ]);
     }


  


    // public function home(Request $request) : Response
    // {
    //     $achat = $this->getDoctrine()->getRepository(Achat::class)->findAll();
    //     $form = $this->createForm(AchatType::class); // Créer le formulaire sans données
    //     $form->handleRequest($request);

    //     // Vérifier si le formulaire a été soumis et est valide
    //     if ($form->isSubmitted() && $form->isValid()) {
    //     // Récupérer les données du formulaire
    //     $data = $form->getData();
        
    //     // Enregistrer les données dans la base de données
    //     $entityManager->persist($achat);
    //     $entityManager->flush();

    //     // Rediriger l'utilisateur ou afficher un message de succès
    //     return $this->redirectToRoute('app_achat');
    //     }
    //     return $this->render('achat/new.html.twig', ['achat' => $achat, 'form' => $form->createView()]);
        
    // }

//     /**
//      * @Route("/convert", name="app_convert")
//      */
//     public function calculateConvert(Request $request)
// {
//     $entityManager = $this->getDoctrine()->getManager();
//     $achats = $this->getDoctrine()->getRepository(Achat::class)->findAll();

//     foreach ($achats as $achat) {
//         // Calculer le montant converti
//         $montantConvertit = $achat->getMontantAchat() * $achat->getPrixAchat()->getPrixAchat();
//         $achat->setMontantConvertit($montantConvertit);
        
//         // Enregistrer les modifications dans la base de données
//         $entityManager->persist($achat);
//     }

//     $entityManager->flush();

//     return $this->redirectToRoute('app_achat');
// }
}
