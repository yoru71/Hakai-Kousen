<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Form\CreateForumType;
use App\Entity\Forum;
use Symfony\Component\HttpFoundation\Request;
use \DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use App\Entity\Subject;

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
     * @Security("is_granted('ROLE_USER')")
     */
    public function profil()
    {
        return $this->render('main/profil.html.twig', [
            'user' => $this->getUser()
        ]);
    }
    // /**
    //  * @Route("/sujet", name="sujet")
    //  */
    // public function sujet(Request $request)
    // {
    //     $newArticle = new Article();
    //     $form = $this->createForm(ArticleType::class, $newArticle);

    //     $form->handleRequest($request);

    //     if($form->isSubmitted() && $form->isValid()){
    //         $newArticle
    //         ->setDate( new DateTime())
    //         ->setAuthor( $this->getUser())
    //         ;

    //         $em = $this->getDoctrine()->getManager();

    //         $em->persist($newArticle);

    //         $em->flush();

    //         $this->addFlash('success', 'Article créé avec succès !');

    //         return $this->redirectToRoute('forum');
    //     }

    //     return $this->render('main/sujet.html.twig',[
    //         'form' => $form->createView()
    //     ]);
    // }

    /**
     * @Route("/change", name="change")
     */
    public function change()
    {
        return $this->render('main/changePassword.html.twig');   
    }

}
