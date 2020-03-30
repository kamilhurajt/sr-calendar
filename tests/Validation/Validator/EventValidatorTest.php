<?php

namespace Tests\Validation\Validator;

use PHPUnit\Framework\TestCase;
use Sr\Entity\Event;
use Sr\Validation\Validator\EventValidator;

class EventValidatorTest extends TestCase
{
    public function testValidate()
    {
        $data = [
            'name' => 'test',
            'city' => 'test',
            'start_date' => date("Y-m-d H:i:s"),
            'user_password' => 12345,
            'description' => 'test'
        ];

        $validator = new EventValidator();
        $this->assertTrue($validator->validate($data));
    }

    public function testInvalidValidations()
    {
        $data = [
            'name' => 'test',
            'city' => 'test',
            'start_date' => date("Y-m-d H:i:s"),
            'user_password' => 1235,
            'description' => 'test'
        ];

        $validator = new EventValidator();
        $this->assertFalse($validator->validate($data));
        $error = $validator->getErrors()[0];

        $this->assertStringContainsString('user_password', $error['code']);

        $data = [
            'name' => '',
            'city' => 'test',
            'start_date' => date("Y-m-d H:i:s"),
            'user_password' => 12345,
            'description' => 'test'
        ];

        $this->assertFalse($validator->validate($data));
        $error = $validator->getErrors()[0];

        $this->assertStringContainsString('name', $error['code']);

        $data = [
            'name' => 'test',
            'city' => '',
            'start_date' => date("Y-m-d H:i:s"),
            'user_password' => 12345,
            'description' => 'test'
        ];

        $this->assertFalse($validator->validate($data));
        $error = $validator->getErrors()[0];

        $this->assertStringContainsString('city', $error['code']);

        $data = [
            'name' => 'test',
            'city' => 'test',
            'start_date' => date("Y-m H:i:s"),
            'user_password' => 12345,
            'description' => 'test'
        ];

        $this->assertFalse($validator->validate($data));
        $error = $validator->getErrors()[0];

        $this->assertStringContainsString('start_date', $error['code']);
    }
}