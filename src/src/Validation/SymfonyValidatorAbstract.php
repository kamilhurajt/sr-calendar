<?php


namespace Sr\Validation;


use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\GroupSequence;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validation;

/**
 * Abstract implementation of validator for symfony to decoule framework parts and add possibility to replace framework
 *
 * Class SymfonyValidatorAbstract
 * @package Sr\Validation
 */
abstract class SymfonyValidatorAbstract implements ValidatorInterface
{
    /**
     * @var array [0 => ['code' => xxx, 'message' => 'error']
     */
    protected $errors = [];

    /**
     * @param array $data
     * @return bool
     */
    public function validate(array $data)
    {
        $validator = Validation::createValidator();

        $result = $validator->validate($data, $this->getValidationCollection(), $this->getGroup());

        if ($result->count() > 0) {
            $this->setErrors($result);

            return false;
        }

        return true;
    }

    /**
     * Return list of errors and clears error buffer
     *
     * @return array
     */
    public function getErrors()
    {
        $errors = $this->errors;

        // clear errors after you retrieve them
        $this->errors = [];

        return $errors;
    }

    protected function setErrors(ConstraintViolationList $list)
    {
        foreach($list as $error) {
            $this->errors[] = [
                'code' => $error->getPropertyPath(),
                'message' => $error->getMessage(),
            ];
        }
    }

    /**
     * @return GroupSequence
     */
    abstract protected function getGroup(): GroupSequence;

    /**
     * @return Collection
     */
    abstract protected function getValidationCollection(): Collection;
}
