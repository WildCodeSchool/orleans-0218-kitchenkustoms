<?php

namespace Model\Workshop;

use Model\AbstractManager;

class CategoryWorkshopManager extends AbstractManager
{
    const TABLE = 'category_workshop';

    public function __construct()
    {
        parent::__construct(self::TABLE);
        $this->className = __NAMESPACE__ . '\\' . 'CategoryWorkshop';
    }

    /**
     * Find all categories ids
     *
     * @return array Indexed array of ids
     */
    public function selectAllOnlyIds(): array
    {
        return $this->pdoConnection
            ->query('SELECT id FROM ' . $this->table, \PDO::FETCH_COLUMN, 0)->fetchAll();
    }

    /**
     * Update a category
     *
     * @param CategoryWorkshop $category
     * @return bool
     */
    public function updateCategory(CategoryWorkshop $category): bool
    {
        $statement = $this->pdoConnection->prepare("UPDATE $this->table SET name=:name WHERE id=:id");
        $statement->bindValue(':name', $category->getName(), \PDO::PARAM_STR);
        $statement->bindValue(':id', $category->getId(), \PDO::PARAM_INT);

        return $statement->execute();
    }
}
