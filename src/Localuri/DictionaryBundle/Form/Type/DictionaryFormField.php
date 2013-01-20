<?php
/**
 * Created by JetBrains PhpStorm.
 * User: danvbe
 * Date: 1/20/13
 * Time: 9:07 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Localuri\DictionaryBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DictionaryFormField extends AbstractType
{

    protected $dictionary_service;
    protected $type;

    public function __construct($dictionary_service, $type = null){
        $this->dictionary_service = $dictionary_service;
        $this->type = $type;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'choices' => $this->dictionary_service->getArrayValues($this->type),
        ));
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'dictionary_type';
    }

    public function getParent()
    {
        return 'choice';
    }
}
