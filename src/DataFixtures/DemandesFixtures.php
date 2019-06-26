<?php

  namespace App\DataFixtures;

  use App\Entity\Categories;
  use App\Entity\Citoyen;

  use App\Entity\Demandes;
  use App\Service\Slugify;
  use Doctrine\Bundle\FixturesBundle\Fixture;
  use Doctrine\Common\Persistence\ObjectManager;
  use Doctrine\Common\DataFixtures\DependentFixtureInterface;
  use Faker;
  use phpDocumentor\Reflection\Types\This;
  use phpDocumentor\Reflection\Types\Boolean;

  class DemandesFixtures extends Fixture
  {

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager, Categories $categories)
    {
      $faker = Faker\Factory::create('fr_FR');


      for ($i = 0; $i < 10; $i++) {
        $Demandes = new Demandes();
        $Demandes->setTitre($faker->text(255));
        $Demandes->setSommaire($faker->text);
        $Demandes->setContenu($faker->numberBetween([0], [999999999]));
        $Demandes->setCategorie($this->getReference('categories.name'));
        $Demandes->setCreatedAt($faker->dateTime);
        $Demandes->setDeadline($faker->dateTime);
        $Demandes->setIsOuverte(true);
        $Demandes->setIsValide(true);
      //  $Demandes->setCreateur()
        $Demandes->setNombreVotes(random_int(1, 10000000));

        $Demandes->($faker->randomDigitNotNull);
        $manager->persist($Demandes);


      }
      $manager->flush();


      public function getDependencies()
      {
        return [Categories::class];
      }
    }
 // $article->setCategorie($this->getReference('categorie_' . rand(0, $nbInCat)));
 // $this->addReference('categorie_' . $key, $categorie);
  }