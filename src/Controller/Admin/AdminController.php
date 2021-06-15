<?php

namespace App\Controller\Admin;

use App\Entity\Gite;
use App\Form\GiteType;
use App\Repository\GiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{

    private GiteRepository $giteRepository;
    private EntityManagerInterface $em;

    /**
     * Undocumented function
     *
     * @param GiteRepository $giteRepository
     */
    public function __construct(GiteRepository $giteRepository, EntityManagerInterface $em)
    {
        $this->repo = $giteRepository;
        $this->em = $em;
    }
    /**
     * Undocumented function
     *@route("/admin",name="admin.index")
     * @return Response
     */
    public function index()
    {
        $gites = $this->repo->findAll();
        return $this->render('admin/index.html.twig',[
            'gites'=> $gites,
        ]);
    }

    /**
     * Undocumented function
     * @route("/admin/new", name ="admin.new")
     * @return void
     */
    public function new(Request $request)
    {
        $gite = new Gite();
        $form =$this->createForm(GiteType::class, $gite);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) 
        {
            $this->em->persist($gite);
            $this->em->flush();
            return $this->redirectToRoute('admin.index');
        }

        return $this->render('admin/new.html.twig', [
            "formGite" => $form ->createView(),
        ]);
    }
}
