<?php

namespace Validation;

class CategoryWorkshopValidator
{

    private $data;

    private $errors = [];

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function isValid(): bool
    {
        $data = $this->data;

        if (empty($data['name'])) {
            $this->errors['name'] = ['error' => 'Le nom ne peut être vide.'];

            return false;
        }

        if (mb_strlen($data['name']) > 45) {
            $this->errors['name'] = [
                'value' => $data['name'],
                'error' => 'Le nom ne peut excéder 45 caractères.'
            ];
            return false;
        }
        return true;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
