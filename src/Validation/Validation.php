<?php

namespace Validation;

class Validation
{
    /**
     * @var array
     */
    private $elements = [];
    /**
     * @var array
     */
    private $errors = [];

    /**
     * Validation constructor.
     * @param array $keysValidators
     */
    public function __construct(array $keysValidators)
    {
        $this->elements = $keysValidators;
    }

    /**
     * @return bool
     */
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

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
