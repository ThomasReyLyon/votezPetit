<?php

namespace App\DataFixtures;

use App\Entity\Budget;
use Doctrine\Common\Persistence\ObjectManager;

class BudgetFixtures extends BaseFixtures
{
    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(Budget::class,1, function(Budget $budget) {
            $budget->setMontant(400000);
        });
        $manager->flush();
    }
}
