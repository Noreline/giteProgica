<?php

namespace App\Controller;

use App\Repository\GiteRepository;
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
    public function show(int $id): Response
    {
        $gite = $this->repo->find($id);

        return $this->render('gite/show.html.twig', [
           "gite" => $gite,
        ]);
    }


    /**
     * @Route("/gites", name="gite.list")
     */
    public function list(): Response
    {
        $gites = $this->repo->findAll();
        return $this->render('gite/list.html.twig', [
            'gites'=>$gites,
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
