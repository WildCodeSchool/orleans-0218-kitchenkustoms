<?php

namespace Controller;

use Controller\AbstractController;
use Model\BikeManager;

/**
 * Class AdminController
 *
 */
class AdminController extends AbstractController
{
    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function index()
    {
            return $this->twig->render('Admin/index.html.twig', [

            ]);
    }
}
