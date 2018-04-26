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
     * @param int $id
     * @return array
     */
    public function selectElementsByCategoryId(int $id): array
    {
        $query = 'SELECT * FROM item_workshop 
                    JOIN category_workshop 
                    ON category_workshop.id=item_workshop.category_workshop_id 
                    WHERE category_workshop.id=:id';

        $prepare = $this->pdoConnection->prepare($query);
        $prepare->bindValue('id', $id, \PDO::PARAM_INT);

        $prepare->execute();

        $elements = $prepare->fetchAll(\PDO::FETCH_CLASS, ItemWorkshop::class);

        return $elements;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $categoryWorkshopManager = new CategoryWorkshopManager();
        $existElementCategory = $categoryWorkshopManager->selectElementsByCategoryId($id);

        if (!empty($existElementCategory)) {
            return false;
        }
        return parent::delete($id);
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
