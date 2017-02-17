<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\UserBundle\Model\User as BaseUser;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Exclude;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=100)
     */
    private $first_name;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=100)
     */
    private $last_name;

    /**
     * @var \DateTime
     *
     * @Serializer\Groups({"user_show"})
     * @ORM\Column(name="birthdate", type="date")
     */
    private $birthdate;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\UserType")
     * @ORM\JoinColumn(name="user_type_id", referencedColumnName="id")
     */
    private $user_type;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Promotion")
     * @ORM\JoinColumn(name="promotion_id", referencedColumnName="id", nullable=true)
     */
    private $promotion;

    /**
     * @Exclude
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Mark", mappedBy="student")
     */
    private $marks;

    /**
     * @Exclude
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ConversationMember", mappedBy="user")
     */
    private $conversationsMember;

    public function __construct()
    {
        parent::__construct();
        $this->conversationsMember = new ArrayCollection();
        $this->marks = new ArrayCollection();
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
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->first_name = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->last_name = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Set birthdate
     *
     * @param \DateTime $birthdate
     *
     * @return User
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * Get birthdate
     *
     * @return \DateTime
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Set userType
     *
     * @param \AppBundle\Entity\UserType $userType
     *
     * @return User
     */
    public function setUserType(\AppBundle\Entity\UserType $userType = null)
    {
        $this->user_type = $userType;

        return $this;
    }

    /**
     * Get userType
     *
     * @return \AppBundle\Entity\UserType
     */
    public function getUserType()
    {
        return $this->user_type;
    }

    /**
     * Set promotion
     *
     * @param \AppBundle\Entity\Promotion $promotion
     *
     * @return User
     */
    public function setPromotion(\AppBundle\Entity\Promotion $promotion = null)
    {
        $this->promotion = $promotion;

        return $this;
    }

    /**
     * Get promotion
     *
     * @return \AppBundle\Entity\Promotion
     */
    public function getPromotion()
    {
        return $this->promotion;
    }

    /**
     * Add mark
     *
     * @param \AppBundle\Entity\Mark $mark
     *
     * @return User
     */
    public function addMark(\AppBundle\Entity\Mark $mark)
    {
        $this->marks[] = $mark;

        return $this;
    }

    /**
     * Remove mark
     *
     * @param \AppBundle\Entity\Mark $mark
     */
    public function removeMark(\AppBundle\Entity\Mark $mark)
    {
        $this->marks->removeElement($mark);
    }

    /**
     * Get marks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMarks()
    {
        return $this->marks;
    }

    /**
     * Add conversationsMember
     *
     * @param \AppBundle\Entity\ConversationMember $conversationsMember
     *
     * @return User
     */
    public function addConversationsMember(\AppBundle\Entity\ConversationMember $conversationsMember)
    {
        $this->conversationsMember[] = $conversationsMember;

        return $this;
    }

    /**
     * Remove conversationsMember
     *
     * @param \AppBundle\Entity\ConversationMember $conversationsMember
     */
    public function removeConversationsMember(\AppBundle\Entity\ConversationMember $conversationsMember)
    {
        $this->conversationsMember->removeElement($conversationsMember);
    }

    /**
     * Get conversationsMember
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getConversationsMember()
    {
        return $this->conversationsMember;
    }
}
