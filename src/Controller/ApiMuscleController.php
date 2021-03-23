<?php

namespace App\Controller;

use App\Repository\MuscleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

    #[Route('/api/muscle', name: 'api_muscle_create', methods:["POST"])]
    public function create(Request $request, SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $jsonRecu=$request->getContent();
        $en=$this->entityManager;
        try {
            $activity=$serializer->deserialize($jsonRecu, \App\Entity\Muscle::class, 'json');

            $errors=$validator->validate($activity);

            if (count($errors)>0){
                return $this->json($errors,400);
            }
            $en->persist($activity);
            $en->flush();

            return $this->json($activity, 201, [], ['groups' => 'getMuscleApi']);
        } catch(NotEncodableValueException $e){
            return $this->json([
                'status' => 400,
                "message d'erreur" => $e->getMessage(),
                'exception' => 'NotEncodableValueException'
            ], 400);
        }
    }
}
