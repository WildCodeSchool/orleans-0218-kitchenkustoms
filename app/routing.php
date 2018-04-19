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
        ['kustoms', '/kustoms', 'GET'],
        ['shop', '/boutique', 'GET'],
    ],
    'Admin' => [
        ['index', '/admin', 'GET'],
    ],
    'Bike' => [
        ['bike', '/admin/bike', 'GET'],
        ['bikeAdd', '/admin/bike/add', ['GET', 'POST']],
    ],
    'Catering'=> [
        ['catering', '/restauration', 'GET'],
        ['adminCatering', '/admin/restauration', 'GET']
    ],
    'Workshop' => [
        ['index', '/atelier', 'GET'],
        ['adminIndex', '/admin/atelier', 'GET']
    ]
];
