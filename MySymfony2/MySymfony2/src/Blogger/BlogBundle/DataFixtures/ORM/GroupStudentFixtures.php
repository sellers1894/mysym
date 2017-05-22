<?php
namespace Blogger\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Blogger\BlogBundle\Entity\GroupStudent;

class GroupStudentFixtures extends AbstractFixture implements OrderedFixtureInterface{
    public function load(ObjectManager $manager)
    {
        $group1 = new GroupStudent();
        $group1->setTitle("31");
        $manager->persist($group1);

        $group2 = new GroupStudent();
        $group2->setTitle("33");
        $manager->persist($group2);

        $group3 = new GroupStudent();
        $group3->setTitle("35");
        $manager->persist($group3);


        $manager->flush();

        $this->addReference('group-1', $group1);
        $this->addReference('group-2', $group2);
        $this->addReference('group-3', $group3);
    }

    public function getOrder()
    {
        return 2;
    }
}