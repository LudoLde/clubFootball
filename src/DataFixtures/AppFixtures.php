<?php

namespace App\DataFixtures;

use App\Entity\Club;
use App\Entity\Joueur;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class AppFixtures extends Fixture
{   

    private Generator $faker;
    public function __construct()
    {
        $this->faker =Factory::create('fr_FR', 'en_EN');
    }

    public function load(ObjectManager $manager): void
    {
        //Club
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 40; $i++) {
            $club = new Club();
            $club->setNom($faker->city . ' ' . $faker->randomElement(['FC', 'United', 'City', 'Athletic', 'Town', 'Olympic']))
            ->setPays($this->faker->country())
            ->setBudget(mt_rand(100000, 2000000));

            $manager->persist($club);
        }
        $manager->flush();
        
        //Joueur
        $entityManager = $manager;
        $clubs = $entityManager->getRepository(Club::class)->findAll();
        for ($i = 0; $i < 100; $i++) {
            $joueur = new Joueur();
            $joueur->setFirstName($this->faker->firstNameMale())
            ->setnom($this->faker->lastName())
            ->setAge(mt_rand(16, 45))
            ->setNumero(mt_rand(0, 99))
            ->setNationalite($this->faker->country());
            $randomClub = $clubs[array_rand($clubs)];
            $joueur->setClub($randomClub);

            $manager->persist($joueur);
        }
        $manager->flush();
        
        //User
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setFullName($this->faker->name())
            ->setPseudo(mt_rand(0, 1) === 1 ? $this->faker->firstName() : 'defaultPseudo'. $i)
            ->setEmail($this->faker->email())
            ->setRoles(['ROLE_USER'])
            ->setPlainPassword('password');

            $manager->persist($user);
        }
        
        $manager->flush();
    }
}
