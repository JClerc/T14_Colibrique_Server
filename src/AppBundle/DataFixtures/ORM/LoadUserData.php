<?php

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\User;

class LoadUserData extends AbstractLoader
{
    public function getOrder()
    {
        return 2;
    }

    protected function getData()
    {
        return [
            [
                'entity' => User::class,
                'data' => [
                    [
                        'first_name' => 'Max',
                        'last_name' => 'Allouch',
                        'email' => 'max.allouch@hetic.net',
                        'password' => '********',
                        'birthdate' => new \DateTime('1995-03-28'),
                        'user_type' => $this->getReference('usertype:student'),
                        'promotion' => $this->getReference('promotion:2019'),
                        'reference' => 'student-1',
                    ],
                    [
                        'first_name' => 'Axel',
                        'last_name' => 'Morand',
                        'email' => 'axel.morand@hetic.net',
                        'password' => '********',
                        'birthdate' => new \DateTime('1996-08-14'),
                        'user_type' => $this->getReference('usertype:student'),
                        'promotion' => $this->getReference('promotion:2019'),
                        'reference' => 'student-2',
                    ],
                    [
                        'first_name' => 'Thomas',
                        'last_name' => 'Sanlis',
                        'email' => 'thomas.sanlis@hetic.net',
                        'password' => '********',
                        'birthdate' => new \DateTime('1995-01-10'),
                        'user_type' => $this->getReference('usertype:student'),
                        'promotion' => $this->getReference('promotion:2019'),
                        'reference' => 'student-3',
                    ],
                    [
                        'first_name' => 'Yann',
                        'last_name' => 'Le Scouarnec',
                        'email' => 'yann.le-scouarnec@hetic.net',
                        'password' => '********',
                        'birthdate' => new \DateTime('1818-10-21'),
                        'user_type' => $this->getReference('usertype:professor'),
                        'promotion' => null,
                        'reference' => 'professor-1',
                    ],
                    [
                        'first_name' => 'Baptiste',
                        'last_name' => 'Lignel',
                        'email' => 'baptiste.lignel@hetic.net',
                        'password' => '********',
                        'birthdate' => new \DateTime('1973-09-02'),
                        'user_type' => $this->getReference('usertype:professor'),
                        'promotion' => null,
                        'reference' => 'professor-2',
                    ],
                    [
                        'first_name' => 'Damien',
                        'last_name' => 'Jordan',
                        'email' => 'damien.jordan@hetic.net',
                        'password' => '********',
                        'birthdate' => new \DateTime('1981-11-02'),
                        'user_type' => $this->getReference('usertype:staff'),
                        'promotion' => null,
                        'reference' => 'staff-1',
                    ],
                ],
            ],
        ];
    }
}
