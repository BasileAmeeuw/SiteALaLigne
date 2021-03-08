<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Activity;
use App\Repository\ActivityRepository; 
use App\Repository\DayRepository;
use App\Repository\MuscleRepository; ;
use App\Form\ActivityType;

class ActivityController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

    }

    #[Route('/', name: 'choix')]
    public function accueil(ActivityRepository $repo, MuscleRepository $repo2, DayRepository $repo3): Response
    {
        $activities = $repo->findAll();
        $muscles = $repo2->findAll();
        $days = $repo3->findAll();
        return $this->render('activity/accueil.html.twig', [
            'controller_name' => 'ActivityController',
            'activities' => $activities,
            'muscles' => $muscles,
            'days' => $days
        ]);
    }

    

    #[Route('/activity', name: 'activity')]
    public function index(ActivityRepository $repo): Response
    {
        $activities = $repo->findAll();
        return $this->render('activity/index.html.twig', [
            'controller_name' => 'ActivityController',
            'activities' => $activities,
        ]);
    }

    #[Route('/activity/newOne', name:'activity_creation')]
    #[Route('/activity/modify/{id}', name:'activity_modification')]
    public function newActivity(Activity $activity = null, Request $request){

        $new=true;
        if (!$activity){
            $activity = new Activity();
            $activity->setCreatedAt(new \DateTime());
        } else {
            $new=false;
            $activity->setModifiedAt(new \DateTime());
        }
        $manager=$this->entityManager;
        $form = $this->createForm(ActivityType::class, $activity);
                                
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($activity);
            $manager->flush();

            return $this->redirectToRoute('activity_detail', ['id' => $activity->getId()]);
        }

        return $this->render('activity/new.html.twig', [
            'formActivity' =>$form->createView(),
            'new'=>$new,
            'nom'=>$activity->getTitle()
        ]);
    }

    

    #[Route('/activity/{id}', name: 'activity_detail')]
    public function show(Activity $activity): Response
    {
        return $this->render('activity/detail.html.twig', [
            'activity' => $activity
        ]);
    }

    #[Route('/activity/author/{id}', name: 'activity_author')]
    public function activitiesForOneAuthor(Activity $activity, ActivityRepository $repo): Response
    {

        $activities = $repo->findBy(array('author' => $activity->getAuthor()));
        return $this->render('activity/author.html.twig', [
            'activities' => $activities,
        ]);
    }

    #[Route('/activity/delete/{id}',name:'activity_delete')]
    public function delete(ActivityRepository $repo, Activity $activity) {
        $manager=$this->entityManager;
        $manager->remove($activity);
        $manager->flush();

        $activities=$repo->findAll();
        $this->addFlash('message', 'Activité supprimée avec succès');

        return $this->render('activity/index.html.twig', [
            'activities'=>$activities
        ]);
    }
}
