<?php
/**
 * Created by JetBrains PhpStorm.
 * User: danvbe
 * Date: 2/21/13
 * Time: 8:59 AM
 * To change this template use File | Settings | File Templates.
 */
namespace Localuri\DictionaryBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Localuri\DictionaryBundle\Entity\Dictionary;
use Localuri\DictionaryBundle\Entity\Category;

/**
 * load default/sample pages
 * php app/console doctrine:fixtures:load
 */
class LoadDictionaryData implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     * @param null|\Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $dictionary = new Dictionary();
        $dictionary->setKey('category');
        $dictionary->setValue('Category');
        $dictionary->setDescription('Values for categories of locals');
        $manager->persist($dictionary);

        $dictionary = new Category();
        $dictionary->setKey('cat-1');
        $dictionary->setValue('Category 1');
        $dictionary->setDescription('Category 1');
        $manager->persist($dictionary);

        $dictionary = new Category();
        $dictionary->setKey('cat-2');
        $dictionary->setValue('Category 2');
        $dictionary->setDescription('Category 2');
        $manager->persist($dictionary);


        $dictionary = new Dictionary();
        $dictionary->setKey('genre');
        $dictionary->setValue('Genre');
        $dictionary->setDescription('Values for Genres');
        $manager->persist($dictionary);

        $dictionary = new Dictionary();
        $dictionary->setType('genre');
        $dictionary->setKey('m');
        $dictionary->setValue('Male');
        $dictionary->setDescription('Male genre');
        $manager->persist($dictionary);

        $dictionary = new Dictionary();
        $dictionary->setType('genre');
        $dictionary->setKey('f');
        $dictionary->setValue('Female');
        $dictionary->setDescription('Female genre');
        $manager->persist($dictionary);


        $manager->flush();
    }
}
