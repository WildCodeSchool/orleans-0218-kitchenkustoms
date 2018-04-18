<?php

namespace Controller;

use Controller\AbstractController;
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

    public function bikeShop()
    {
        $bikes = $this->bike();

        return $this->twig->render('Home/Shop.html.twig', [
            'bikes' => $bikes,
        ]);
    }
}
