<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Course
 *
 * @ORM\Table(name="course")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CourseRepository")
 */
class Course
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
     * @ORM\Column(name="drive_url", type="text", nullable=true)
     */
    private $drive_url;

    /**
     * @var string
     *
     * @ORM\Column(name="notes", type="text")
     */
    private $notes;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_start", type="datetime")
     */
    private $date_start;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_end", type="datetime")
     */
    private $date_end;

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=100, nullable=true)
     */
    private $label;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Subject", inversedBy="courses")
     * @ORM\JoinColumn(name="subject_id", referencedColumnName="id")
     */
    private $subject;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Homework", mappedBy="course")
     */
    private $homeworks;

    public function __construct()
    {
        $this->homeworks = new ArrayCollection();
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
     * Set driveUrl
     *
     * @param string $driveUrl
     *
     * @return Course
     */
    public function setDriveUrl($driveUrl)
    {
        $this->drive_url = $driveUrl;

        return $this;
    }

    /**
     * Get driveUrl
     *
     * @return string
     */
    public function getDriveUrl()
    {
        return $this->drive_url;
    }

    /**
     * Set notes
     *
     * @param string $notes
     *
     * @return Course
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Get notes
     *
     * @return string
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Set dateStart
     *
     * @param \DateTime $dateStart
     *
     * @return Course
     */
    public function setDateStart($dateStart)
    {
        $this->date_start = $dateStart;

        return $this;
    }

    /**
     * Get dateStart
     *
     * @return \DateTime
     */
    public function getDateStart()
    {
        return $this->date_start;
    }

    /**
     * Set dateEnd
     *
     * @param \DateTime $dateEnd
     *
     * @return Course
     */
    public function setDateEnd($dateEnd)
    {
        $this->date_end = $dateEnd;

        return $this;
    }

    /**
     * Get dateEnd
     *
     * @return \DateTime
     */
    public function getDateEnd()
    {
        return $this->date_end;
    }

    /**
     * Set label
     *
     * @param string $label
     *
     * @return Course
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
     * Set subject
     *
     * @param \AppBundle\Entity\Subject $subject
     *
     * @return Course
     */
    public function setSubject(\AppBundle\Entity\Subject $subject = null)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return \AppBundle\Entity\Subject
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Add homework
     *
     * @param \AppBundle\Entity\Homework $homework
     *
     * @return Course
     */
    public function addHomework(\AppBundle\Entity\Homework $homework)
    {
        $this->homeworks[] = $homework;

        return $this;
    }

    /**
     * Remove homework
     *
     * @param \AppBundle\Entity\Homework $homework
     */
    public function removeHomework(\AppBundle\Entity\Homework $homework)
    {
        $this->homeworks->removeElement($homework);
    }

    /**
     * Get homeworks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHomeworks()
    {
        return $this->homeworks;
    }
}
