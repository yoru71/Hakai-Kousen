<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Recaptcha\RecaptchaValidator;  // Importation de notre service de validation du captcha
use Symfony\Component\Form\FormError;  // Importation de la classe permettant de créer des erreurs dans les formulaires
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, RecaptchaValidator $recaptcha): Response
    {

        // Creation de l'Objet User
        $user = new User();


        // Creation du formulaire
        $form = $this->createForm(RegistrationFormType::class, $user);


        // Prend le data de request (method POST)
        $form->handleRequest($request);


        // Verifie si c est bien une method POST
        if ($form->isSubmitted()){


            // Si le captcha n'est pas valider on envoie une erreur
            if(!$recaptcha->verify( $request->request->get('g-recaptcha-response'), $request->server->get('REMOTE_ADDR') )){

                $form->addError(new FormError('Le Captcha doit être validé !'));

            }


            // Si le formulaire a ete valider en HASH le mot de pass
            if($form->isValid()){
                $user->setPassword(
                    $passwordEncoder->encodePassword(
                        $user,
                        $form->get('password')->getData()
                    )
                );


                // Recuperation de EntityManager
                $em = $this->getDoctrine()->getManager();


                // On relie persist a "$user"
                $em->persist($user);


                // On envoie les information enregistrer a la base de donnee
                $em->flush();


                // Une fois les information enregistrer on sera rediriger vers la page de connexion
                return $this->redirectToRoute('app_login');
            }
        }

        // Retourne la variable "$form->createView()" qui sera sous le nom de "registrationForm" dans le Twig "registration/register.html.twig".
        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}