<?php

namespace Controller;

/**
 * Class AppController
 *
 */
class AppController extends AbstractController
{
    public function index()
    {
        echo $this->twig->render('App/index.html.twig', [

        ]);
    }

    public function restauration()
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
