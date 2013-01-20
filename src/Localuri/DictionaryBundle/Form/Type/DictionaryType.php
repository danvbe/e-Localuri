<?php

namespace Localuri\DictionaryBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DictionaryType extends AbstractType
{
    protected $dictionary_service;

    public function __construct($dictionary_service){
        $this->dictionary_service = $dictionary_service;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type',new DictionaryFormField($this->dictionary_service,null),array(
                'empty_value' => 'Choose a dictionary type',
                'required'=>false,
                ))
            ->add('key')
            ->add('value')
            ->add('description')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Localuri\DictionaryBundle\Entity\Dictionary'
        ));
    }

    public function getName()
    {
        return 'localuri_dictionarybundle_dictionarytype';
    }
}
