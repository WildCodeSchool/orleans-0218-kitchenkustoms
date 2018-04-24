<?php

namespace Controller;

use Model\Bike;
use Model\BikeManager;

/**
 * Class BikeController
 *
 */
class BikeController extends AbstractController
{
    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function bikeAdmin()
    {
        $bikeManager = new BikeManager();
        $bikes = $bikeManager->selectAll();
        return $this->twig->render('Admin/bike.html.twig', [
            'bikes' => $bikes,
            'get' => $_GET,
        ]);
    }

    public function bikeKustoms()
    {
        $bikeManager = new BikeManager();
        $bikes = $bikeManager->selectAllKustoms();
        return $this->twig->render('Home/kustom.html.twig', [
            'bikes' => $bikes,
        ]);
    }

   
    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function bikeShop()
    {
        $defaultPics = "assets/images/bikes/default.png";

        $bikeManager = new BikeManager();
        $bikes = $bikeManager->selectAllShop();
        return $this->twig->render('Home/shop.html.twig', [
            'bikes' => $bikes,
            'default_bike' => $defaultPics,
        ]);
    }

    public function bikeAdd()
    {
        $bikeManager = new BikeManager();

        $newBike = new Bike();
        $newBike->setName('Nom à remplacer...');

        $bikeManager->addBike($newBike);

        $newBike = $bikeManager->selectOneById($bikeManager->lastId());

        return $this->twig->render('Admin/updateBike.html.twig', [
            'bike' => $newBike,
        ]);
    }

    public function bikeUpdate(int $id)
    {
        $bikeManager = new BikeManager();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Bike::checkPhotos($id);

            $bike = Bike::hydrate($_POST);
            $bikeManager->updateBike($bike);

            header('Location: /admin/bike');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['id'])) {
                $bike = $bikeManager->selectOneById($_GET['id']);
            } else {
                $bike = $bikeManager->selectOneById($id);
            }

            return $this->twig->render('Admin/updateBike.html.twig', [
                'bike' => $bike,
            ]);
        }
    }

    public function bikeDelete(int $id)
    {
        $bikeManager = new BikeManager();

        $deleted = $bikeManager->delete($id);

        if ($deleted) {
            $get = '?deleted=true&id=' . $id;
        } else {
            $get = '?deleted=false&id=' . $id;
        }

        header('Location: /admin/bike' . $get);
        exit();
    }
}
