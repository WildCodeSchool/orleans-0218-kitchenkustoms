<?php
/**
 * Created by PhpStorm.
 * User: wilder16
 * Date: 10/04/18
 * Time: 17:34
 */

namespace Model;

class BikeManager extends AbstractManager
{
    const TABLE = 'bike';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function addBike(Bike $bike)
    {
        $query = 'INSERT INTO ' . $this->table . ' (name, description) VALUES (:name, :description)';
        $prepare = $this->pdoConnection->prepare($query);
        $prepare->bindValue('name', $bike->getName(), \PDO::PARAM_STR);
        $prepare->bindValue('description', $bike->getDescription());

        $prepare->execute();
    }
}
