<?php

namespace AppBundle\Controller;

use Exception;
use FOS\RestBundle\Controller\FOSRestController;

class ExceptionController extends FOSRestController
{
    public function showAction(Exception $exception)
    {
        $data = [
            'error' => [
                'code' => $exception->getCode(),
                'message' => $exception->getMessage(),
                'type' => get_class($exception),
            ],
        ];

        return $this->handleView($this->view($data, 500));
    }
}
