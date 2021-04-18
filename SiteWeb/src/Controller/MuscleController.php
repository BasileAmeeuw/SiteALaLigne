<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MuscleRepository; 
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Muscle;
use Symfony\Component\HttpFoundation\Request;
use App\Form\MuscleType;

class MuscleController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/muscle', name: 'muscle')]
    public function index(MuscleRepository $repo): Response
    {

        $muscles = $repo->findAll();
        return $this->render('muscle/index.html.twig', [
            'controller_name' => 'MuscleController',
            'muscles' => $muscles,
        ]);
    }

    #[Route('/muscle/newOne', name:'muscle_creation')]
    #[Route('/muscle/modify/{id}', name:'muscle_modification')]
    public function newDay(Muscle $muscle = null, Request $request){
        $new=false;
        if ($muscle == null){
            $new=true;
            $muscle=new Muscle();
        }

        $manager=$this->entityManager;
        $form = $this->createForm(MuscleType::class, $muscle);                      
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($muscle);
            $manager->flush();

           return $this->redirectToRoute('muscle_detail', ['id' => $muscle->getId()]);
        }

        return $this->render('muscle/new.html.twig', [
            'formMuscle' => $form->createView(),
            'new' => $new,
            'nameMuscle' => $muscle->getNameOfMuscle()
        ]);
    }
    
    #[Route('/muscle/{id}', name: 'muscle_detail')]
    public function show(Muscle $muscle): Response
    {
        return $this->render('muscle/detail.html.twig', [
            'muscle' => $muscle
        ]);
    }

    #[Route('/muscle/delete/{id}',name:'muscle_delete')]
    public function delete(MuscleRepository $repo, Muscle $muscle) {
        $manager=$this->entityManager;
        $manager->remove($muscle);
        $manager->flush();

        $muscles=$repo->findAll();
        $this->addFlash('message', 'Muscle supprimé avec succès');

        return $this->render('muscle/index.html.twig', [
            'muscles'=>$muscles
        ]);
    }
}
