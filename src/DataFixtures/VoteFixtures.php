<?php

namespace App\DataFixtures;

use App\Entity\Vote;
use App\Entity\Categories;
use App\Entity\Citoyen;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class VoteFixtures extends Fixture
{

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {

        for ($i=0; $i < 150; $i++)
            {
            $vote = new Vote();
            $demande->setCreateur($this->getReference('citoyen' . $random));
            $demande->setDemande($this->getReference('demande_' . $random));


            $manager->persist($vote);
            }
            $manager->flush();
    }
}