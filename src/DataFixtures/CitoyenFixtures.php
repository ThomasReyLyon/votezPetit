<?php

namespace App\DataFixtures;

use App\Entity\Citoyen;
use Doctrine\Common\Persistence\ObjectManager;

class CitoyenFixtures extends BaseFixtures
{
    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(Citoyen::class, 5000, function(Citoyen $citoyen) {
            $citoyen->setNom($this->faker->lastName);
            $citoyen->setPrenom($this->faker->firstName);
            $citoyen->setNumeroElecteur($this->faker->ean8);
            $citoyen->setNombreVotes($this->faker->randomDigitNotNull);
            $citoyen->setNombrePropositions($this->faker->randomDigitNotNull);

        });
        $manager->flush();
    }

}