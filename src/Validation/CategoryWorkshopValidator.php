<?php

namespace Validation;

use Validation\Validator\MaxLength;
use Validation\Validator\NotEmpty;

class CategoryWorkshopValidator extends Validation
{

    public function __construct($data)
    {
        $validators = [
            'name' => [
                new NotEmpty($data['name']),
                new MaxLength($data['name'], 45)
            ]
        ];

        parent::__construct($validators);
    }
}
