<?php

namespace Controller;

/**
 * Class AdminController
 *
 */
class AdminController extends AbstractController
{
    public function index()
    {
        try {
            echo $this->twig->render('Admin/index.html.twig', [

            ]);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
