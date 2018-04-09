<?php

namespace Controller;


/**
 * Class HomeController
 *
 */
class HomeController extends AbstractController
{
    public function index()
    {
        echo $this->twig->render('Home/index.html.twig', [ 'api_key' => API_GOOGLE

        ]);
    }

    public function catering()
    {
        echo $this->twig->render('Home/catering.html.twig', [

        ]);
    }

    public function workshop()
    {
        echo $this->twig->render('Home/workshop.html.twig', [

        ]);
    }

    public function kustoms()
    {
        echo $this->twig->render('Home/kustom.html.twig', [

        ]);
    }

    public function shop()
    {
        echo $this->twig->render('Home/shop.html.twig', [

        ]);
    }
}
