<?php

namespace Localuri\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class LocaluriUserBundle extends Bundle
{
    /*
     * We overwrite this function to tell Symfony thos bundle is child of FosUserBundle,
     * in order to use the templates from this Bundle's views
     */
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
