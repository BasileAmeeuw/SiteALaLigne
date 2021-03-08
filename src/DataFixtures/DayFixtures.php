<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Day;
use App\DataFixtures\ActivityFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;

class DayFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        // $product = new Product();
        // $manager->persist($product);
        for ($i=0;$i<30;$i++){
            $j=rand(0,14);
            $day=new day();
            $day->setDate($faker->dateTimeBetween('now','+1 year'))
                ->setActivity($this->getReference(ActivityFixtures::AD[$j]));

            $manager->persist($day);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ActivityFixtures::class,
        ];
    }
}
