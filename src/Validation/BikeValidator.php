<?php

namespace Validation;

use Validation\Validator\MaxLength;
use Validation\Validator\NotEmpty;

class BikeValidator extends Validation
{
    /**
     * BikeValidator constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $validators = [
            'name' => [
                new NotEmpty($data['name']),
                new MaxLength($data['name'], 45)
            ],
            'description' => [
                new MaxLength($data['description'], 255)
            ],
        ];

        parent::__construct($validators);
    }
}
