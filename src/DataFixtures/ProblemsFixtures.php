<?php

namespace App\DataFixtures;

use App\Entity\Problems;
use App\Service\GeoService;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class ProblemsFixtures extends BaseFixtures
{
    private $geoService;

    public function __construct(GeoService $geoService)
    {
        $this->geoService = $geoService;
    }

    protected function loadData(ObjectManager $manager)
    {
        $p1 = new Problems();
        $p1->setType('Nid de poule');
        $p1->setAddress('17 rue Delandine');
        $p1->setZipCode(69002);
        $p1->setCity('Lyon');
        $p1->setValidations(2);
        $this->geoService->geocode($p1);
        $manager->persist($p1);

        $p2 = new Problems();
        $p2->setType('Lampadaire défectueux');
        $p2->setAddress('21 quai Saint Antoine');
        $p2->setZipCode(69002);
        $p2->setCity('Lyon');
        $p2->setValidations(2);
        $this->geoService->geocode($p2);
        $manager->persist($p2);

        $p3 = new Problems();
        $p3->setType('Déjection canine');
        $p3->setAddress('98 boulevard de la Croix Rousse');
        $p3->setZipCode(69001);
        $p3->setCity('Lyon');
        $p3->setValidations(1);
        $this->geoService->geocode($p3);
        $manager->persist($p3);

        $p4 = new Problems();
        $p4->setType('Nid de poule');
        $p4->setAddress('60 cours Vitton');
        $p4->setZipCode(69006);
        $p4->setCity('Lyon');
        $p4->setValidations(2);
        $this->geoService->geocode($p4);
        $manager->persist($p4);

        $manager->flush();
    }


}