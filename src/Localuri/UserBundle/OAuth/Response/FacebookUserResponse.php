<?php
/**
 * Created by JetBrains PhpStorm.
 * User: danvbe
 * Date: 1/16/13
 * Time: 7:11 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Localuri\UserBundle\OAuth\Response;

use HWI\Bundle\OAuthBundle\OAuth\Response\AdvancedPathUserResponse;

/**
 * FacebookUserResponse
 *
 */
class FacebookUserResponse extends AdvancedPathUserResponse
{
    /**
     * {@inheritdoc}
     */
    public function getEmail()
    {
        return $this->getValueForPath('email', false);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getValueForPath('name', false);
    }

    /**
     * {@inheritdoc}
     */
    public function getFirstName()
    {
        return $this->getValueForPath('firstname', false);
    }

    /**
     * {@inheritdoc}
     */
    public function getLastName()
    {
        return $this->getValueForPath('lastname', false);
    }

    /**
     * {@inheritdoc}
     */
    public function getGender()
    {
        return $this->getValueForPath('gender', false);
    }

    /**
     * {@inheritdoc}
     */
    public function getLocale()
    {
        return $this->getValueForPath('locale', false);
    }
}