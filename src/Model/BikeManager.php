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
        $id = $bike->getId();
        $name = $bike->getName();
        $description = $bike->getDescription();
        $photo_before = $bike->getPhotoBefore();
        $photo_after = $bike->getPhotoAfter();
        $rate_look = $bike->getRateLook();
        $rate_practice = $bike->getRatePractice();
        $rate_fun = $bike->getRateFun();
        $price = $bike->getPrice();
        $sold = $bike->getSold();
        $is_kustom = $bike->getIsKustom();
        $is_sold = $bike->getIsSold();

        $query = 'UPDATE ' . $this->table .
                ' SET name=:name, description=:description, photo_before=:photo_before, photo_after=:photo_after, 
                rate_look=:rate_look, rate_practice=:rate_practice, rate_fun=:rate_fun, price=:price, sold=:sold, 
                is_kustom=:is_kustom, is_sold=:is_sold 
                WHERE id=:id';

        $prepare = $this->pdoConnection->prepare($query);

        $prepare->bindValue('id', $id, \PDO::PARAM_INT);
        $prepare->bindValue('name', $name, \PDO::PARAM_STR);
        $prepare->bindValue('description', $description);
        $prepare->bindValue('photo_before', $photo_before);
        $prepare->bindValue('photo_after', $photo_after);
        $prepare->bindValue('rate_look', $rate_look);
        $prepare->bindValue('rate_practice', $rate_practice);
        $prepare->bindValue('rate_fun', $rate_fun);
        $prepare->bindValue('price', $price);
        $prepare->bindValue('sold', $sold, \PDO::PARAM_BOOL);
        $prepare->bindValue('is_kustom', $is_kustom, \PDO::PARAM_BOOL);
        $prepare->bindValue('is_sold', $is_sold, \PDO::PARAM_BOOL);

        $prepare->execute();
    }
}
