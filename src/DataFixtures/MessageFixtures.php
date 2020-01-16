<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Forum;
use App\Entity\User;
use App\Entity\Subject;
use App\Entity\Message;
use Faker;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class MessageFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        // Boucle de 20 itérations
        for($i = 1; $i <= 50; $i++){
    
            // Création d'un nouvel article
            $newMessage = new Message();
        
            // Hydratation du nouvel article
            $newMessage
                ->setContent($faker->sentence(5)) // Donnera article 1, article 2, etc...
                ->setPublicationDate($faker->dateTimeBetween('-1 year', 'now'))
                ->setAuthor( $this->getReference('user' . $faker->numberBetween(1,10) ) )
                ->setSubject( $this->getReference('Subject' . $faker->numberBetween(1,10) ) )
            ;
        
            // Enregistrement du nouvel article auprès de Doctrine
            $manager->persist($newMessage);
    
        }
        $manager->flush();
    }
    
    public function getOrder()
    {
        return 4;
    }

}
