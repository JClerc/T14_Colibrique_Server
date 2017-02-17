<?php

namespace AppBundle\Controller;

use AppBundle\Entity\PostVisibility;
use JMS\Serializer\Annotation as Serializer;

class PostController extends AbstractController
{
    public function getPostsAction()
    {
        $user = $this->getUser();
        $type = $user->getUserType();

        $postVisibilityRepository = $this->getDoctrine()->getRepository('AppBundle:PostVisibility');
        $postVisibilities = $postVisibilityRepository->findBy(['visible_by' => $type]);

        $posts = array_map(
            function (PostVisibility $postVisibility) {
                return $postVisibility->getPost();
            },
            $postVisibilities
        );

        return $this->respond(
            [
                'posts' => $posts,
            ]
        );
    }
}
