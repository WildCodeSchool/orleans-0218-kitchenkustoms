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

    /**
     * Select all kustom bike who 2 pictures
     * @return array
     */
    public function selectAllKustoms()
    {
        return $this->pdoConnection
            ->query(    'SELECT * FROM '. $this->table . ' WHERE is_kustom',
                \PDO::FETCH_CLASS, $this->className)->fetchAll();
    }
}
