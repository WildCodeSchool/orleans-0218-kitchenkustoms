<?php

namespace Validation\Validator;

class MaxLength extends AbstractValidator
{
    const ERROR = 'Impossible de dépasser %d caractères.';

    private $maxValue;

    public function __construct(string $value, int $maxValue)
    {
        $this->maxValue = $maxValue;
        parent::__construct($value);
    }

    public function isValid(): bool
    {
        if (mb_strlen($this->getValue()) > $this->maxValue) {
            $this->setError(sprintf(self::ERROR, $this->maxValue));
            return false;
        }
        return true;
    }
}
