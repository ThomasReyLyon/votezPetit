<?php

  namespace App\DataFixtures;

  use App\Entity\Citoyen;

  use App\Service\Slugify;
  use Doctrine\Bundle\FixturesBundle\Fixture;
  use Doctrine\Common\Persistence\ObjectManager;
  use Doctrine\Common\DataFixtures\DependentFixtureInterface;
  use Faker;

  class CitoyenFixtures extends Fixture
  {

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
      $faker  =  Faker\Factory::create('fr_FR');


      for ($i=0; $i < 500; $i++) {
        $citoyen = new Citoyen();
        $citoyen->setNom($faker->name);
        $citoyen->setPrenom($faker->firstName);
        $citoyen->setNumeroElecteur($faker->ean8);
        $citoyen->setNombreVotes($faker->randomDigitNotNull);
        $citoyen->setNombrePropositions($faker->randomDigitNotNull);
        $manager->persist($citoyen);


      }
      $manager->flush();
    }


  }