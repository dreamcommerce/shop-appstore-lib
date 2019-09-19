<?php

declare(strict_types=1);

namespace DreamCommerce\Component\ShopAppstore\Doctrine\ORM\Subscriber;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use DreamCommerce\Component\ShopAppstore\Model\ApplicationDependInterface;
use DreamCommerce\Component\ShopAppstore\Repository\ApplicationRepositoryInterface;

class ApplicationSubscriber implements EventSubscriber
{
    /**
     * @var ApplicationRepositoryInterface
     */
    private $applicationRepository;

    /**
     * @param ApplicationRepositoryInterface $applicationRepository
     */
    public function __construct(ApplicationRepositoryInterface $applicationRepository)
    {
        $this->applicationRepository = $applicationRepository;
    }

    /**
     * @return array
     */
    public function getSubscribedEvents()
    {
        return array(
            Events::postLoad
        );
    }

    /**
     * @param LifecycleEventArgs $eventArgs
     */
    public function postLoad(LifecycleEventArgs $eventArgs)
    {
        $entity = $eventArgs->getEntity();
        if ($entity instanceof ApplicationDependInterface) {
            $appName = $entity->getApplicationName();
            if($appName === null) {
                return;
            }

            $em = $eventArgs->getEntityManager();
            $classMetadata = $em->getClassMetadata(ApplicationDependInterface::class);
            $connectorReflProp = $classMetadata->reflClass->getProperty('application');
            $connectorReflProp->setAccessible(true);
            $connectorReflProp->setValue($entity, $this->applicationRepository->getApplicationByName($appName));
        }
    }
}