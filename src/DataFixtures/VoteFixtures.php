<?php

namespace App\DataFixtures;

use App\Entity\Citoyen;
use App\Entity\Demandes;
use App\Entity\Vote;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class VoteFixtures extends BaseFixtures implements DependentFixtureInterface
{
    private $etats = [
            'Pour',
            'Contre',
            'Abstention'
        ];

    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(Vote::class, 3000, function(Vote $vote) {
            $etats = [
                'Pour',
                'Contre',
                'Abstention'
            ];
            $vote->setEtat($etats[rand(0,2)]);
            $vote->setDemande($this->getRandomReference(Demandes::class));
            $vote->setCitoyen($this->getRandomReference(Citoyen::class));
        });
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            DemandesFixtures::class,
            CitoyenFixtures::class
        ];
    }
}