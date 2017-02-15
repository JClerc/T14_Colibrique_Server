<?php

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Category;
use AppBundle\Entity\Promotion;
use AppBundle\Entity\UserType;

class LoadBaseData extends AbstractLoader
{
    public function getOrder()
    {
        return 1;
    }

    protected function getData()
    {
        return [
            [
                'entity' => Promotion::class,
                'data' => [
                    [
                        'label' => 'P2018',
                        'year' => 2018,
                        'reference' => 2018,
                    ],
                    [
                        'label' => 'P2019',
                        'year' => 2019,
                        'reference' => 2019,
                    ],
                    [
                        'label' => 'P2020',
                        'year' => 2020,
                        'reference' => 2020,
                    ],
                ],
            ],
            [
                'entity' => UserType::class,
                'data' => [
                    [
                        'label' => 'Étudiant',
                        'code' => 'student',
                        'reference' => 'student',
                    ],
                    [
                        'label' => 'Intervenant',
                        'code' => 'professor',
                        'reference' => 'professor',
                    ],
                    [
                        'label' => 'Administration',
                        'code' => 'staff',
                        'reference' => 'staff',
                    ],
                ],
            ],
            [
                'entity' => Category::class,
                'data' => [
                    [
                        'label' => 'Événement',
                        'reference' => 'evenement',
                    ],
                    [
                        'label' => 'Cours',
                        'reference' => 'cours',
                    ],
                    [
                        'label' => 'Random',
                        'reference' => 'random',
                    ],
                ],
            ],
        ];
    }
}
