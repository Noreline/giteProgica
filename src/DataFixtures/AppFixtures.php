<?php

namespace App\DataFixtures;

use App\Entity\Equipement;
use Faker\Factory;
use App\Entity\Gite;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture

{
    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder) {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $equipements = [];

        $eq1 = new Equipement();
        $eq1 -> setName ('Piscine');

        $eq2 = new Equipement();
        $eq2 -> setName ('Sauna');

        $eq3 = new Equipement();
        $eq3 -> setName ('Jardin');

        $eq4 = new Equipement();
        $eq4 -> setName ('Télévision');

        $eq5 = new Equipement();
        $eq5 -> setName ('Wifi');

        $eq6 = new Equipement();
        $eq6 -> setName ('Lave-linge');

        array_push($equipements, $eq1, $eq2, $eq3, $eq4, $eq5, $eq6);

        $manager->persist($eq1);
        $manager->persist($eq2);
        $manager->persist($eq3);
        $manager->persist($eq4);
        $manager->persist($eq5);
        $manager->persist($eq6);

        $manager->flush();

        
        // $product = new Product();
        // $manager->persist($product);
        for ($i=0; $i < 50; $i++) { 
           
            $gite[$i] = new Gite();
            $gite[$i]->setAddress($faker->address());
            $gite[$i]->setSuperficy($faker->numberBetween(60, 180));
            $gite[$i]->setBedroom($faker->numberBetween(1, 4));
            $gite[$i]->setNbBed($faker->numberBetween(1, 4));
            $gite[$i]->setAnimals((bool)rand(0, 1));
            $gite[$i]->setPriceAnimals($faker->randomFloat(2, 5, 10));
            $gite[$i]->addEquipement($faker->randomElement($equipements));
            $gite[$i]->setPriceHightSeason($faker->randomFloat(2, 80, 180));
            $gite[$i]->setPriceLowSeason($faker->randomFloat(2, 50, 150));
            $gite[$i]->setName($faker->realText(50, 1));
            $gite[$i]->setDescript($faker->realText(500, 1));

            $manager->persist($gite[$i]);
        }


        $user1 = new User();
        $user1->setUsername('admin01')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword($this->encoder->hashPassword($user1, 'admin01'));
        $manager->persist($user1);

        $user2 = new User();
        $user2->setUsername('user01')
            ->setRoles(['ROLE_USER'])
            ->setPassword($this->encoder->hashPassword($user2, 'user01'));
        $manager->persist($user2);

        $user3 = new User();
        $user3->setUsername('user02')
            ->setRoles(['ROLE_USER'])
            ->setPassword($this->encoder->hashPassword($user3, 'user02'));
        $manager->persist($user3);

        $manager->flush();
    }
}
