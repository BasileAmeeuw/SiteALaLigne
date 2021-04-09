<?php

namespace App\Controller;

use App\Entity\Activity;
use App\Repository\ActivityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class ApiActivityController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

    }

    #[Route('/api', name: 'api')]
    #[Route('/api/home', name: 'api_home')]
    public function home(): Response
    {
        return $this->render('api/index.html.twig');
    }

    #[Route('/api/activity', name: 'api_activity_index', methods:["GET"])]
    public function index(ActivityRepository $activityRepository): Response
    {
        return $this->json($activityRepository->findAll(), 200, [], ['groups' => 'getActivityApi']);
    }

    #[Route('/api/activity', name: 'api_activity_create', methods:["POST"])]
    public function create(Request $request, SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $jsonRecu=$request->getContent();
        $en=$this->entityManager;
        
        try {
            $activity=$serializer->deserialize($jsonRecu, \App\Entity\Activity::class, 'json');

            $errors=$validator->validate($activity);

            if (count($errors)>0){
                return $this->json($errors,400);
            }
            
            $activity->setCreatedAt(new \DateTime());
            $en->persist($activity);
            $en->flush();

            return $this->json($activity, 201, [], ['groups' => 'getActivityApi']);
        } catch(NotEncodableValueException $e){
            return $this->json([
                'status' => 400,
                "message d'erreur" => $e->getMessage(),
                'exception' => 'NotEncodableValueException'
            ], 400);
        }
    }

    #[Route('/api/activity/{id}', name: 'api_activity_delete', methods:["DELETE"])]
    public function delete(Activity $activity)
    {
        try {
            $manager=$this->entityManager;
            $manager->remove($activity);
            $manager->flush();

            return $this->json([
                'status'=>200,
                'muscle_delete'=>$activity->getTitle()
            ]);
        } catch (NotFoundHttpException $e){
            return $this->json([
                'status'=> 400,
                'erreur' => $e->getMessage()
            ], 400);
        }
    }

    #[Route('/api/activity/{id}', name: 'api_activity_edit', methods:["PUT"])]
    public function edit(Request $request, Activity $activity, SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $jsonRecu=$request->getContent();
        $en=$this->entityManager;
        
        try {
            $activityJSON=$serializer->deserialize($jsonRecu, \App\Entity\Activity::class, 'json');

            $errors=$validator->validate($activityJSON);

            if (count($errors)>0){
                return $this->json($errors,400);
            }

            if ($activityJSON->getTitle() != null){
                $activity->setTitle($activityJSON->getTitle());
            } 
            if ($activityJSON->getDescription() != null){
                $activity->setDescription($activityJSON->getDescription());
            } 
            if ($activityJSON->getImage() != null){
                $activity->setImage($activityJSON->getImage());
            } 
            if ($activityJSON->getDuration() != null){
                $activity->setDuration($activityJSON->getDuration());
            } 
            if ($activityJSON->getDifficult() != null){
                $activity->setDifficult($activityJSON->getDifficult());
            } 
            if ($activityJSON->getAuthor() != null){
                $activity->setAuthor($activityJSON->getAuthor());
            } 
            if ($activityJSON->getMaterial() != null){
                $activity->setMaterial($activityJSON->getMaterial());
            } 
            if ($activityJSON->getMuscle() != null){
                $activity->setMuscle($activityJSON->getMuscle());
            } 
            foreach ($activityJSON->getDays() as $Day){
                $activity->addDay($Day);
            }
            $activity->setModifiedAt(new \DateTime());
            $en->persist($activity);
            $en->flush();

            return $this->json($activity, 201, [], ['groups' => 'getActivityApi']);
        } catch(NotEncodableValueException $e){
            return $this->json([
                'status' => 400,
                "message d'erreur" => $e->getMessage(),
                'exception' => 'NotEncodableValueException'
            ], 400);
        }
    }

    
}