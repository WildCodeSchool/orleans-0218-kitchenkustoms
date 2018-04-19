<?php
/**
 * Created by PhpStorm.
 * User: wilder14
 * Date: 18/04/18
 * Time: 14:58
 */

namespace Model;


use App\Connection;
use Controller\AbstractController;

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
}
