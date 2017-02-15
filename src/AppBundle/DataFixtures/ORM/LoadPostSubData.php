<?php

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\PostComment;
use AppBundle\Entity\PostVisiblity;

class LoadPostSubData extends AbstractLoader
{
    public function getOrder()
    {
        return 4;
    }

    protected function getData()
    {
        return [
            [
                'entity' => PostVisiblity::class,
                'data' => [
                    [
                        'post' => $this->getReference('post:max-random'),
                        'visible_by' => $this->getReference('usertype:student'),
                    ],
                    [
                        'post' => $this->getReference('post:staff-pate'),
                        'visible_by' => $this->getReference('usertype:student'),
                    ],
                    [
                        'post' => $this->getReference('post:staff-pate'),
                        'visible_by' => $this->getReference('usertype:professor'),
                    ],
                    [
                        'post' => $this->getReference('post:staff-pate'),
                        'visible_by' => $this->getReference('usertype:staff'),
                    ],
                    [
                        'post' => $this->getReference('post:yann-php'),
                        'visible_by' => $this->getReference('usertype:student'),
                    ],
                ],
            ],
            [
                'entity' => PostComment::class,
                'data' => [
                    [
                        'author' => $this->getReference('user:student-3'),
                        'content' => 'Non merci',
                        'posted_at' => new \DateTime('2016-11-21 09:18'),
                        'reply_to' => $this->getReference('post:max-random'),
                    ],
                    [
                        'author' => $this->getReference('user:student-2'),
                        'content' => "Super cool ! \u{1F370}",
                        'posted_at' => new \DateTime('2016-12-26 19:26'),
                        'reply_to' => $this->getReference('post:yann-php'),
                    ],
                ],
            ],
        ];
    }
}
