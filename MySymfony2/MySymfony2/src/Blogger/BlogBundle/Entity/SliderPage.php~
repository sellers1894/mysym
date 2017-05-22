<?php
namespace Blogger\BlogBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Blogger\BlogBundle\Entity\Repository\SliderPageRepository")
 * @ORM\Table(name="sliderpage")
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(
 *     fields={"company"},
 *     message="Уже выбрано."
 * )
 */
class SliderPage{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $title;

    /**
     * @ORM\Column(type="string")
     */
    protected $text;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Please, upload the product brochure as a image.")
     * @Assert\File(mimeTypes={ "image/png","image/jpeg" })
     */
    protected $image;


    public static function loadValidatorMetadata(ClassMetadata $metadata){
        $metadata->addPropertyConstraint('title', new NotBlank());
        $metadata->addPropertyConstraint('text',  new Length(array(
            'min'        => 5

        )));
        $metadata->addPropertyConstraint('image', new NotBlank());
    }

    /**
     * @ORM\ManyToOne(targetEntity="Company", inversedBy="sliderpage")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     */
    protected $company;

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
     * @return SliderPage
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
     * Set text
     *
     * @param string $text
     *
     * @return SliderPage
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return SliderPage
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set company
     *
     * @param \Blogger\BlogBundle\Entity\Company $company
     *
     * @return SliderPage
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
}
