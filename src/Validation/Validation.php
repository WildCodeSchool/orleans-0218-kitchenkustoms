<?php

namespace Validation;

class Validation
{
    private $elements = [];

    private $errors = [];

    public function __construct(array $keysValidators)
    {
        $this->elements = $keysValidators;
    }

    public function isValid(): bool
    {
        foreach ($this->elements as $key => $validators) {
            $this->errors[$key] = [];
            foreach ($validators as $validator) {
                if (!$validator->isValid()) {
                    $this->errors[$key][] = $validator->getError();
                }
            }
        }

        foreach ($this->errors as $error) {
            if (!empty($error)) {
                return false;
            }
        }

        return true;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
