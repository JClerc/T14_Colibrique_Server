<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadClientData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * Set it to true to get random id/secret each time fixtures are loaded
     */
    const RANDOM_CREDENTIALS = false;

    /**
     * Used only when RANDOM_CREDENTIALS is set to false
     */
    const FIXED_RANDOM_ID = '1beg32t1wqo00wko4gc44gsw8cws800wk0ogscowk0gcc8kws4';
    const FIXED_SECRET = '48rj3yic4qo00co0gw4444owkkc4s888o8804k0k00cw0og0oc';

    /** @var  ContainerInterface */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $clientManager = $this->container->get('fos_oauth_server.client_manager.default');
        $client = $clientManager->createClient();
        $client->setRedirectUris([]);
        $client->setAllowedGrantTypes(['password']);

        if (!self::RANDOM_CREDENTIALS) {
            $client->setRandomId(self::FIXED_RANDOM_ID);
            $client->setSecret(self::FIXED_SECRET);
        }

        $clientManager->updateClient($client);

        if (self::RANDOM_CREDENTIALS) {
            echo PHP_EOL.'  * Created an OAuth2 client:'.PHP_EOL;
            echo '  - client_id: '.$client->getPublicId().PHP_EOL;
            echo '  - client_secret: '.$client->getSecret().PHP_EOL.PHP_EOL;
        } else {
            $id = $client->getPublicId();
            if (strpos($id, '1_') !== 0) {
                echo PHP_EOL . '  [!] Warning: client_id is not prefixed with "1_"!';
                echo PHP_EOL . '  [!] Load data using: ./db_seed'. PHP_EOL . PHP_EOL;
            }
        }
    }

    public function getOrder()
    {
        return 1;
    }
}
