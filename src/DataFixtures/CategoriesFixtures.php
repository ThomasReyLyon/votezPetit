<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoriesFixtures extends BaseFixtures
{
    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(Categories::class, 5, function(Categories $categories, $i) {
            $category = [
              'Bien etre',
              'Securité',
              'Culture',
              'Sports',
              'Aide a la personne'
            ];
            $categories->setNom($category[$i]);
        });
        $manager->flush();
    }
}
