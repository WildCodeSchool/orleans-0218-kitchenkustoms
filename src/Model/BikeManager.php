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
     * @return int
     */
    public function lastId(): int
    {
        return (int)$this->pdoConnection->lastInsertId();
    }

    public function selectAllShop()
    {
        return $this->pdoConnection
            ->query('SELECT * FROM ' . $this->table . ' WHERE is_sold=1', \PDO::FETCH_CLASS, $this->className)
            ->fetchAll();
    }

    /**
     * Select all kustom bike who 2 pictures
     * @return array
     */
    public function selectAllKustoms()
    {
        return $this->pdoConnection
            ->query('SELECT * FROM ' . $this->table . ' WHERE is_kustom', \PDO::FETCH_CLASS, $this->className)
            ->fetchAll();
            ->query('SELECT * FROM ' . $this->table . ' WHERE is_kustom',
                \PDO::FETCH_CLASS, $this->className)->fetchAll();
    }

    public function addBike(Bike $bike)
    {
        $name = $bike->getName();
        $description = $bike->getDescription();

        if ($name === "" || $name === null) {
            throw new \LogicException('Le nom du vélo ne peut être null ou vide.');
        }

        $query = 'INSERT INTO ' . $this->table . ' (name, description) VALUES (:name, :description)';
        $prepare = $this->pdoConnection->prepare($query);

        $prepare->bindValue('name', $name, \PDO::PARAM_STR);
        $prepare->bindValue('description', $description);

        $prepare->execute();
    }

    public function updateBike(Bike $bike)
    {
        $querySet = ' SET name=:name, description=:description, rate_look=:rate_look, rate_practice=:rate_practice, rate_fun=:rate_fun, price=:price, sold=:sold, is_kustom=:is_kustom, is_sold=:is_sold';
        if ($bike->getPhotoBefore() !== null) {
            $querySet .= ' , photo_before=:photo_before';
        }

        if ($bike->getPhotoAfter() !== null) {
            $querySet .= ' , photo_after=:photo_after';
        }

        $query = 'UPDATE ' . $this->table . $querySet . ' WHERE id=:id';
        $prepare = $this->pdoConnection->prepare($query);

        $prepare->bindValue('id', $bike->getId(), \PDO::PARAM_INT);
        $prepare->bindValue('name', $bike->getName(), \PDO::PARAM_STR);
        $prepare->bindValue('description', $bike->getDescription());
        $prepare->bindValue('rate_look', $bike->getRateLook());
        $prepare->bindValue('rate_practice', $bike->getRatePractice());
        $prepare->bindValue('rate_fun', $bike->getRateFun());
        $prepare->bindValue('price', $bike->getPrice());
        $prepare->bindValue('sold', $bike->getSold(), \PDO::PARAM_BOOL);
        $prepare->bindValue('is_kustom', $bike->getIsKustom(), \PDO::PARAM_BOOL);
        $prepare->bindValue('is_sold', $bike->getIsSold(), \PDO::PARAM_BOOL);

        if ($bike->getPhotoBefore() !== null) {
            $prepare->bindValue('photo_before', $bike->getPhotoBefore());
        }

        if ($bike->getPhotoAfter() !== null) {
            $prepare->bindValue('photo_after', $bike->getPhotoAfter());
        }

        $prepare->execute();
    }
}
