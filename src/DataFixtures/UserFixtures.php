<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;


class UserFixtures extends Fixture implements OrderedFixtureInterface
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder){
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        // Boucle de 20 itérations
        for($i = 1; $i <= 10; $i++){

            // Création d'un nouvel article
            $newUser = new User();

            // Hydratation du nouvel article
            $newUser
                ->setEmail($faker->email)
                ->setRoles(['ROLES_USER'])
                ->setPassword( $this->passwordEncoder->encodePassword($newUser, 'azerty') )
                ->setPseudonyme($faker->userName)
                ->setDescription($faker->sentence(3))
            ;

            // Enregistrement du nouvel article auprès de Doctrine
            $manager->persist($newUser);

            $this->addReference('user' . $i, $newUser);

        }

        $manager->flush();
    }


    public function getOrder()
    {
        return 1;
    }

}
