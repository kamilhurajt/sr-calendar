<?php

namespace Tests\Service;

use PHPUnit\Framework\TestCase;
use Sr\Entity\Event;
use Sr\Repository\EventRepository;
use Sr\Repository\RepositoryInterface;
use Sr\Service\EventService;
use Sr\Validation\ValidatorInterface;

class EventServiceTest extends TestCase
{
    public function testCreate()
    {
        $data = [
            'name' => 'test name',
            'city' => 'test city',
            'user_password' => 'test password',
            'start_date' => date('Y-m-d H:i:s'),
            'description' => 'test desc'
        ];

        $entity = Event::create(
            $data['name'],
            $data['city'],
            $data['start_date'],
            md5($data['user_password']),
            $data['description']
        );

        $repositoryMock = $this->getMockBuilder(RepositoryInterface::class)
            ->onlyMethods(['save'])
            ->getMock();

        $repData = $data;
        $repData['user_password'] = md5($data['user_password']);
        $repositoryMock
            ->expects($this->once())
            ->method('save')
            ->with($repData)
            ->willReturn($entity);

        $validatorMock = $this->getMockBuilder(ValidatorInterface::class)
            ->onlyMethods(['validate', 'getErrors'])
            ->getMock();

        $validatorMock
            ->expects($this->once())
            ->method('validate')
            ->willReturn(true);

        $eventService = new EventService($repositoryMock, $validatorMock);

        $result = $eventService->createEvent($data);

        $this->assertInstanceOf(Event::class, $result);
    }

    public function testFailCreate()
    {
        $data = [
            'name' => 'test name',
            'city' => 'test city',
            'user_password' => 'test password',
            'start_date' => date('Y-m-d H:i:s'),
            'description' => 'test desc'
        ];

        $error = [['code' => 1, 'message' => 'test error']];

        $repositoryMock = $this->getMockBuilder(RepositoryInterface::class)
            ->onlyMethods(['save'])
            ->getMock();

        $validatorMock = $this->getMockBuilder(ValidatorInterface::class)
            ->onlyMethods(['validate', 'getErrors'])
            ->getMock();

        $validatorMock
            ->expects($this->once())
            ->method('validate')
            ->willReturn(false);

        $validatorMock
            ->expects($this->once())
            ->method('getErrors')
            ->willReturn($error);

        $eventService = new EventService($repositoryMock, $validatorMock);

        $result = $eventService->createEvent($data);

        $this->assertEquals($error, $result);
    }

    public function testUpdate()
    {
        $data = [
            'name' => 'test name',
            'city' => 'test city',
            'user_password' => 'test password',
            'start_date' => date('Y-m-d H:i:s'),
            'description' => 'test desc'
        ];

        $entity = Event::create(
            $data['name'],
            $data['city'],
            $data['start_date'],
            md5($data['user_password']),
            $data['description']
        );

        $repositoryMock = $this->getMockBuilder(EventRepository::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['save','find'])
            ->getMock();

        $repData = $data;
        $repData['user_password'] = md5($data['user_password']);
        $repositoryMock
            ->expects($this->once())
            ->method('save')
            ->with($repData, 1)
            ->willReturn($entity);

        $repositoryMock
            ->expects($this->once())
            ->method('find')
            ->with(1)
            ->willReturn($entity);

        $validatorMock = $this->getMockBuilder(ValidatorInterface::class)
            ->onlyMethods(['validate', 'getErrors'])
            ->getMock();

        $validatorMock
            ->expects($this->once())
            ->method('validate')
            ->willReturn(true);

        $eventService = new EventService($repositoryMock, $validatorMock);

        $result = $eventService->updateEvent($data, 1);

        $this->assertInstanceOf(Event::class, $result);
    }

    public function testFailUpdate()
    {
        $data = [
            'name' => 'test name',
            'city' => 'test city',
            'user_password' => 'test password',
            'start_date' => date('Y-m-d H:i:s'),
            'description' => 'test desc'
        ];

        $error = [['code' => 1, 'message' => 'test error']];

        $repositoryMock = $this->getMockBuilder(RepositoryInterface::class)
            ->onlyMethods(['save'])
            ->getMock();

        $validatorMock = $this->getMockBuilder(ValidatorInterface::class)
            ->onlyMethods(['validate', 'getErrors'])
            ->getMock();

        $validatorMock
            ->expects($this->once())
            ->method('validate')
            ->willReturn(false);

        $validatorMock
            ->expects($this->once())
            ->method('getErrors')
            ->willReturn($error);

        $eventService = new EventService($repositoryMock, $validatorMock);

        $result = $eventService->createEvent($data);

        $this->assertEquals($error, $result);
    }

    public function testRemove()
    {
        $event = Event::create('test', 'test', date('Y-m-d'), md5('1234'));

        $repositoryMock = $this->getMockBuilder(EventRepository::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['remove', 'find'])
            ->getMock();

        $validatorMock = $this->getMockBuilder(ValidatorInterface::class)
            ->onlyMethods(['validate', 'getErrors'])
            ->getMock();

        $repositoryMock
            ->expects($this->once())
            ->method('remove')
            ->with($event)
            ->willReturn(true);

        $repositoryMock
            ->expects($this->once())
            ->method('find')
            ->with(1)
            ->willReturn($event);

        $eventService = new EventService($repositoryMock, $validatorMock);

        $result = $eventService->removeEvent(1, 1234);
        $this->assertTrue($result);
    }
}