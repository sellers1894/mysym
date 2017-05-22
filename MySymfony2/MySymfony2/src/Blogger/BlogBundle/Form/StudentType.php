<?php

namespace Blogger\BlogBundle\Form;

use Doctrine\DBAL\Types\DateTimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\DateTime;

class StudentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('last_name')
            ->add('email', EmailType::class)
            ->add('date_start', DateType::class, array(
                'placeholder' => 'Выбрать дату',
            ))
            ->add('date_finish', DateType::class, array(
                'placeholder' => 'Выбрать дату',
            ))
            ->add('group', EntityType::class, array(
                'class' => 'Blogger\BlogBundle\Entity\GroupStudent',
                'choice_label' => 'title',
            ))
            ->add('company', EntityType::class, array(
                'class' => 'Blogger\BlogBundle\Entity\Company',
                'choice_label' => 'title',
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Blogger\BlogBundle\Entity\Student'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'blogger_blogbundle_student';
    }


}
