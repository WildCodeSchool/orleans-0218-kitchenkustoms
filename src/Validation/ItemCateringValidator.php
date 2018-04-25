<?php
/**
 * Created by PhpStorm.
 * User: wilder14
 * Date: 25/04/18
 * Time: 11:26
 */
namespace Validation;

class ItemCateringValidator
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
        $fieldsNames = ['name', 'description', 'price', 'category_catering_id'];
        foreach ($fieldsNames as $fieldName) {
            $errors[$fieldName] = ['value' => $data[$fieldName],
                'error' => false];
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
                if ($data['price'] < 0 || $data['price'] >= 50) {
                    $errors['price']['error'] = 'Le prix doit être compris entre 0 et 50';
                }
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
