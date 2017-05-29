<?php
namespace Blogger\BlogBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * @ORM\Entity(repositoryClass="Blogger\BlogBundle\Entity\Repository\GroupStudentRepository")
 * @ORM\Table(name="groupstudent")
 *  * @UniqueEntity(
 *     fields={"title"},
 *     message="Уже есть."
 * )
 * @ORM\HasLifecycleCallbacks
 */
class GroupStudent{
    public function __construct()
    {
        $this->student = new ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity="Student", mappedBy="groupstudent")
     */
    protected $student;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    protected $title;

    public static function loadValidatorMetadata(ClassMetadata $metadata){
        $metadata->addPropertyConstraint('title', new NotBlank());
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
     * Set title
     *
     * @param string $title
     *
     * @return GroupStudent
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Add Student
     *
     * @param \Blogger\BlogBundle\Entity\Student $student
     *
     * @return GroupStudent
     */
    public function addStudent(\Blogger\BlogBundle\Entity\Student $student)
    {
        $this->student[] = $student;

        return $this;
    }

    /**
     * Remove Student
     *
     * @param \Blogger\BlogBundle\Entity\Student $student
     */
    public function removeStudent(\Blogger\BlogBundle\Entity\Student $student)
    {
        $this->student->removeElement($student);
    }

    /**
     * Get Student
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStudent()
    {
        return $this->student;
    }
}
