<?php

namespace Model\Workshop;

use Model\AbstractManager;

class ItemWorkshopManager extends AbstractManager
{
    const TABLE = 'item_workshop';

    public function __construct()
    {
        parent::__construct(self::TABLE);
        $this->className = __NAMESPACE__ . '\\' . 'ItemWorkshop';
    }

    /**
     * Select all items join with category
     *
     * @return array
     */
    public function selectAllWithCategories(): array
    {
        $categoriesTable = CategoryWorkshopManager::TABLE;

        $statement = 'SELECT 
                I.category_workshop_id,
                C.name AS category_name,
                I.id,
                I.name,
                I.price
            FROM
                ' . $this->table . ' AS I
                    INNER JOIN
                ' . $categoriesTable . ' AS C ON (C.id = I.category_workshop_id)
            ORDER BY C.id, I.id';

        $query = $this->pdoConnection->query($statement, \PDO::FETCH_CLASS, $this->className);
        return $query->fetchAll();
    }

    /**
     * Find all Items group by category names
     *
     * @return array An assoc. array of WorkshopItems Objects
     */
    public function selectAllGroupByCategories(): array
    {
        $allWithCategories = $this->selectAllWithCategories();
        $results = [];
        foreach ($allWithCategories as $row) {
            $results[$row->category_name][] = $row;
        }
        return $results;
    }

    /**
     * Check errors for Post data
     *
     * @param array $data
     * @return array
     */
    public static function checkErrors(array $data)
    {
        $errors = [];

        $fieldsNames = ['name', 'price', 'category_workshop_id'];
        foreach ($fieldsNames as $fieldName) {
            $errors[$fieldName] = ['value' => $data[$fieldName], 'error' => false];

            if (empty(trim($_POST[$fieldName]))) {
                $errors[$fieldName]['error'] = 'Ce champ ne peut pas être vide.';
            }
        }

        if (!isset($errors['price'])) {
            if (!is_numeric($_POST['price'])) {
                $errors['price']['error'] = 'Le prix doit être un nombre';
            } else {
                if ($_POST['price'] < 0 || $_POST['price'] >= 1000) {
                    $errors['price']['error'] = 'Le prix doit être compris entre 0 et 999.99';
                }
            }
        }
        if (!isset($errors['category_workshop_id'])) {
            $categoriesManager = new CategoryWorkshopManager();
            $categoryIds = $categoriesManager->selectAllOnlyIds();
            if (!in_array($_POST['category_workshop_id'], $categoryIds)) {
                $errors['category_workshop_id']['error'] = 'La catégorie doit exister';
            }
        }
        return $errors;
    }
}
