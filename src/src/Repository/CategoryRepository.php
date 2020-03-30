<?php

namespace Sr\Repository;

use Doctrine\ORM\EntityRepository;
use Sr\Entity\Category;

class CategoryRepository extends EntityRepository implements RepositoryInterface
{

    /**
     * @param array $data
     * @param null $id
     * @return mixed
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(array $data, $id = null)
    {
        if ($id) {
            $category = Category::createForUpdate(
                $id,
                $data['name'],
                $data['city'],
                $data['start_date'],
                $data['user_password'],
                $data['description']
            );
        } else {
            $category = Category::create();
        }

        $this->getEntityManager()->persist($category);
        $this->getEntityManager()->flush();

        return $category;
    }

    /**
     * @param Category $category
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function remove(Category $category)
    {
        $this->getEntityManager()->remove($category);
        $this->getEntityManager()->flush();

        return true;
    }
}
