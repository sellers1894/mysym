<?php
namespace Blogger\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * @ORM\Entity(repositoryClass="Blogger\BlogBundle\Entity\Repository\StudentRepository")
 * @ORM\Table(name="Student")
 *  @UniqueEntity(
 *     fields={"email"},
 *     message="Уже есть."
 * )
 * @ORM\HasLifecycleCallbacks
 */
class Student{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\Column(type="string")
     */
    protected $last_name;


    /**
     * @ORM\Column(type="string", unique=true)
     */
    protected $email;

    public static function loadValidatorMetadata(ClassMetadata $metadata){
        $metadata->addPropertyConstraint('name', new NotBlank());
        $metadata->addPropertyConstraint('last_name', new NotBlank());
        $metadata->addPropertyConstraint('email', new Email());
        $metadata->addPropertyConstraint('date_start', new Date());
        $metadata->addPropertyConstraint('date_finish', new Date());
    }


    /**
     * @ORM\Column(type="datetime")
     */
    protected $date_start;


    /**
     * @ORM\Column(type="datetime")
     */
    protected $date_finish;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $protect = null;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $mark = null;

    /**
     * @ORM\ManyToOne(targetEntity="GroupStudent", inversedBy="student")
     * @ORM\JoinColumn(name="groupstudent_id", referencedColumnName="id")
     */
    protected $group;


    /**
     * @ORM\ManyToOne(targetEntity="Company", inversedBy="student")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     */
    protected $company;


    public function __construct()
    {
//        $this->setApproved(true);
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Student
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Student
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
     * Set email
     *
     * @param string $email
     *
     * @return Student
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set dateStart
     *
     * @param \DateTime $dateStart
     *
     * @return Student
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
     * Set dateFinish
     *
     * @param \DateTime $dateFinish
     *
     * @return Student
     */
    public function setDateFinish($dateFinish)
    {
        $this->date_finish = $dateFinish;

        return $this;
    }

    /**
     * Get dateFinish
     *
     * @return \DateTime
     */
    public function getDateFinish()
    {
        return $this->date_finish;
    }

    /**
     * Set company
     *
     * @param \Blogger\BlogBundle\Entity\Company $company
     *
     * @return Student
     */
    public function setCompany(\Blogger\BlogBundle\Entity\Company $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \Blogger\BlogBundle\Entity\Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set protect
     *
     * @param boolean $protect
     *
     * @return Student
     */
    public function setProtect($protect)
    {
        $this->protect = $protect;

        return $this;
    }

    /**
     * Get protect
     *
     * @return boolean
     */
    public function getProtect()
    {
        return $this->protect;
    }

    /**
     * Set mark
     *
     * @param integer $mark
     *
     * @return Student
     */
    public function setMark($mark)
    {
        $this->mark = $mark;

        return $this;
    }

    /**
     * Get mark
     *
     * @return integer
     */
    public function getMark()
    {
        return $this->mark;
    }

    /**
     * Set group
     *
     * @param \Blogger\BlogBundle\Entity\GroupStudent $group
     *
     * @return Student
     */
    public function setGroup(\Blogger\BlogBundle\Entity\GroupStudent $group = null)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return \Blogger\BlogBundle\Entity\GroupStudent
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Add group
     *
     * @param \Blogger\BlogBundle\Entity\GroupStudent $group
     *
     * @return Student
     */
    public function addGroup(\Blogger\BlogBundle\Entity\GroupStudent $group)
    {
        $this->group[] = $group;

        return $this;
    }

    /**
     * Remove group
     *
     * @param \Blogger\BlogBundle\Entity\GroupStudent $group
     */
    public function removeGroup(\Blogger\BlogBundle\Entity\GroupStudent $group)
    {
        $this->group->removeElement($group);
    }
}
