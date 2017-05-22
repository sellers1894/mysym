<?php
namespace Blogger\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Blogger\BlogBundle\Entity\Company;
use Blogger\BlogBundle\Entity\GroupStudent;
use Blogger\BlogBundle\Entity\Student;

class StudentFixtures extends AbstractFixture implements OrderedFixtureInterface{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $student = new Student();
        $student->setName("Андрей");
        $student->setLastName("Фролов");
        $student->setEmail("bla@mail.ru");
        $student->setDateStart(new \DateTime("12.12.2016"));
        $student->setDateFinish(new \DateTime("12.01.2017"));
        $student->setCompany($manager->merge($this->getReference("company-1")));
        $student->setGroup($manager->merge($this->getReference("group-1")));
        $manager->persist($student);

        $student = new Student();
        $student->setName("Пётр");
        $student->setLastName("Аксёнов");
        $student->setEmail("asdfghj@mail.ru");
        $student->setDateStart(new \DateTime("12.12.2016"));
        $student->setDateFinish(new \DateTime("12.01.2017"));
        $student->setCompany($manager->merge($this->getReference("company-1")));
        $student->setGroup($manager->merge($this->getReference("group-1")));
        $manager->persist($student);

        $student = new Student();
        $student->setName("Игорь");
        $student->setLastName("Аксёнов");
        $student->setEmail("aesfvd@yandex.ru");
        $student->setDateStart(new \DateTime("21.12.2016"));
        $student->setDateFinish(new \DateTime("19.02.2017"));
        $student->setCompany($manager->merge($this->getReference("company-1")));
        $student->setGroup($manager->merge($this->getReference("group-2")));
        $manager->persist($student);


        $student = new Student();
        $student->setName("Валерий");
        $student->setLastName("Соболев");
        $student->setEmail("eadcsd@mail.ru");
        $student->setDateStart(new \DateTime("11.11.2016"));
        $student->setDateFinish(new \DateTime("12.03.2017"));
        $student->setCompany($manager->merge($this->getReference("company-2")));
        $student->setGroup($manager->merge($this->getReference("group-1")));
        $manager->persist($student);

        $student = new Student();
        $student->setName("Алексей");
        $student->setLastName("Исаков");
        $student->setEmail("adc@yandex.ru");
        $student->setDateStart(new \DateTime("12.12.2016"));
        $student->setDateFinish(new \DateTime("12.01.2017"));
        $student->setCompany($manager->merge($this->getReference("company-2")));
        $student->setGroup($manager->merge($this->getReference("group-3")));
        $manager->persist($student);

        $student = new Student();
        $student->setName("Евгений");
        $student->setLastName("Кузнецов");
        $student->setEmail("kkr@gmail.com");
        $student->setDateStart(new \DateTime("21.12.2016"));
        $student->setDateFinish(new \DateTime("19.02.2017"));
        $student->setCompany($manager->merge($this->getReference("company-2")));
        $student->setGroup($manager->merge($this->getReference("group-3")));
        $manager->persist($student);


        $student = new Student();
        $student->setName("Игорь");
        $student->setLastName("Горбачёв");
        $student->setEmail("xcvsv@gmail.com");
        $student->setDateStart(new \DateTime("24.12.2016"));
        $student->setDateFinish(new \DateTime("09.02.2017"));
        $student->setCompany($manager->merge($this->getReference("company-3")));
        $student->setGroup($manager->merge($this->getReference("group-3")));
        $manager->persist($student);

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 3;
    }
}
