<?php

namespace AppBundle\Tests;

/**
 * Class PostControllerTest
 * @package Tests\AppBundle\Controller
 */
class UserControllerAbstract extends AbstractAuthCase
{
    /**
     * Test posts
     */
    public function test()
    {
        list($client, $header) = $this->getClient();
    }
}
