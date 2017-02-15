<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostVisiblity
 *
 * @ORM\Table(name="post_visiblity")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PostVisiblityRepository")
 */
class PostVisiblity
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\UserType", inversedBy="post_visibilities")
     * @ORM\JoinColumn(name="visible_by_id", referencedColumnName="id")
     */
    private $visible_by;


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
     * @param \AppBundle\Entity\Post $post
     *
     * @return PostVisiblity
     */
    public function setPost(\AppBundle\Entity\Post $post = null)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post
     *
     * @return \AppBundle\Entity\Post
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set visibleBy
     *
     * @param \AppBundle\Entity\UserType $visibleBy
     *
     * @return PostVisiblity
     */
    public function setVisibleBy(\AppBundle\Entity\UserType $visibleBy = null)
    {
        $this->visible_by = $visibleBy;

        return $this;
    }

    /**
     * Get visibleBy
     *
     * @return \AppBundle\Entity\UserType
     */
    public function getVisibleBy()
    {
        return $this->visible_by;
    }
}
