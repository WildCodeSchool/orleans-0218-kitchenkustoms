<?php

namespace Controller;

use Controller\AbstractController;
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
    public function bike()
    {
        $bikeManager = new BikeManager();
        $bikes = $bikeManager->selectAll();

        return $this->twig->render('Admin/bike.html.twig', [
            'bikes' => $bikes,
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
            $bikeManager->addBike($newBike);

            header('Location: /admin/bike');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            return $this->twig->render('Admin/addBike.html.twig', []);
        }
    }
}
