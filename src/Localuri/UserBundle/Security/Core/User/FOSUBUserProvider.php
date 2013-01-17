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
        //on connect - get the access token
        $serviceAccessTokenName = $response->getResourceOwner()->getName() . 'AccessToken';
        $serviceAccessTokenSetter = 'set' . ucfirst($serviceAccessTokenName);

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
            $user = $this->userManager->createUser();
            switch($service) {
                case 'google':
                    $user = $this->loadGoogleUser($response);
                    break;
                case 'facebook':
                    $user = $this->loadFacebookUser($response);
                    break;
                case 'github':
                    $user = $this->loadGithubUser($response);
                    break;
            }

            //the user needs to be reloaded in order to assign roles...
            //don't know why, but this is the ONLY way it worked
            $user1 = $this->userManager->findUserBy(array($this->getProperty($response) => $username));
            $user1->addRole('ROLE_ADMIN');
            $this->userManager->updateUser($user1);

            return $user1;
        }

        //if user exists - go with the HWIOAuth way
        $user = parent::loadUserByOAuthUserResponse($response);

        $serviceName = $response->getResourceOwner()->getName();
        $setter = 'set' . ucfirst($serviceName) . 'AccessToken';

        //update access token
        $user->$setter($response->getAccessToken());

        return $user;
    }

    protected function loadGoogleUser(UserResponseInterface $response){
        $user = $this->userManager->createUser();
        $username = $response->getUsername();
        $user->setGoogleId($username);
        $user->setGoogleAccessToken($response->getAccessToken());
        $email = $response->getEmail();
        $user->setUsername($username);
        $user->setName($response->getRealName());
        $user->setPassword('');
        $user->setEmail($email);
        $user->setEnabled(true);
        $this->userManager->updateUser($user);
        return $user;
    }

    protected function loadFacebookUser(UserResponseInterface $response){
        $username = $response->getUsername();
        $user = $this->userManager->createUser();
        $user->setFacebookId($username);
        $user->setFacebookAccessToken($response->getAccessToken());
        $email = $response->getEmail();
        $user->setUsername($username);
        $user->setName($response->getName());
        $user->setPassword('');
        $user->setEmail($email);
        $user->setEnabled(true);
        $this->userManager->updateUser($user);
        return $user;
    }

    protected function loadGithubUser(UserResponseInterface $response){
        $username = $response->getUsername();
        $user = $this->userManager->createUser();
        $user->setGithubId($username);
        $user->setGithubAccessToken($response->getAccessToken());
        $email = $response->getEmail();
        $user->setUsername($username);
        $user->setName($response->getRealName());
        $user->setPassword('');
        $user->setEmail($email);
        $user->setEnabled(true);
        $this->userManager->updateUser($user);
        return $user;
    }

}