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

    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
        public function bikeShop()
    {
        $defaultPics = "assets/images/bikes/default_bike.png";
        //marks//
        $stars5 = "/assets/images/shop/5stars.png";
        $stars4 = "/assets/images/shop/4stars.png";
        $stars3 = "/assets/images/shop/3stars.png";
        $stars2 = "/assets/images/shop/2stars.png";
        $stars1 = "/assets/images/shop/1stars.png";

        $bikeManager = new BikeManager();
        $bikes = $bikeManager->selectAllShop();
        return $this->twig->render('Home/shop.html.twig', [
            'bikes' => $bikes,
            'default_bike' => $defaultPics,
            'stars5' => $stars5,
            'stars4' => $stars4,
            'stars3' => $stars3,
            'stars2' => $stars2,
            'stars1' => $stars1,
        ]);
    }

}
