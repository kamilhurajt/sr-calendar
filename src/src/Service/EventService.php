<?php

namespace Sr\Service;

use Sr\Entity\Event;
use Sr\Repository\EventRepository;
use Sr\Repository\RepositoryInterface;
use Sr\Validation\ValidatorInterface;

class EventService
{

    /**
     * @var EventRepository
     */
    protected $eventRepository;

    /**
     * @var ValidatorInterface
     */
    protected $eventValidator;

    /**
     * EventService constructor.
     * @param RepositoryInterface $eventRepository
     * @param ValidatorInterface $eventValidator
     */
    public function __construct(
        RepositoryInterface $eventRepository,
        ValidatorInterface $eventValidator
    ) {
        $this->eventRepository = $eventRepository;
        $this->eventValidator = $eventValidator;
    }

    /**
     * @param array $data
     *
     * @return array|Event returns entity on success array on failure with errors
     * @throws \Doctrine\ORM\ORMException
     */
    public function createEvent(array $data)
    {
        if ($this->eventValidator->validate($data)) {
            $data['user_password'] = md5($data['user_password']);

            return $this->eventRepository->save($data);
        }

        return $this->eventValidator->getErrors();
    }

    /**
     * @param array $data
     * @param $id
     * @return array|Event returns entity on success array on failure with errors
     * @throws \Exception
     */
    public function updateEvent(array $data, $id)
    {
        if (!$this->eventValidator->validate($data)) {
            return $this->eventValidator->getErrors();
        }

        $event = $this->eventRepository->find($id);

        if (!$event) {
            return [
                ['code' => 404, 'message' => 'Event not found']
            ];
        }

        $data['user_password'] = md5($data['user_password']);

        return $this->eventRepository->save($data, $id);
    }

    /**
     * @param $id
     * @param $password
     * @return array|bool array|bool returns true on success array on failure with errors
     */
    public function removeEvent($id, $password)
    {
        /** @var Event $event */
        $event = $this->eventRepository->find($id);

        if (!$event) {
            return [
                ['code' => 404, 'message' => 'Event not found']
            ];
        }

        if ($event->getUserPassword() !== md5($password)) {
            return [
                ['code' => 4041, 'You dont have permisson to delete this event']
            ];
        }

        return $this->eventRepository->remove($event);
    }
}
