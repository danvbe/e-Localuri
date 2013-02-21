<?php
namespace Ccestudio\UsersBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Localuri\UserBundle\Entity\User;

/**
 * load default/sample users
 * php app/console doctrine:fixtures:load
 */
class LoadUserData implements FixtureInterface, ContainerAwareInterface
{
	/**
	 * @var ContainerInterface
	 */
	private $container;

	/**
	 * {@inheritDoc}
	 */
	public function setContainer(ContainerInterface $container = null)
	{
		$this->container = $container;
	}

	/**
	 * {@inheritDoc}
	 */
	public function load(ObjectManager $manager)
	{
		$user = new User();
		$user->setUsername('admin');
		$user->setEmail('admin@e-localuri.com');
		$user->addRole('ROLE_SUPER_ADMIN');
		$user->setEnabled(true);
		$encoder = $this->container->get('security.encoder_factory')->getEncoder($user);
		$user->setPassword($encoder->encodePassword('admin', $user->getSalt()));

		$manager->persist($user);
		$manager->flush();
	}
}