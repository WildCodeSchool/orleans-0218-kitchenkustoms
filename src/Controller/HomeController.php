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
        echo $this->twig->render('App/index.html.twig', [

        ]);
    }

    public function restoration()
    {
        echo $this->twig->render('App/restauration.html.twig', [

        ]);
    }

    public function workshop()
    {
        echo $this->twig->render('App/workshop.html.twig', [

        ]);
    }

    public function kustoms()
    {
        echo $this->twig->render('App/kustom.html.twig', [

        ]);
    }

    public function shop()
    {
        echo $this->twig->render('App/shop.html.twig', [

        ]);
    }
}
