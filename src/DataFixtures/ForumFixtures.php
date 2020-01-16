<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Forum;
use Faker;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;


class ForumFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        // Boucle de 20 itérations
        for($i = 1; $i <= 10; $i++){

            // Création d'un nouvel article
            $newForum = new Forum();

            // Hydratation du nouvel article
            $newForum
                ->setTitle($faker->sentence(3)) // Donnera article 1, article 2, etc...
                ->setDescription($faker->sentence(3))
            ;

            // Enregistrement du nouvel article auprès de Doctrine
            $manager->persist($newForum);

            $this->addReference('forum' . $i, $newForum);

        }

        // Sauvegarde en BDD des articles
        $manager->flush();
    }

    /**
     * Get the order of this fixture
     * @return integer
     */
    public function getOrder()
    {
        return 2;
    }

}
