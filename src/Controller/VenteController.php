<?php

namespace App\Controller;

use App\Entity\Vente;
use App\Form\VenteType;
use App\Entity\Devise;
use App\Form\DeviseType;
use App\Entity\Cours;
use App\Form\CoursType;
use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use App\Repository\VenteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class VenteController extends AbstractController
{

 /**
     * @Route("/vente", name="app_vente")
     */
    public function home()
    {
        $client = $this->getDoctrine()->getRepository(Client::class)->findAll();
        $form = $this->createForm(ClientType::class); // Créer le formulaire sans données
        return $this->render('vente/client.html.twig', ['client' => $client, 'form' => $form->createView()]);
        
    }    
/**
 * @Route("/vente/newClient",name="app_vente", methods={"GET","POST"})
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

             return $this->redirectToRoute('app_convertir');
         }

         return $this->render('vente/client.html.twig', [
             'client' => $client,
             'form' => $form->createView(),
         ]);
     }

      /**
     * @Route("/vente/info", name="app_convertir")
     */
    public function vente()
    {
        $vente = $this->getDoctrine()->getRepository(Vente::class)->findAll();
        $form = $this->createForm(VenteType::class); // Créer le formulaire sans données
        return $this->render('vente/vente.html.twig', ['vente' => $vente, 'form' => $form->createView()]);
        
    } 

     /**
 * @Route("/vente/Conversion",name="app_convertir", methods={"GET","POST"})
 */
public function conversion(Request $request)
{
    $vente = new Vente();
    $form= $this->createForm(VenteType::class ,$vente);
    $form -> handleRequest($request);
    if($form->isSubmitted() && $form->isValid()){
        $vente = $form->getData();
        $entityManager=$this->getDoctrine()->getManager();
        $entityManager->persist($vente);
        $entityManager->flush();    
}
return $this->render('vente/vente.html.twig',['form' => $form->createView()]);


}
}
