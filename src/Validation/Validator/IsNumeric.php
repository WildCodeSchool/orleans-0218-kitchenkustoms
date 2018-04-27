<?php
/**
 * Created by PhpStorm.
 * User: legolas
 * Date: 27/04/18
 * Time: 10:04
 */

namespace Validation\Validator;


class IsNumeric extends AbstractValidator
{
    const ERROR = 'La valeur doit être numérique.';

    public function isValid(): bool
    {
        if (!is_numeric($this->getValue())) {
            $this->setError(self::ERROR);
            return false;
        }
        return true;
    }
}