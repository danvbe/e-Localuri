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
        $dictionary->setValue('Specific');
        $dictionary->setDescription('Specific');    //this needs to be like the class name
        $manager->persist($dictionary);

        $dictionary = new Dictionary();
        $dictionary->setValue('Category');
        $dictionary->setDescription('Category');    //this needs to be like the class name
        $manager->persist($dictionary);

        $cat = new Category();
        $cat->setValue('Category 1');
        $cat->setDescription('Category 1');
        $cat->setType($dictionary);
        $manager->persist($cat);

        $cat = new Category();
        $cat->setValue('Category 2');
        $cat->setDescription('Category 2');
        $cat->setType($dictionary);
        $manager->persist($cat);


        $dictionary = new Dictionary();
        $dictionary->setValue('Genre');
        $dictionary->setDescription('Values for Genres');
        $manager->persist($dictionary);

        $dict = new Dictionary();
        $dict->setType($dictionary);
        $dict->setValue('Male');
        $dict->setDescription('Male genre');
        $manager->persist($dict);

        $dict = new Dictionary();
        $dict->setType($dictionary);
        $dict->setValue('Female');
        $dict->setDescription('Female genre');
        $manager->persist($dict);


        $manager->flush();
    }
}
