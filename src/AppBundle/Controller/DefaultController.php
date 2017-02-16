<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends FOSRestController
{
    public function getPostsAction(Request $request)
    {
        /** @var User $user */
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $type = $user->getUserType();

        $postVisibilityRepository = $this->getDoctrine()->getRepository('AppBundle:PostVisibility');
        $postVisibilities = $postVisibilityRepository->findBy(['visible_by' => $type]);

        $posts = [];

        foreach ($postVisibilities as $postVisibility) {
            $posts[] = $postVisibility->getPost();
        }

        $data = [
            'name' => $user->getFirstName(),
            'posts' => $posts,
        ];

        return $this->handleView($this->view($data));
    }
}
