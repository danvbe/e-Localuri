<?php
/**
 * Created by JetBrains PhpStorm.
 * User: danvbe
 * Date: 1/5/13
 * Time: 11:31 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Localuri\UserBundle\Security\Core\User;

use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface,
    HWI\Bundle\OAuthBundle\Security\Core\Exception\AccountNotLinkedException;
use HWI\Bundle\OAuthBundle\Security\Core\User\FOSUBUserProvider as BaseClass;

class FOSUBUserProvider extends BaseClass
{

    /**
     * {@inheritDoc}
     */
    public function connect($user, UserResponseInterface $response)
    {
        $property = $this->getProperty($response);
        $username = $response->getUsername();

        //on connect - get the access token and the user ID
        $service = $response->getResourceOwner()->getName();

        $setter = 'set'.ucfirst($service);
        $setter_id = $setter.'Id';
        $setter_token = $setter.'AccessToken';

        //we "disconnect" previously connected users
        if (null !== $previousUser = $this->userManager->findUserBy(array($property => $username))) {
            $previousUser->$setter_id(null);
            $previousUser->$setter_token(null);
            $this->userManager->updateUser($previousUser);
        }

        //we connect current user
        $user->$setter_id($username);
        $user->$setter_token($response->getAccessToken());

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
            //we check for the email existence - if so, redirect to login.
            if($existent_user = $this->userManager->findUserByEmail($response->getEmail())){
                throw new \Symfony\Component\Security\Core\Exception\AuthenticationException(sprintf("Email '%s' already in use.", $response->getEmail()));
            }
            //we check for the username existence - if so, redirect to login.
            if($existent_user = $this->userManager->findUserByUsername($response->getEmail())){
                throw new \Symfony\Component\Security\Core\Exception\AuthenticationException(sprintf("Username '%s' already in use.", $response->getEmail()));
            }
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
        $user->setUsername($email);
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
        $user->setUsername($email);
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
        $user->setUsername($email);
        $user->setName($response->getRealName());
        $user->setPassword('');
        $user->setEmail($email);
        $user->setEnabled(true);
        $this->userManager->updateUser($user);
        return $user;
    }

}