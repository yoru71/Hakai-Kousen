<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;
use App\Form\CreateForumType;
use App\Entity\Forum;
use App\Entity\Subject;
use App\Entity\Message;
use App\Form\SubjectType;
use DateTime;
use App\Form\MessageType;


class ForumController extends AbstractController
{
    /**
     * @Route("/forum/", name="forum")
    */
    public function forumHome()
    {

        // Selectionne la table Forum de la base de donnee
        $forumRepo = $this->getDoctrine()->getRepository(Forum::class);


        // Recuperer tous les element de la table
        $forums = $forumRepo->findAll();


        // Retourne la variable "$forums" qui sera sous le nom de "forums" dans le Twig "forum/forum.html.twig".
        return $this->render('forum/forum.html.twig', [
            'forums' => $forums
        ]);
    }

    /**
     * @Route("/forum/sujet/{slug}", name="subjetForumPage", requirements={"id"="\d+"})
    */
    public function subjetForumPage(Forum $forum, Request $request, PaginatorInterface $paginator)
    {

        // Creation de l objet Subject
        $newSubject = new Subject();


        // Selectionne la table Forum de la base de donnee
        $forumRepo = $this->getDoctrine()->getRepository(Forum::class);


        // Apelle a la variable super global GET (request)
        $requestSubjetForumPage = $request->query->getInt('page', 1);


        // Si la pagination Int est inferieur a 1 on lance une erreur 404
        if($requestSubjetForumPage < 1){
            throw new NotFoundHttpException();
        }


        // Recuperation de EntityManager
        $em = $this->getDoctrine()->getManager();
    

        // Creation d'une requeter qui permettera de recuperer ous les sujet de la page
        $query = $em->createQuery('SELECT h FROM App\Entity\Subject h');
    

        // On recuperer les 10 page de l'url demander
        $requestSubjetForumPage = $paginator->paginate(
            $query,
            $requestSubjetForumPage,
            10
        );

        
        // Retourne les variables "$requestSubjetForumPage" && "$forum" qui seron sous le nom de "subjetPage" && "forum" dans le Twig "forum/subject.html.twig".
        return $this->render('forum/subject.html.twig', [
            'subjetPage' => $requestSubjetForumPage,
            'forum' => $forum,
        ]);
    }

    /**
     *@Route("forum/sujet/message/{slug}", name="MessageSubject", requirements={"id"="\d+"})
     */
    public function MessageSubject(Subject $subject, Request $request, PaginatorInterface $paginator)
    {

        // Creation de l'objet newMessage
        $newMessage = new Message();


        // Apelle a la variable super global GET (request)
        $requestMessageForumPage = $request->query->getInt('page', 1);


        // Si la pagination Int est inferieur a 1 on lance une erreur 404 
        if($requestMessageForumPage < 1){
            throw new NotFoundHttpException();
        }
    

        // Recuperation de EntityManager
        $em = $this->getDoctrine()->getManager();
    

        // Creation d'une requeter qui permettera de recuperer ous les sujet de la page
        $query = $em->createQuery('SELECT f FROM App\Entity\Message f');
    

        // On recuperer les 10 page de l'url demander
        $messageForumPage  = $paginator->paginate(
            $query,
            $requestMessageForumPage,
            6
        );
        

        // Retourne les variables "$messageForumPage" && "$subject" qui seron sous le nom de "messageForum" && "subject" dans le Twig "forum/message.html.twig".
        return $this->render('forum/message.html.twig', [
            'messageForum' => $messageForumPage,
            'subject' => $subject,
        ]);
    }
 }













