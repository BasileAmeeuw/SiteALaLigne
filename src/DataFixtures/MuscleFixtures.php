<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Muscle;
use Faker\Factory;

class MuscleFixtures extends Fixture
{
    public const AM=[100,101,102,103,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129];

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($i=1;$i<28;$i++){
            $muscle=new muscle();
            $muscle->setNameOfMuscle($faker->words(2,true))
                ->setImage($faker->imageUrl())
                ->setExtraExpl($faker->words(1500,true));

            $manager->persist($muscle);
            $this->addReference(self::AM[$i-1], $muscle);    
        }

        $manager->flush();

        
    }
}
