<?php
/**
 * This file hold all routes definitions.
 *
 * PHP version 7
 *
 * @author   WCS <contact@wildcodeschool.fr>
 *
 * @link     https://github.com/WildCodeSchool/simple-mvc
 */

$routes = [
    'Home' => [ // Controller
        ['index', '/', 'GET'], // action, url, method
    ],
    'Admin' => [
        ['index', '/admin', 'GET'],
    ],
    'Bike' => [
        ['bikeShop', '/boutique', 'GET'],
        ['bikeAdmin', '/admin/bike', 'GET'],
        ['bikeKustoms', '/kustoms', 'GET'],
        ['bikeAdd', '/admin/bike/add', 'GET'],
        ['bikeUpdate', '/admin/bike/{id:\d+}', ['GET', 'POST']],
        ['bikeDelete', '/admin/bike/delete/{id:\d+}', 'POST'],
    ],
    'Catering' => [
        ['catering', '/restauration', 'GET'],
        ['adminCatering', '/admin/restauration', 'GET'],
        ['cateringAdd', '/admin/restauration/add', ['GET', 'POST']],
        ['cateringDelete', '/admin/restauration/delete/{id:\d+}', 'POST'],
    ],
    'Workshop' => [
        ['index', '/atelier', 'GET'],
        ['adminIndex', '/admin/atelier', 'GET'],
        ['adminAdd', '/admin/atelier', 'POST'],
        ['adminUpdate', '/admin/atelier/{id:\d+}', ['GET','POST']],
        ['adminDelete', '/admin/atelier/delete/{id:\d+}', 'POST'],
    ],
    'WorkshopCategory' => [
        ['adminIndex', '/admin/atelier/categories', 'GET'],
        ['adminAdd', '/admin/atelier/categories', 'POST'],
        ['adminDelete', '/admin/atelier/categories/delete/{id:\d+}', 'POST'],
        ['adminUpdate', '/admin/atelier/categories/{id:\d+}', ['GET', 'POST']],
    ],
    'Pdf'=>[
        ['adminUpdatePdf', '/admin/carte', ['GET', 'POST']],
    ]
];
