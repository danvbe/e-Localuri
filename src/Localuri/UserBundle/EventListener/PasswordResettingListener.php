<?php
/**
 * Created by JetBrains PhpStorm.
 * User: danvbe
 * Date: 2/10/13
 * Time: 11:38 AM
 * To change this template use File | Settings | File Templates.
 */
namespace Localuri\UserBundle\EventListener;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use FOS\UserBundle\Model\UserManager;

/**
 * Listener responsible to change the redirection at the end of the password resetting
 */
class PasswordResettingListener implements EventSubscriberInterface
{
    private $router;
    private $context;
    private $user_manager;

    public function __construct(UrlGeneratorInterface $router, SecurityContext $context, UserManager  $user_manager)
    {
        $this->router = $router;
        $this->context = $context;
        $this->user_manager = $user_manager;
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::RESETTING_RESET_SUCCESS => 'onPasswordResettingSuccess',
        );
    }

    public function onPasswordResettingSuccess(FormEvent $event)
    {
        $user = $this->context->getToken()->getUser();

        $user->setIsSiteRegistered(true);

        $this->user_manager->updateUser($user);

        $url = $this->router->generate('homepage');

        $event->setResponse(new RedirectResponse($url));
    }
}
