<?php
/**
 * Created by JetBrains PhpStorm.
 * User: danvbe
 * Date: 1/5/13
 * Time: 11:31 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Localuri\UserBundle\Security\Core\User;

use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\FOSUBUserProvider as BaseClass;

class FOSUBUserProvider extends BaseClass
{

    /**
     * {@inheritDoc}
     */
    public function connect($user, UserResponseInterface $response)
    {
        //throw new \RuntimeException('Test error');
        $property = $this->getProperty($response);
        $setter = 'set'.ucfirst($property);

        $username = $response->getUsername();

        $serviceAccessTokenName = $response->getResourceOwner()->getName() . 'AccessToken';
        $serviceAccessTokenSetter = 'set' . ucfirst($serviceAccessTokenName);

        if(method_exists($user, $serviceAccessTokenSetter))
            $user->$serviceAccessTokenSetter($response->getAccessToken());

        $this->userManager->updateUser($user);
    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        //throw new \RuntimeException('Test error');
        $username = $response->getUsername();
        $user = $this->userManager->findUserBy(array($this->getProperty($response) => $username));
        if (null === $user) {
            $service = $response->getResourceOwner()->getName();
            $setter = 'set'.ucfirst($service);
            $setter_id = $setter.'Id';
            $setter_token = $setter.'AccessToken';
                //throw new AccountNotLinkedException(sprintf("User '%s' not found.", $username));
            // create new user here
            $user = $this->userManager->createUser();
            $user->setUsername($username);
            $user->setEmail($username);
            $user->setPassword($username);
            $user->$setter_id($username);
            $user->$setter_token($response->getAccessToken());
            $user->setEnabled(true);
            $this->userManager->updateUser($user);
            return $user;
        }

        $user = parent::loadUserByOAuthUserResponse($response);

        $serviceName = $response->getResourceOwner()->getName();
        $setter = 'set' . ucfirst($serviceName) . 'AccessToken';

        if (method_exists($user, $setter)) {
            $user->$setter($response->getAccessToken());
        }

        return $user;
    }

}