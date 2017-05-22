<?php
namespace Blogger\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Blogger\BlogBundle\Entity\Company;

class CompanyFixtures extends AbstractFixture implements OrderedFixtureInterface{
    public function load(ObjectManager $manager)
    {
        $conpany1 = new Company();
        $conpany1->setTitle("Epam");
        $conpany1->setText("EPAM Systems — американская ИТ-компания, производитель заказного программного обеспечения, специалист по консалтингу, резидент Белорусского парка высоких технологий. Штаб-квартира компании расположена в Ньютауне (США, штат Пенсильвания), а её отделения представлены в 25 странах мира. \nДеятельность: \nИТ-консалтинг \nРазработка программного обеспечения \nИнтеграция приложений \nПортирование и миграция приложений");
        $conpany1->setImage("main1.jpg");

        $manager->persist($conpany1);

        $conpany2 = new Company();
        $conpany2->setTitle("Anderson");
        $conpany2->setText("Компания Andersen берет свое начало в Минске. В 2007 году два выпускника физического факультета БГУ – Александр Хомич и Александр Цобкало – решили всерьез заняться разработкой программного обеспечения. Серьезные намерения и стали причиной появления бренда Andersen \nНа данный момент Andersen это интернациональная команда из более чем двухсот человек. Наши специалисты находятся в нескольких офисах в Беларуси и Украине, а центры продаж существуют также в Москве и Париже.\n Andersen это огромный опыт, отличные специалисты, объединенные командным духом, превосходно налаженные процессы и постоянный приток новых кадров. Все эти составляющие позволяют нам быть уверенными в том, что история компании только начинает писаться!");
        $conpany2->setImage("main1.jpg");

        $manager->persist($conpany2);

        $conpany3 = new Company();
        $conpany3->setTitle("Innovation Group");
        $conpany3->setText("INNOWISE GROUP is a Belarussian professional software development company experienced in solving the most challenging tasks for the US and European IT markets. The company was founded in 2004 and has two development centers – in Vitebsk (headquarters) and in Minsk. Innowise Group has partners in the USA, Lithuania, and Russia.\n Innowise Group delivers the following high-end services:\n - Custom application development including development from scratch\n - Building high-tech IT solutions based on well known products from Microsoft, Oracle, IBM, Zend Technologies, as well as on Open Source products\n- Innovative R&D solutions");
        $conpany3->setImage("main.jpg");

        $manager->persist($conpany3);

        $conpany4 = new Company();
        $conpany4->setTitle("Vitiaz");
        $conpany4->setText("Lorem ipsum dolor sit amet, consectetur adipiscing eletra electrify denim vel ports.\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ut velocity magna. Etiam vehicula nunc non leo hendrerit commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras el mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras elementum molestie vestibulum. Morbi id quam nisl. Praesent hendrerit, orci sed elementum lobortis, justo mauris lacinia libero, non facilisis purus ipsum non mi. Aliquam sollicitudin, augue id vestibulum iaculis, sem lectus convallis nunc, vel scelerisque lorem tortor ac nunc. Donec pharetra eleifend enim vel porta.\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ut velocity magna. Etiam vehicula nunc non leo hendrerit commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras el mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras elementum molestie vestibulum. Morbi id quam nisl. Praesent hendrerit, orci sed elementum lobortis, justo mauris lacinia libero, non facilisis purus ipsum non mi. Aliquam sollicitudin, augue id vestibulum iaculis, sem lectus convallis nunc, vel scelerisque lorem tortor ac nunc. Donec pharetra eleifend enim vel porta.");
        $conpany4->setImage("main.jpg");

        $manager->persist($conpany4);

        $manager->flush();

        $this->addReference('company-1', $conpany1);
        $this->addReference('company-2', $conpany2);
        $this->addReference('company-3', $conpany3);
        $this->addReference('company-4', $conpany4);
    }

    public function getOrder()
    {
        return 1;
    }
}