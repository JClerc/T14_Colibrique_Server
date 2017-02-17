<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostVisibility
 *
 * @ORM\Table(name="post_visibility")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PostVisibilityRepository")
 */
class PostVisibility
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Post")
     * @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     */
    private $post;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\UserType", inversedBy="postVisibilities")
     * @ORM\JoinColumn(name="visible_by_id", referencedColumnName="id")
     */
    private $visibleBy;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set post
     *
     * @param Post $post
     *
     * @return PostVisibility
     */
    public function setPost(Post $post = null)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post
     *
     * @return Post
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set visibleBy
     *
     * @param UserType $visibleBy
     *
     * @return PostVisibility
     */
    public function setVisibleBy(UserType $visibleBy = null)
    {
        $this->visibleBy = $visibleBy;

        return $this;
    }

    /**
     * Get visibleBy
     *
     * @return UserType
     */
    public function getVisibleBy()
    {
        return $this->visibleBy;
    }
}
