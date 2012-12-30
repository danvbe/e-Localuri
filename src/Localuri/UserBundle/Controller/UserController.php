<?php

namespace Localuri\UserBundle\Controller;

use Localuri\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function myAccountAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (!is_object($user) || !$user instanceof User)
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        return $this->render('LocaluriUserBundle:User:myAccount.html.twig', array('user'=>$user));
    }
}