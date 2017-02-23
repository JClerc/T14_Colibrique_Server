<?php

namespace AppBundle\Controller;

use AppBundle\Entity\EntityInterface;
use AppBundle\Entity\User;
use Doctrine\ORM\Mapping\Entity;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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

    protected function processForm(
        EntityInterface $entity,
        $entityTypeClass,
        Request $request,
        callable $dataModifier = null,
        callable $onSuccess = null
    ) {
        $form = $this->createForm($entityTypeClass, $entity);

        $data = json_decode($request->getContent(), true);

        if ($dataModifier) {
            $data = $dataModifier($data);
        }

        $form->submit($data);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            if ($onSuccess) {
                $onSuccess($entity);
            }

            $statusCode = $entity->getId() ? 201 : 204;
        } else {
            $statusCode = 500;
        }

        $errors = $form->getErrors(true);
        $errorString = (string) $errors;

        $view = $this->view(
            [
                'success' => $statusCode < 300,
                'error_msg' => $errorString ?: null,
                'errors' => $errorString ? $errors : null,
            ],
            $statusCode
        );

        return $this->handleView($view);
    }
}
