<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use App\Entity\Citoyen;
use App\Entity\Demandes;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class DemandesFixtures extends BaseFixtures implements DependentFixtureInterface
{
    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(Demandes::class, 10, function(Demandes $demandes) {
            $demandes->setTitre($this->faker->text(50));
            $demandes->setSommaire($this->faker->text(255));
            $demandes->setContenu($this->faker->text);
            $demandes->setBudget($this->faker->numberBetween($min = 1000, $max = 35000));
            $demandes->setCategorie($this->getRandomReference(Categories::class));
            $demandes->setCreatedAt($this->faker->dateTimeBetween('-1 month', '-1 seconds'));
            $demandes->setDeadline($this->faker->dateTimeInInterval($startDate = $demandes->getCreatedAt(), $interval
                = '+ 30 days',
                $timezone = null));
            $demandes->setIsOuverte(true);
            $demandes->setIsValide(true);
            $demandes->setCreateur($this->getRandomReference(Citoyen::class));
            $demandes->setNombreVotes(rand(1, 10000));
            $voteurs = $this->getRandomReferences(Citoyen::class, $demandes->getNombreVotes());
            foreach ($voteurs as $voteur) {
                $demandes->addVoteur($voteur);
            }
        });
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoriesFixtures::class,
            CitoyenFixtures::class,
        ];
    }

}
