<?php
namespace Blogger\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Blogger\BlogBundle\Entity\Company;
use Blogger\BlogBundle\Entity\SliderPage;

class SliderPageFixtures extends AbstractFixture implements OrderedFixtureInterface{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $slider = new SliderPage();
        $slider->setTitle("Epam");
        $slider->setText("Основан в 1993г.");
        $slider->setImage("Epam.jpg");
        $slider->setCompany($manager->merge($this->getReference("company-1")));
        $manager->persist($slider);

        $slider = new SliderPage();
        $slider->setTitle("Anderson");
        $slider->setText("Основан в 2007г.");
        $slider->setImage("Andersen.jpg");
        $slider->setCompany($manager->merge($this->getReference("company-2")));
        $manager->persist($slider);

        $slider = new SliderPage();
        $slider->setTitle("Innovation Group");
        $slider->setText("");
        $slider->setImage("Group.jpg");
        $slider->setCompany($manager->merge($this->getReference("company-3")));
        $manager->persist($slider);

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 2;
    }
}
