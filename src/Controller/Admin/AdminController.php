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

        try {
            return $this->twig->render('Admin/index.html.twig', [

            ]);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
