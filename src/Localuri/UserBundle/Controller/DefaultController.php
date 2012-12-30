<?php

namespace Localuri\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('LocaluriUserBundle:Default:index.html.twig', array('name' => $name));
    }
}
