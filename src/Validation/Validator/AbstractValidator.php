<?php

namespace Validation\Validator;

abstract class AbstractValidator
{
    private $value;

    private $error;

    public function __construct($value)
    {
        $this->value = $value;
    }

    abstract public function isValid(): bool;

    public function getValue()
    {
        return $this->value;
    }

    public function getError(): string
    {
        return $this->error;
    }

    public function setError(string $error)
    {
        $this->error = $error;
    }
}
