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
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted()){

            if(!$recaptcha->verify( $request->request->get('g-recaptcha-response'), $request->server->get('REMOTE_ADDR') )){
                $form->addError(new FormError('Le Captcha doit être validé !'));
            }
            if($form->isValid()){
                $user->setPassword(
                    $passwordEncoder->encodePassword(
                        $user,
                        $form->get('password')->getData()
                    )
                );

                $em = $this->getDoctrine()->getManager();

                $em->persist($user);

                $em->flush();

                return $this->redirectToRoute('app_login');
            }
        }
        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}