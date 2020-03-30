<?php

namespace Tests\Service;

use PHPUnit\Framework\TestCase;
use Sr\Entity\Category;
use Sr\Repository\CategoryRepository;
use Sr\Service\CategoryService;

class CategoryServiceTest extends TestCase
{
    public function testCreate()
    {
        $data = [
            'name' => 'test name',
            'hash' => md5('testname')
        ];

        $entity = Category::create(
            $data['name'],
            $data['hash']
        );

        $repositoryMock = $this->getMockBuilder(CategoryRepository::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['save', 'findOneBy'])
            ->getMock();

        $repositoryMock
            ->expects($this->exactly(2))
            ->method('findOneBy')
            ->with(['hash' => $data['hash']])
            ->willReturnOnConsecutiveCalls(null, $entity);

        $repositoryMock
            ->expects($this->once())
            ->method('save')
            ->with($data)
            ->willReturn($entity);

        $categoryService = new CategoryService($repositoryMock);

        $result = $categoryService->createCategory($data['name']);
        $this->assertInstanceOf(Category::class, $result);
        $result = $categoryService->createCategory($data['name']);
        $this->assertInstanceOf(Category::class, $result);
    }
}