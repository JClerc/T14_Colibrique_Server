<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Subject
 *
 * @ORM\Table(name="subject")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SubjectRepository")
 */
class Subject
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
     * @var int
     *
     * @ORM\Column(name="school_year", type="integer")
     */
    private $school_year;

    /**
     * @var int
     *
     * @ORM\Column(name="trimester", type="integer")
     */
    private $trimester;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="professor_id", referencedColumnName="id")
     */
    private $professor;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Promotion", inversedBy="subjects")
     * @ORM\JoinColumn(name="promotion_id", referencedColumnName="id")
     */
    private $promotion;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Course", mappedBy="subject")
     */
    private $courses;

    public function __construct()
    {
        $this->courses = new ArrayCollection();
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
     * @return Subject
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
     * Set schoolYear
     *
     * @param integer $schoolYear
     *
     * @return Subject
     */
    public function setSchoolYear($schoolYear)
    {
        $this->school_year = $schoolYear;

        return $this;
    }

    /**
     * Get schoolYear
     *
     * @return int
     */
    public function getSchoolYear()
    {
        return $this->school_year;
    }

    /**
     * Set trimester
     *
     * @param integer $trimester
     *
     * @return Subject
     */
    public function setTrimester($trimester)
    {
        $this->trimester = $trimester;

        return $this;
    }

    /**
     * Get trimester
     *
     * @return int
     */
    public function getTrimester()
    {
        return $this->trimester;
    }

    /**
     * Set professor
     *
     * @param \AppBundle\Entity\User $professor
     *
     * @return Subject
     */
    public function setProfessor(\AppBundle\Entity\User $professor = null)
    {
        $this->professor = $professor;

        return $this;
    }

    /**
     * Get professor
     *
     * @return \AppBundle\Entity\User
     */
    public function getProfessor()
    {
        return $this->professor;
    }

    /**
     * Set promotion
     *
     * @param \AppBundle\Entity\Promotion $promotion
     *
     * @return Subject
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
     * Add course
     *
     * @param \AppBundle\Entity\Course $course
     *
     * @return Subject
     */
    public function addCourse(\AppBundle\Entity\Course $course)
    {
        $this->courses[] = $course;

        return $this;
    }

    /**
     * Remove course
     *
     * @param \AppBundle\Entity\Course $course
     */
    public function removeCourse(\AppBundle\Entity\Course $course)
    {
        $this->courses->removeElement($course);
    }

    /**
     * Get courses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCourses()
    {
        return $this->courses;
    }
}
