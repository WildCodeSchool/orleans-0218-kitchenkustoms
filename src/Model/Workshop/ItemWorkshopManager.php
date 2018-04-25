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

    public function updateItem(ItemWorkshop $item)
    {
        $queryValues = 'name=:name, price=:price, category_workshop_id=:category_workshop_id';
        $statement = $this->pdoConnection->prepare("UPDATE $this->table SET $queryValues WHERE id=:id");

        $statement->bindValue(':name', $item->getName(), \PDO::PARAM_STR);
        $statement->bindValue(':price', $item->getPrice(), \PDO::PARAM_STR);
        $statement->bindValue(':category_workshop_id', $item->getCategoryWorkshopId(), \PDO::PARAM_INT);
        $statement->bindValue(':id', $item->getId());

        return $statement->execute();
    }
}
