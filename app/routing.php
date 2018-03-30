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
    'App' => [ // Controller
        ['index', '/', 'GET'], // action, url, method
        ['restauration', '/restauration', 'GET'],
        ['workshop', '/atelier', 'GET'],
        ['kustom', '/kustom', 'GET'],
        ['shop', '/boutique', 'GET'],
    ],
];
