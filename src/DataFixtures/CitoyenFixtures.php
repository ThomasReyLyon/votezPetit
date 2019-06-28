<?php

namespace App\DataFixtures;

use App\Entity\Citoyen;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CitoyenFixtures extends BaseFixtures
{
    private $cypher;

    public function __construct(UserPasswordEncoderInterface $cypher)
    {
        $this->cypher = $cypher;
    }

    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(Citoyen::class, 1000, function(Citoyen $citoyen, $i) {
            if($i === 0){
                $citoyen->setRoles(['ROLE_MAIRE']);
                $citoyen->setNom('PETIT');
            } else {
                $citoyen->setRoles(['ROLE_CITOYEN']);
                $citoyen->setNom($this->faker->lastName);
            }
            $citoyen->setEmail($this->faker->email);
            $citoyen->setPrenom($this->faker->firstName);
            $citoyen->setNumeroElecteur($this->faker->numberBetween($min= 10000000, $max= 99999999));
            $citoyen->setNombreVotes($this->faker->randomDigitNotNull);
            $citoyen->setNombrePropositions($this->faker->randomDigitNotNull);
            $citoyen->setPassword($this->cypher->encodePassword($citoyen, 'pwd'));

        });
        $manager->flush();
    }

}