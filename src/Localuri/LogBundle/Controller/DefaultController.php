<?php

namespace Localuri\LogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('LocaluriLogBundle:Default:index.html.twig', array('name' => $name));
    }
}
