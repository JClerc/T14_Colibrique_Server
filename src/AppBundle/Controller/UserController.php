<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\FOSRestController;
use JMS\Serializer\Annotation as Serializer;

class PostController extends FOSRestController
{
    /**
     * @return User
     */
    protected function getUser()
    {
        return parent::getUser();
    }

    public function getPostsAction()
    {
        $user = $this->getUser();
        $type = $user->getUserType();

        $postVisibilityRepository = $this->getDoctrine()->getRepository('AppBundle:PostVisibility');
        $postVisibilities = $postVisibilityRepository->findBy(['visible_by' => $type]);

        $posts = [];

        foreach ($postVisibilities as $postVisibility) {
            $posts[] = $postVisibility->getPost();
        }

        $view = $this->view([
            'posts' => $posts,
        ]);

        $view->setContext((new Context())->setGroups(['Default']));

        return $this->handleView($view);
    }
}
