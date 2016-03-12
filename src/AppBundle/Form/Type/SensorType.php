<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SensorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array('attr' => array('class' => 'Form-control')))
            ->add('deviceId', null, array('attr' => array('class' => 'Form-control')))
            ->add('metric', EntityType::class, array(
                'class' => 'AppBundle:Metric',
                'choice_label' => 'name',
            ))
            ->add('submit', SubmitType::class, array(
                'attr' => array(
                    'class' => 'btn btn-default',
                    ),
                'label' => 'Add Sensor'
                )
            )
            ->setAttribute('class', 'form-inline')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Sensor',
        ));
    }
}