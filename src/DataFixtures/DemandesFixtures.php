<?php

namespace App\DataFixtures;

use App\Entity\Demandes;
use App\Entity\Categories;
use App\Entity\Citoyen;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class DemandesFixtures extends Fixture
{

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker  =  Faker\Factory::create('fr_FR');


        for ($i=0; $i < 45; $i++)
            {
            $demande = new Demandes();
            $demande->setCategorie($this->getReference('categories'));
            $demande->setCreateur($this->getReference('citoyen'));
            $demande->setTitre($faker->sentence($nbWords = 6, $variableNbWords = true));
            $demande->setSommaire($faker->paragraph($nbSentences = 3, $variableNbSentences = true));
            $demande->setContenu($faker->text($maxNbChars = 300));
            $demande->setBudget($faker->numberBetween($min = 100, $max = 5000));
            $demande->setCreatedAt($faker->dateTime($max = 'now', $timezone = null));
            $demande->setDeadline($faker->dateTime($min = 'now', $timezone = null));
            $demande->setNombreVotes(($faker->randomDigitNotNull));

            $manager->persist($demande);
            }
            $manager->flush();
    }


}
