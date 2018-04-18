<?php

namespace Model\Workshop;

use Model\AbstractManager;

class ItemWorkshopManager extends AbstractManager
{
    const TABLE = 'item_workshop';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    /**
     * Find all Items group by category names
     * @return array An assoc. array of WorkshopItems Objects
     */
    public function selectAllGroupByCategories(): array
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
                ' . $categoriesTable . ' AS C ON (C.id = I.category_workshop_id)';

        $query = $this->pdoConnection->query($statement, \PDO::FETCH_ASSOC);

        $results = [];
        while ($row = $query->fetch()) {
            $item = new ItemWorkshop();
            $results[$row['category_name']][] = $item->hydrate($row);
        }
        return $results;
    }
}
