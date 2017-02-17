<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class AbstractLoader
 * @package AppBundle\DataFixtures\ORM
 */
abstract class AbstractLoader extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {

        foreach ($this->getData() as $data) {
            foreach ($data['data'] as $fill) {
                $className = $data['entity'];
                $entity = new $className();
                $prefix = strtolower((new \ReflectionClass($entity))->getShortName());
                $manager->persist($this->populate($prefix, $entity, $fill));
            }
        }

        $manager->flush();
    }

    abstract protected function getData();

    private function populate($prefix, $entity, $data)
    {
        foreach ($data as $property => $value) {
            if ($property !== 'reference') {
                $method = sprintf('set%s', ucwords(str_replace('_', ' ', $property)));
                $method = str_replace(' ', '', $method);
                $entity->$method($value);
            } else {
                $this->addReference($prefix.':'.$value, $entity);
            }
        }

        return $entity;
    }
}
