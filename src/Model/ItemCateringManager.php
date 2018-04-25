<?php
/**
 * Created by PhpStorm.
 * User: wilder14
 * Date: 18/04/18
 * Time: 14:58
 */

namespace Model;



class ItemCateringManager extends AbstractManager
{
    const TABLE = 'item_catering';

    public function __construct()
    {

        parent::__construct(self::TABLE);
        $this->className = __NAMESPACE__ . '\\' . 'ItemCatering';
    }

    public function selectCafeteria(): array
    {
        return $this->pdoConnection
            ->query('SELECT * FROM ' . $this->table . ' WHERE category_catering_id = 1 LIMIT 5;', \PDO::FETCH_CLASS, $this->className)->fetchAll();
    }

    public function selectCoffee(): array
    {
        return $this->pdoConnection
            ->query('SELECT * FROM ' . $this->table . ' WHERE category_catering_id = 2 LIMIT 5;', \PDO::FETCH_CLASS, $this->className)->fetchAll();
    }

    public function cateringAdd(itemCatering $newItem)
    {
        $name = $newItem->getName();
        $description = $newItem->getDescription();
        $price = $newItem->getPrice();
        $category_catering_id = $newItem->getCategoryCateringId();

            $query = ('INSERT INTO ' . $this->table . ' (name, price, description, category_catering_id) VALUES (:name, :price, :description, :category_catering_id)');
        $prepare = $this->pdoConnection->prepare($query);

        $prepare->bindValue('name', $name, \PDO::PARAM_STR);
        $prepare->bindValue('description', $description);
        $prepare->bindValue('price', $price);
        $prepare->bindValue('category_catering_id', $category_catering_id);

        $prepare->execute();
    }
}
