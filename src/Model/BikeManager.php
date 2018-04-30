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
    }

    public function addBike(Bike $bike)
    {
        $query = 'INSERT INTO ' . $this->table . '(name, description, rate_look, rate_practice, rate_fun, price, sold, is_kustom, is_sold) VALUES (:name, :description, :rate_look, :rate_practice, :rate_fun, :price, :sold, :is_kustom  ,:is_sold)';
        $prepare = $this->pdoConnection->prepare($query);

        $prepare->bindValue('name', $bike->getName(), \PDO::PARAM_STR);
        $prepare->bindValue('description', $bike->getDescription());
        $prepare->bindValue('rate_look', $bike->getRateLook());
        $prepare->bindValue('rate_practice', $bike->getRatePractice());
        $prepare->bindValue('rate_fun', $bike->getRateFun());
        $prepare->bindValue('price', $bike->getPrice());
        $prepare->bindValue('sold', $bike->getSold(), \PDO::PARAM_BOOL);
        $prepare->bindValue('is_kustom', $bike->getIsKustom(), \PDO::PARAM_BOOL);
        $prepare->bindValue('is_sold', $bike->getIsSold(), \PDO::PARAM_BOOL);

        $prepare->execute();

        //gestion des photos
        $id = $this->lastId();
        foreach ($_FILES as $photo => $details) {
            if ($details['error'] === 0) {
                $name = $id;

                if ($photo === 'photo_after') {
                    $name .= '_after';
                } elseif ($photo === 'photo_before') {
                    $name .= '_before';
                }
                $name .= '.jpg';

                $moveFile = new UplodedFile($details, '../assets/images/bikes/', $name);
                $uploaded = $moveFile->process('image/jpeg');

                if ($uploaded) {
                    $bike = $this->selectOneById($id);

                    if ($photo === 'photo_after') {
                        $bike->setPhotoAfter('/assets/images/bikes/' . $id . '_after.jpg');
                    } elseif ($photo === 'photo_before') {
                        $bike->setPhotoBefore('/assets/images/bikes/' . $id . '_before.jpg');
                    }
                    $this->updateBike($bike);
                }
            }
        }
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
