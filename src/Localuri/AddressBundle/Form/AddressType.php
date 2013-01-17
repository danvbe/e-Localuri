<?php

namespace Localuri\AddressBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('country_code')
            ->add('county_code')
            ->add('city')
            ->add('street')
            ->add('number')
            ->add('latitude')
            ->add('longitude')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Localuri\AddressBundle\Entity\Address'
        ));
    }

    public function getName()
    {
        return 'localuri_addressbundle_addresstype';
    }
}
