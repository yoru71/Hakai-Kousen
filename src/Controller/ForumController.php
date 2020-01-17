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
        $forumRepo = $this->getDoctrine()->getRepository(Forum::class);

        $forums = $forumRepo->findAll();

        return $this->render('forum/forum.html.twig', [
            'forums' => $forums
        ]);
    }
    /**
     *@Route("/forum/{id}/sujet/", name="subjectForum")
    */
    public function subjetForum(Forum $forum,Request $request)
    {
        $newSubject = new Subject();

        $form = $this->createForm(SubjectType::class, $newSubject);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $newSubject
                ->setPublicationDate( new DateTime())
                ->setAuthor( $this->getUser())
                ->setForum( $forum )
            ;


            $newMessage = new Message();

            $newMessage
                ->setContent( $form->get('content')->getData() )
                ->setPublicationDate( new DateTime() )
                ->setSubject($newSubject)
                ->setAuthor($this->getUser())
            ;

            $em = $this->getDoctrine()->getManager();

            $em->persist($newSubject);
            $em->persist($newMessage);

            $em->flush();
        }
        return $this->render('forum/subject.html.twig', [
            'forum' => $forum,
            'form' => $form->createView()
        ]);
    }

    /**
     *@Route("/sujet/{id}/message/", name="MessageSubject")
     */
    public function MessageSubject(Subject $subject, Request $request)
    {   
        $newMessage = new Message();

        $form = $this->createForm(MessageType::class, $newMessage);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
        $newMessage
            ->setPublicationDate( new DateTime() )
            ->setAuthor($this->getUser())
            ->setSubject($subject)
        ;
            
        $em = $this->getDoctrine()->getManager();
        
        $em->persist($newMessage);

        $em->flush();
        
        }

        return $this->render('forum/message.html.twig', [
            'subject' => $subject,
            'form' => $form->createView()
        ]);
    }
 }
