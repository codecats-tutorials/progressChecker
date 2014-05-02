<?php
/**
 * Created by PhpStorm.
 * User: t
 * Date: 4/20/14
 * Time: 11:54 AM
 */

namespace CodeCats\PanelBundle\EventListener;


use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use CodeCats\PanelBundle\Entity\User;
use Symfony\Component\Config\Definition\Exception\Exception;


class UserManager {
    protected $container;

    public function __construct(\Symfony\Component\DependencyInjection\ContainerInterface $container) {
        $this->container = $container;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObjectManager();
        $object = $args->getObject();

        if ($object instanceof User) {

            $factory    = $this->container->get('security.encoder_factory');
            $encoder    = $factory->getEncoder($object);
            $password   = $encoder->encodePassword($object->getPassword(), $object->getSalt());

            $object->setPassword($password);
        }
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $this->prePersist($args);
    }
} 