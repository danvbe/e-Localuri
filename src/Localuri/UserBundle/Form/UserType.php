<?php

namespace Localuri\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use \Localuri\DictionaryBundle\Form\Type\DictionaryFormField;

class UserType extends AbstractType
{
    protected $dictionary_service;

    public function __construct($dictionary_service){
        $this->dictionary_service = $dictionary_service;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('usernameCanonical')
            ->add('email')
            ->add('emailCanonical')
            ->add('genre',new DictionaryFormField($this->dictionary_service,'genre'),array(
                'empty_value'=>'Select genre',
                'required'=>false,
            ))
            ->add('enabled')
            ->add('salt')
            ->add('password')
            ->add('lastLogin')
            ->add('confirmationToken')
            ->add('passwordRequestedAt')
            ->add('roles')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Localuri\UserBundle\Entity\User'
        ));
    }

    public function getName()
    {
        return 'localuri_userbundle_usertype';
    }
}
