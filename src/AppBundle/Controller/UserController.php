<?php

namespace AppBundle\Controller;

use JMS\Serializer\Annotation as Serializer;

class UserController extends AbstractController
{
    public function getProfileAction()
    {
        return $this->respond(
            [
                'profile' => $this->getUser(),
            ],
            ['user_show']
        );
    }

    public function getUserAction($id)
    {
        $user = $this->getDoctrine()->getRepository('AppBundle:User')->find($id);

        return $this->respond(
            [
                'user' => $user,
            ],
            ['user_show']
        );
    }
}
