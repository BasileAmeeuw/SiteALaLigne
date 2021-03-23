<?php

namespace App\Controller;

use App\Repository\ActivityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ApiActivityController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

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
        $activity=$serializer->deserialize($jsonRecu, \App\Entity\Activity::class, 'json');

        $activity->setCreatedAt(new \DateTime());

         $en->persist($activity);
         $en->flush();

         return $this->json($activity, 201, [], ['groups' => 'getActivityApi']);

    }
}
