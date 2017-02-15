<?php

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Category;
use AppBundle\Entity\Promotion;
use AppBundle\Entity\UserType;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadBaseData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->getPromotionData() as $data) {
            $promotion = new Promotion();
            $promotion->setLabel($data['label']);
            $promotion->setYear($data['year']);
            $manager->persist($promotion);
        }

        foreach ($this->getUserTypeData() as $data) {
            $userType = new UserType();
            $userType->setLabel($data['label']);
            $userType->setCode($data['code']);
            $manager->persist($userType);
        }

        foreach ($this->getCategoryData() as $data) {
            $category = new Category();
            $category->setLabel($data['label']);
            $manager->persist($category);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }

    private function getPromotionData() {
        return [
            [
                'label' => 'P2018',
                'year' => 2018,
            ],
            [
                'label' => 'P2019',
                'year' => 2019,
            ],
            [
                'label' => 'P2020',
                'year' => 2020,
            ],
        ];
    }

    private function getUserTypeData() {
        return [
            [
                'label' => 'Étudiant',
                'code' => 'student',
            ],
            [
                'label' => 'Intervenant',
                'code' => 'professor',
            ],
            [
                'label' => 'Administration',
                'code' => 'staff',
            ],
        ];
    }

    private function getCategoryData() {
        return [
            [
                'label' => 'Événement',
            ],
            [
                'label' => 'Cours',
            ],
            [
                'label' => 'Random',
            ],
        ];
    }
}
