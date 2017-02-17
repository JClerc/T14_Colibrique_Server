<?php

namespace AppBundle\Controller;

use Exception;
use FOS\RestBundle\Controller\FOSRestController;

/**
 * Class ExceptionController
 * @package AppBundle\Controller
 */
class ExceptionController extends FOSRestController
{
    /**
     * @param Exception $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Exception $exception)
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
