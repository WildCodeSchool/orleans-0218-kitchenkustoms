<?php
/**
 * Created by PhpStorm.
 * User: legolas
 * Date: 27/04/18
 * Time: 08:44
 */

namespace Validation;


use Validation\Validator\MaxLength;
use Validation\Validator\NotEmpty;

class CateringValidator extends Validation
{
    public function __construct($data)
    {
        $validators = [
            'name' => [
                new NotEmpty($data['name']),
                new MaxLength($data['name'],45)
            ],
            'price' => [
                new NotEmpty($data['price']),
                new MaxLength($data['price'],45)
            ]
        ];
        parent::__construct($validators);
    }
}