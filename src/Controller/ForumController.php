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
     *@Route("/cree-un-forum/", name="createForum")
    */
    public function createForum(Request $request)
    {
        // $newForum = new Forum();

        // $form = $this->createForm(CreateForumType::class, $newForum);
        // $form->handleRequest($request);
        // if ($form->isSubmitted() && $form->isValid()){

        //     $entityManager = $this->getDoctrine()->getManager();
        //     $entityManager->persist($forum);
        //     $entityManager->flush();

        //     return $this->redirectToRoute('forum');
        // }

        return $this->render('forum/createForum.html.twig', [
            'form' => $form->$createViews()
        ]);
    }

    /**
     *@Route("/forum/{id}/sujet/", name="subjectForum")
    */
    public function subjetForum(Forum $forum)
    {

        return $this->render('forum/subject.html.twig', [
            'forum' => $forum
        ]);
    }
     /**
     *@Route("/sujet/{id}/message/", name="MessageSubject")
    */
    public function MessageSubject(Subject $subject)
    {
        return $this->render('forum/message.html.twig', [
            'subject' => $subject
        ]);
    }
}
