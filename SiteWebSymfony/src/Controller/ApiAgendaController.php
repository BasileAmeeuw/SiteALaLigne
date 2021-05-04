<?php

namespace App\Controller;

use App\Entity\Day;
use App\Repository\DayRepository;
use App\Repository\ActivityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;

class ApiAgendaController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

    }
    
    #[Route('/api/agenda', name: 'api_agenda_index', methods:["GET"])]
    public function index(DayRepository $dayRepository): Response
    {
        return $this->json($dayRepository->findAll(), 200, [], ['groups' => 'getDayApi']);
    }

    #[Route('/api/agenda/{id}', name: 'api_agenda_id', methods:["GET"])]
    public function search(Day $day): Response
    {
        return $this->json($day, 200, [], ['groups' => 'getDayApi']);
    }


    #[Route('/api/agenda', name: 'api_agenda_create', methods:["POST"])]
    public function create(ActivityRepository $activityRepository, Request $request, SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $jsonRecu=$request->getContent();
        $en=$this->entityManager;
        try {
            $day=$serializer->deserialize($jsonRecu, \App\Entity\Day::class, 'json');
            $activity=$day->getActivity();
            if ($activity != null) {
                $activityName=$activity->getTitle();
                $existingActivity=$activityRepository->findOneBy(["title"=>$activityName]);
                if ($existingActivity != null){
                    $day->setActivity($existingActivity);
                } else{
                    return $this->json([
                        'status' => 401,
                        "message d'erreur" => "Vous n'avez pas rentré une activité existante dans la DB",
                        'activity' => $activity
                    ]);
                }
            }


            $errors=$validator->validate($day);

            if (count($errors)>0){
                return $this->json($errors,400);
            }
            $en->persist($day);
            $en->flush();

            return $this->json($day, 201, [], ['groups' => 'getDayApi']);
        } catch(NotEncodableValueException $e){
            return $this->json([
                'status' => 400,
                "message d'erreur" => $e->getMessage(),
                'exception' => 'NotEncodableValueException'
            ], 400);
        }
    }

    #[Route('/api/agenda/{id}',name:'api_agenda_delete', methods:["DELETE"])]
    public function delete(Day $day) {
        try{
            $manager=$this->entityManager;
            $manager->remove($day);
            $manager->flush();

            return $this->json([
                'status'=>200,
                'day_delete'=>$day->getDate()
            ]);
        } catch (NotFoundHttpException $e){
            return $this->json([
                'status'=> 400,
                'erreur' => $e->getMessage()
            ], 400);
        }
    }


    #[Route('/api/agenda/{id}', name: 'api_agenda_edit', methods:["PUT"])]
    public function edit(ActivityRepository $activityRepository, Request $request, Day $day, SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $jsonRecu=$request->getContent();
        $en=$this->entityManager;
        
        try {
            $dayJSON=$serializer->deserialize($jsonRecu, \App\Entity\Day::class, 'json');

            if ($dayJSON->getDate() != null){
                $day->setDate($dayJSON->getDate());
            } 
            if ($dayJSON->getActivity() != null){
                $activity=$day->getActivity();
                $activityId=$activity->getId();
                $existingActivity=$activityRepository->findOneBy(["id"=>$activityId]);
                if ($existingActivity != null){
                    $day->setActivity($existingActivity);
                } else{
                    return $this->json([
                        'status' => 401,
                        "message d'erreur" => "Vous n'avez pas rentré une activité existante dans la DB"
                    ]);
                }
            } 
            
            $en->persist($day);
            $en->flush();

            return $this->json($day, 201, [], ['groups' => 'getDayApi']);
        } catch(NotEncodableValueException $e){
            return $this->json([
                'status' => 400,
                "message d'erreur" => $e->getMessage(),
                'exception' => 'NotEncodableValueException'
            ], 400);
        }
    }
}
