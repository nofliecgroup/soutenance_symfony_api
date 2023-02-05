<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Driver;
use App\Entity\Students;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
       
       for ($i = 0; $i < 10; $i++) {
            $faker = Factory::create('fr_FR');
            $student = new Students();
            $student->setFirstName($faker->firstName());
            $student->setLastName($faker->lastName());
            $student->setEmailAddress($faker->email());
            $student->setPhoneNumber($faker->numberBetween($min = 500000000, $max = 9000000));
            $student->setDateOfBirth($faker->dateTimeBetween('-30 years', '-18 years'));
            
            $manager->persist($student);

            $studentDriverId[] = $student;
        }

        for ($i = 0; $i < 10; $i++) {
            $faker = Factory::create('fr_FR');
            $driver = new Driver();
            $driver->setFirstName($faker->firstName());
            $driver->setLastName($faker->lastName());
            $driver->setEmailAddress($faker->email());
            //$driver->setPhoneNumber($faker->mobileNumber());
            $driver->setPhoneNumber($faker->numberBetween($min = 500000000, $max = 9000000));
            $driver->setDateOfBirth($faker->dateTimeBetween('-30 years', '-18 years'));
            $driver->setPlateNumber($faker->numberBetween($min = 100000, $max = 9000000));
            $driver->setCarModel($faker->numerify( 'VW-###'));
            $driver->setIsDriving($faker->boolean($chanceOfGettingTrue = 50));  

            $driver->addPermitConduit($studentDriverId[$i]);

        
            $manager->persist($driver);

        }

   
        $manager->flush();
    }
}
