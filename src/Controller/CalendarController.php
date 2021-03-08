<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\DayRepository; 
use App\Entity\Day;
use Symfony\Component\HttpFoundation\Request;
use App\Form\DayType;


class CalendarController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/agenda', name: 'agenda')]
    public function index(DayRepository $repo): Response
    {

        $days = $repo->findBy(array(),array('date'=>'ASC'));
        return $this->render('calendar/index.html.twig', [
            'controller_name' => 'CalendarController',
            'days' => $days
        ]);
    }

    #[Route('/agenda/newOne', name:'agenda_creation')]
    #[Route('/agenda/modify/{id}', name:'agenda_modification')]
    public function newDay(Day $day = null, Request $request){
        $new=false;
        if (!$day){
            $new;
            $day=new Day();
        }

        $manager=$this->entityManager;
        $form = $this->createForm(DayType::class, $day);
                                
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($day);
            $manager->flush();
        
            if ($day->getActivity() == null){
                return $this->redirectToRoute('agenda');
            } else {
                return $this->redirectToRoute('agenda_detail', ['id' => $day->getId()]);
            }
            
        }

        return $this->render('calendar/new.html.twig', [
            'formDay' => $form->createView(),
            'new' => $new,
            'jour' => $day->getDate()
        ]);
    }

    #[Route('/agenda/{id}', name: 'agenda_detail')]
    public function show(Day $day): Response
    {
        $now=new \DateTime();
        $interval=$now->diff($day->getDate());
        return $this->render('calendar/detail.html.twig', [
            'day' => $day,
            'interval' => $interval
        ]);
    }

    #[Route('/agenda/delete/{id}',name:'agenda_delete')]
    public function delete(DayRepository $repo, Day $day) {
        $manager=$this->entityManager;
        $manager->remove($day);
        $manager->flush();

        $days=$repo->findAll();
        $this->addFlash('message', 'jour supprimé avec succès');

        return $this->render('calendar/index.html.twig', [
            'days'=>$days
        ]);
    }

    
}
