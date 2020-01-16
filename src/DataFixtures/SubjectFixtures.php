<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Forum;
use App\Entity\User;
use App\Entity\Subject;
use Faker;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class SubjectFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        // Boucle de 20 itérations
        for($i = 1; $i <= 50; $i++){
    
            // Création d'un nouvel article
            $newSubject = new Subject();
        
            // Hydratation du nouvel article
            $newSubject
                ->setTitle($faker->sentence(3)) // Donnera article 1, article 2, etc...
                ->setPublicationDate($faker->dateTimeBetween('-1 year', 'now'))
                ->setAuthor( $this->getReference('user' . $faker->numberBetween(1,10) ) )
                ->setForum( $this->getReference('forum' . $faker->numberBetween(1,10) ) )
            ;
        
            // Enregistrement du nouvel article auprès de Doctrine
            $manager->persist($newSubject);
    
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }

}
