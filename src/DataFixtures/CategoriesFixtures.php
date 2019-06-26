<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoriesFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {

        $datas = array("Sport", "Environnement", "Emploi", "Jeunesse", "Gastronomie", "Religion", "Détente", "Informatique");

        foreach($datas as $i => $nom)
        {
            $categories[$i] = new Categories();
            $categories[$i]->setNom($nom);

            $manager->persist($categories[$i]);
        }

        $manager->flush();
    }
}

