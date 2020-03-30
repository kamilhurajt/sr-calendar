<?php

namespace Sr\Repository;

use Doctrine\ORM\EntityRepository;
use Sr\Entity\Event;

class EventRepository extends EntityRepository implements RepositoryInterface
{

    /**
     * @param array $data
     * @param null $id
     * @return Event
     * @throws \Exception
     */
    public function save(array $data, $id = null)
    {
        // create entity & persist data
        $event = Event::create(
            $data['name'],
            $data['city'],
            $data['start_date'],
            $data['user_password'],
            $data['description']
        );

        $this->getEntityManager()->persist($event);
        $this->getEntityManager()->flush();

        return $event;
    }

    /**
     * @param Event $event
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function remove(Event $event)
    {
        $this->getEntityManager()->remove($event);
        $this->getEntityManager()->flush();

        return true;
    }
}