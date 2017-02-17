<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\FOSRestController;

/**
 * Class AbstractController
 * @package AppBundle\Controller
 */
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

    protected function validate($test, $message, $code = 0)
    {
        if (!$test) {
            throw new \Exception($message, $code);
        }
    }
}
