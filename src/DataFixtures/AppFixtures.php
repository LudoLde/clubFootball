<?php

namespace App\DataFixtures;

use App\Entity\Club;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        for ($i = 0; $i < 30; $i++) {
            $club = new Club();
            $club->setNom('nom' . $i)
            ->setPays('Pays' . $i)
            ->setBudget(mt_rand(100000,1000000));
            $manager->persist($club);
        }
        $manager->flush();
    }
}
