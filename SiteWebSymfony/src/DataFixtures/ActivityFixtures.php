<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Activity;
use App\DataFixtures\MuscleFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;

class ActivityFixtures extends Fixture implements DependentFixtureInterface
{

    public const AD = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39];

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

    for ($i=1;$i<37;$i++){

        $activity=new Activity();
            $j=rand(0,25);
            $activity->setTitle($faker->words(mt_rand(1,9),true))
                    ->setDescription($faker->words(mt_rand(1,1500),true))
                    ->setMuscle($this->getReference(MuscleFixtures::AM[$j]))
                    ->setImage($faker->imageUrl())
                    ->setDuration(rand(1,120))
                    ->setAuthor($faker->name())
                    ->setMaterial($faker->words(mt_rand(1,15),true))
                    ->setCreatedAt($faker->dateTimeBetween('-5 years'))
                    ->setDifficult(rand(0,5));
            $manager->persist($activity);
            $this->addReference(self::AD[$i-1], $activity);
    }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            MuscleFixtures::class,
        ];
    }
}
