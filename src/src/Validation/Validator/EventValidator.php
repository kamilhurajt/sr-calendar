<?php

namespace Sr\Validation\Validator;

use Sr\Validation\SymfonyValidatorAbstract;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\GroupSequence;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Optional;

class EventValidator extends SymfonyValidatorAbstract
{

    /**
     * @inheritDoc
     */
    protected function getGroup(): GroupSequence
    {
        return new GroupSequence(['Default', 'custom_event']);
    }

    /**
     * @inheritDoc
     */
    protected function getValidationCollection(): Collection
    {
        return new Collection([
            'name' => new Length(['min' => 2, 'max' => 200]),
            'user_password' => new Length(['min' => 5, 'max' => 50]),
            'city' => new Length(['min' => 1, 'max' => 100]),
            'start_date' => new DateTime(),
            'description' => new Optional()
        ]);
    }
}
