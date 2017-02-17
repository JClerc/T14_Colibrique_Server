<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\FOSRestController;

class AbstractController extends FOSRestController
{
    /**
     * @return User
     */
    protected function getUser()
    {
        return parent::getUser();
    }

    protected function respond($data, $groups = [])
    {
        $view = $this->view($data);

        $context = new Context();
        $groups[] = 'Default';
        $context->setGroups($groups);
        $view->setContext($context);

        return $this->handleView($view);
    }
}
