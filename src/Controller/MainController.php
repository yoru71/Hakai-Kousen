<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('main/home.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
    /**
     * @Route("/rules", name="rules")
     */
    public function rules()
    {
        return $this->render('main/rules.html.twig');
    }
    /**
     * @Route("/pokedex", name="pokedex")
     */
    public function pokedex()
    {
        return $this->render('main/pokedex.html.twig');
    }
     /**
     * @Route("/forum", name="forum")
     */
    public function forum()
    {
        return $this->render('main/forum.html.twig');
    }
    /**
     * @Route("/inscription", name="inscription")
     */
    public function inscription()
    {
        return $this->render('main/inscription.html.twig');
    }
    /**
     * @Route("/connexion", name="connexion")
     */
    public function connexion()
    {
        return $this->render('main/connexion.html.twig');
    }
    /**
     * @Route("/deconnexion", name="deconnexion")
     */
    public function deconnexion()
    {
        return $this->render('main/deconnexion.html.twig');
    }
    /**
     * @Route("/profil", name="profil")
     */
    public function profil()
    {
        return $this->render('main/profil.html.twig');
    }
    /**
     * @Route("/sujet", name="sujet")
     */
    public function sujet()
    {
        return $this->render('main/sujet.html.twig');
    }
}
