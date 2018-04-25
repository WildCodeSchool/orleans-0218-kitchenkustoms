<?php

namespace Validation;

use Model\Workshop\CategoryWorkshopManager;

class ItemWorkshopValidator
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
        $errors = [];

        $fieldsNames = ['name', 'price', 'category_workshop_id'];
        foreach ($fieldsNames as $fieldName) {
            $errors[$fieldName] = ['value' => $data[$fieldName], 'error' => false];

            if (empty($data[$fieldName])) {
                $errors[$fieldName]['error'] = 'Ce champ ne peut pas être vide.';
            }
        }

        if (!$errors['name']['error']) {
            if (mb_strlen($data['name']) > 45) {
                $errors['name']['error'] = 'Le nom ne peut excéder 45 caractères.';
            }
        }

        if (!$errors['price']['error']) {
            if (!is_numeric($data['price'])) {
                $errors['price']['error'] = 'Le prix doit être un nombre';
            } else {
                if ($data['price'] < 0 || $data['price'] >= 1000) {
                    $errors['price']['error'] = 'Le prix doit être compris entre 0 et 999.99';
                }
            }
        }

        if (!$errors['category_workshop_id']['error']) {
            $categoriesManager = new CategoryWorkshopManager();
            $categoryIds = $categoriesManager->selectAllOnlyIds();
            if (!in_array($data['category_workshop_id'], $categoryIds)) {
                $errors['category_workshop_id']['error'] = 'La catégorie doit exister.';
            }
        }

        $this->errors = $errors;

        return ($this->nbErrors() === 0);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function nbErrors(): int
    {
        return array_reduce($this->errors, function ($nb, $error) {
            return $nb + ($error['error'] !== false);
        }, 0);
    }
}
