<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Gite;
use App\Form\ContactType;
use App\Entity\GiteSearch;
use App\Form\GiteSearchType;
use App\Notification\ContactNotification;
use App\Repository\GiteRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GiteController extends AbstractController
{
    public function __construct(GiteRepository $giteRepository)
    {
        $this ->repo = $giteRepository;
    }
    /**
     * @Route("/gite/{id}", name="gite.show")
     */
    public function show(int $id, Gite $gite, Request $request, ContactNotification $notification): Response
    {
        $gite = $this->repo->find($id);

        $contact = new Contact();
        $contact->setGite($gite);
        $form = $this->createForm(ContactType::class, $contact);
        $form -> handleRequest ($request);

        if ($form->isSubmitted() && $form -> isValid()){
            $notification-> notify($contact);
            $this->addFlash('success', 'Votre email a bien été envoyé');
        
            return $this->redirectToRoute('gite.show',[
                'id' => $gite->getId()]);
            
        }

        return $this->render('gite/show.html.twig', [
           "gite" => $gite,
           'form'=> $form->createView()
           
        ]);
    }


    /**
     * @Route("/gites", name="gite.list")
     */
    public function list(Request $request)
    {
        // Créer une entité Recherche
        //Créer le formulaire associés
        //Gerer le traitement des données via SQL

        $search = new GiteSearch();
        $form = $this->createForm(GiteSearchType::class, $search);
        $form -> handleRequest($request);

        $gites = $this->repo->findAllGiteSearch($search);

        return $this->render('gite/list.html.twig', [
            'gites'=>$gites,
            'form'=>$form->createView(),
        ]);
    }

    /**
     * Undocumented function
     *@Route("/", name="gite.index")
     * @return void
     */
    public function index()
    {
        $gites = $this->repo->findLastGite();

        return $this->render('gite/index.html.twig',[
            'gites' => $gites
        ]);
    }

}