<?php

namespace Controller\Admin;

use Controller\AbstractController;
use Model\BikeManager;

/**
 * Class AdminController
 *
 */
class AdminController extends AbstractController
{
    public function index()
    {
            return $this->twig->render('Admin/index.html.twig', [

            ]);
    }

    public function bike()
    {
        $bikeManager = new BikeManager();
        $bikes = $bikeManager->selectAll();

        return $this->twig->render('Admin/bike.html.twig', [
            'bikes' => $bikes,
        ]);
    }
}
