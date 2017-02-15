<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Work
 *
 * @ORM\Table(name="work")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\WorkRepository")
 */
class Work
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
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var bool
     *
     * @ORM\Column(name="has_attachment", type="boolean")
     */
    private $has_attachment;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Homework", inversedBy="works")
     * @ORM\JoinColumn(name="homework_id", referencedColumnName="id")
     */
    private $homework;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     */
    private $author;


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
     * Set content
     *
     * @param string $content
     *
     * @return Work
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Work
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set hasAttachment
     *
     * @param boolean $hasAttachment
     *
     * @return Work
     */
    public function setHasAttachment($hasAttachment)
    {
        $this->has_attachment = $hasAttachment;

        return $this;
    }

    /**
     * Get hasAttachment
     *
     * @return bool
     */
    public function getHasAttachment()
    {
        return $this->has_attachment;
    }

    /**
     * Set homework
     *
     * @param \AppBundle\Entity\Homework $homework
     *
     * @return Work
     */
    public function setHomework(\AppBundle\Entity\Homework $homework = null)
    {
        $this->homework = $homework;

        return $this;
    }

    /**
     * Get homework
     *
     * @return \AppBundle\Entity\Homework
     */
    public function getHomework()
    {
        return $this->homework;
    }

    /**
     * Set author
     *
     * @param \AppBundle\Entity\User $author
     *
     * @return Work
     */
    public function setAuthor(\AppBundle\Entity\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \AppBundle\Entity\User
     */
    public function getAuthor()
    {
        return $this->author;
    }
}
