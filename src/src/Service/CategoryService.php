<?php

namespace Sr\Service;

use Sr\Entity\Category;
use Sr\Repository\CategoryRepository;
use Sr\Repository\RepositoryInterface;

class CategoryService
{

    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * CategoryService constructor.
     * @param RepositoryInterface $categoryRepository
     */
    public function __construct(
        RepositoryInterface $categoryRepository
    )
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param string $name
     * @return Category
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createCategory(string $name)
    {
            $truncatedName = strtolower(str_replace(' ', '', $name));
            $hash          = md5($truncatedName);

            $category = $this->categoryRepository->findOneBy(['hash' => $hash]);
            if ($category) {
                return $category;
            }

            return $this->categoryRepository->save(['name' => $name, 'hash' => $hash]);
    }
}
