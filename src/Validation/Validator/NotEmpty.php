<?php

namespace Validation\Validator;

class NotEmpty extends AbstractValidator
{
    const ERROR = 'La valeur ne peut pas être vide';

    public function isValid(): bool
    {
        if (empty($this->getValue())) {
            $this->setError(self::ERROR);
            return false;
        }
        return true;
    }
}
