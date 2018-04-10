<?php

namespace Controller\Admin;

use Controller\AbstractController;

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
}
