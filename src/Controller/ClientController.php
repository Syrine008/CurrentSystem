<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use App\Entity\Achat;
use App\Form\AchatType;
use App\Entity\Vente;
use App\Form\VenteType;
use App\Repository\ClientRepository;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ClientController extends AbstractController
{
    /**
     * @Route("/client", name="app_client")
     */
    public function index(Request $request)
    {
      $propertySearch = new PropertySearch();
      $form = $this->createForm(PropertySearchType::class,$propertySearch);
      $form->handleRequest($request);
     //initialement le tableau des clients est vide, 
     //c.a.d on affiche les clients que lorsque l'utilisateur clique sur le bouton rechercher
      $client= [];
      
     if($form->isSubmitted() && $form->isValid()) {
     //on récupère le nom de clients tapé dans le formulaire
      $prenom = $propertySearch->getPrenom();   
      if ($prenom!="") 
        //si on a fourni un nom de client on affiche tous les clients ayant ce nom
        $client= $this->getDoctrine()->getRepository(client::class)->findBy(['prenom' => $prenom] );
      else   
        //si si aucun nom n'est fourni on affiche tous les clients
        $client= $this->getDoctrine()->getRepository(Client::class)->findAll();
     }
      return  $this->render('client/client.html.twig',[ 'form' =>$form->createView(), 'client' => $client]);  
    }

    /**
     * @Route("/client{id}", name="client_show")
     */
    public function show($id) {
        $client = $this->getDoctrine ()->getRepository (Client::class)->find($id);
        return $this->render('client/show.html.twig', ['client' => $client]);
    }
    
    /**
     * @Route("/client/edit{id}", name="client_edit")
     * @Method({"GET", "POST"})
     */
    public function Edit(Request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $client = $entityManager->getRepository(Client::class)->find($id);

        if (!$client){
            throw $this->createNotFoundException('client non trouvé avec l\'identifiant'. $id);
        }

        $form = $this->createForm(ClientType::class,$client);
        $form->handleRequest ($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // Enregistrer les modifications dans la base de données
            $entityManager->flush();
            // Redirection vers une autre page après la modification
            return  $this->redirectToRoute('app_client');
        }
        return $this->render('client/edit.html.twig',['form'=>$form->createView()]);
    }
 


    /**
     * @Route("/client/{id}", name="client_supp")
     */
    public function delete (Request $request, $id)
    {
        $client = $this->getDoctrine ()->getRepository (Client::class)->find($id);
        $entityManager = $this->getDoctrine ()->getManager();
        $entityManager->remove($client);
        $entityManager->flush();
        $response = new response();
        $response->send();
        return $this->redirectToRoute('app_client');
    }    
}
