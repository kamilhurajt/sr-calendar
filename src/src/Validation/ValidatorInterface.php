<?php

namespace Sr\Validation;

interface ValidatorInterface
{
    /**
     * @param array $data
     * @return mixed
     */
    public function validate(array $data);

    public function getErrors();
}
