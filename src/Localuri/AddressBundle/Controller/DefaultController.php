<?php

namespace Localuri\AddressBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('LocaluriAddressBundle:Default:index.html.twig', array('name' => $name));
    }
}
