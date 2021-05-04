<?php

namespace App\Controller;

use App\Entity\Muscle;
use App\Repository\MuscleRepository;
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


class ApiMuscleController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

    }
    
    #[Route('/api/muscle', name: 'api_muscle_index', methods:["GET"])]
    public function index(MuscleRepository $muscleRepository): Response
    {
        return $this->json($muscleRepository->findAll(), 200, [], ['groups' => 'getMuscleApi']);
    }

    #[Route('/api/muscle/{id}', name: 'api_muscle_id', methods:["GET"])]
    public function search(Muscle $muscle): Response
    {
        return $this->json($muscle, 200, [], ['groups' => 'getMuscleApi']);
    }

    #[Route('/api/muscle', name: 'api_muscle_create', methods:["POST"])]
    public function create(Request $request, SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $jsonRecu=$request->getContent();
        $en=$this->entityManager;
        try {
            $muscle=$serializer->deserialize($jsonRecu, \App\Entity\Muscle::class, 'json');

            $errors=$validator->validate($muscle);

            if (count($errors)>0){
                return $this->json($errors,400);
            }
            $en->persist($muscle);
            $en->flush();

            return $this->json($muscle, 201, [], ['groups' => 'getMuscleApi']);
        } catch(NotEncodableValueException $e){
            return $this->json([
                'status' => 400,
                "message d'erreur" => $e->getMessage(),
                'exception' => 'NotEncodableValueException'
            ], 400);
        }
    }

    #[Route('/api/muscle/{id}',name:'api_muscle_delete', methods:["DELETE"])]
    public function delete(Muscle $muscle) {
        try{
            $manager=$this->entityManager;
            $manager->remove($muscle);
            $manager->flush();

            return $this->json([
                'status'=>200,
                'muscle_delete'=>$muscle->getNameOfMuscle()
            ]);
        } catch (NotFoundHttpException $e){
            return $this->json([
                'status'=> 400,
                'erreur' => $e->getMessage()
            ], 400);
        }
    }


    #[Route('/api/muscle/{id}', name: 'api_muscle_edit', methods:["PUT"])]
    public function edit(ActivityRepository $activityRepository,Request $request, Muscle $muscle, SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $jsonRecu=$request->getContent();
        $en=$this->entityManager;
        
        try {
            $muscleJSON=$serializer->deserialize($jsonRecu, \App\Entity\Muscle::class, 'json');


            if ($muscleJSON->getNameOfMuscle() != null){
                $muscle->setNameOfMuscle($muscleJSON->getNameOfMuscle());
            } 
            if ($muscleJSON->getExtraExpl() != null){
                $muscle->setExtraExpl($muscleJSON->getExtraExpl());
            } 
            if ($muscleJSON->getImage() != null){
                $muscle->setImage($muscleJSON->getImage());
            } 
            foreach ($muscleJSON->getActivities() as $Act){
                $activityTitle=$Act->getTitle();
                $existingActivity=$activityRepository->findOneBy(["title"=>$activityTitle]);
                if ($existingActivity != null) {
                    $muscle->addActivity($existingActivity);
                } else {
                    return $this->json([
                        'status' => 401,
                        "message d'erreur" => "Vous n'avez pas rentré une activité existante dans la DB (" + $Act->getTitle() + ")"
                    ]);
                }
            }
            $en->persist($muscle);
            $en->flush();

            return $this->json($muscle, 201, [], ['groups' => 'getMuscleApi']);
        } catch(NotEncodableValueException $e){
            return $this->json([
                'status' => 400,
                "message d'erreur" => $e->getMessage(),
                'exception' => 'NotEncodableValueException'
            ], 400);
        }
    }
}
