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


    private function bike()
    {
        $bikeManager = new BikeManager();
        $bikes = $bikeManager->selectAll();
        return $bikes;
    }

    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function bikeAdmin()
    {
        $bikes = $this->bike();
        return $this->twig->render('Admin/bike.html.twig', [
            'bikes' => $bikes,
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $bikeName = $_POST['name'];
            $bikeDescription = $_POST['description'];

            $newBike = new Bike();
            $newBike->setName($bikeName);
            $newBike->setDescription($bikeDescription);

            $bikeManager = new BikeManager();
            try {
                $bikeManager->addBike($newBike);
            } catch (\LogicException $e) {
                $_SESSION['error_add'] = 'Le vélo n\'a pas été ajouté.';
                header('Location: /admin/add');
            }


            header('Location: /admin/bike');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            return $this->twig->render('Admin/addBike.html.twig', []);
        }
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
            $bike = $bikeManager->selectOneById($id);

            return $this->twig->render('Admin/updateBike.html.twig', [
                'bike' => $bike,
            ]);
        }
    }
}
