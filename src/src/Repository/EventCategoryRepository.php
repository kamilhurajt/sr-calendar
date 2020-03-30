<?php

namespace Sr\Repository;

use Doctrine\ORM\EntityRepository;
use Sr\Entity\EventCategory;

class EventCategoryRepository extends EntityRepository implements RepositoryInterface
{

    /**
     * @param array $data
     * @param null $id
     * @return EventCategory
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(array $data, $id = null)
    {
        $relation = new EventCategory();
        $relation->setCategory($data['category']);
        $relation->setEvent($data['event']);

        $this->getEntityManager()->persist($relation);
        $this->getEntityManager()->flush();

        return $relation;
    }
}
