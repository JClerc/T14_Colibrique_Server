<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * UserType
 *
 * @ORM\Table(name="user_type")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserTypeRepository")
 */
class UserType
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
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=100)
     */
    private $label;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=100)
     */
    private $code;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PostVisiblity", mappedBy="visible_by")
     */
    private $post_visibilities;

    public function __construct()
    {
        $this->post_visibilities = new ArrayCollection();
    }


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
     * Set label
     *
     * @param string $label
     *
     * @return UserType
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return UserType
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Add postVisibility
     *
     * @param \AppBundle\Entity\PostVisiblity $postVisibility
     *
     * @return UserType
     */
    public function addPostVisibility(\AppBundle\Entity\PostVisiblity $postVisibility)
    {
        $this->post_visibilities[] = $postVisibility;

        return $this;
    }

    /**
     * Remove postVisibility
     *
     * @param \AppBundle\Entity\PostVisiblity $postVisibility
     */
    public function removePostVisibility(\AppBundle\Entity\PostVisiblity $postVisibility)
    {
        $this->post_visibilities->removeElement($postVisibility);
    }

    /**
     * Get postVisibilities
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPostVisibilities()
    {
        return $this->post_visibilities;
    }
}
