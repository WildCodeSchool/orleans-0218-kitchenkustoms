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

        try {
            echo $this->twig->render('App/index.html.twig', [

            ]);
        } catch (\Twig_Error_Loader $e) {
            echo $e->getMessage();
        } catch (\Twig_Error_Runtime $e) {
            echo $e->getMessage();
        } catch (\Twig_Error_Syntax $e) {
            echo $e->getMessage();
        }
    }

    public function restoration()
    {
        try {
            echo $this->twig->render('App/restoration.html.twig', [

            ]);
        } catch (\Twig_Error_Loader $e) {
            echo $e->getMessage();
        } catch (\Twig_Error_Runtime $e) {
            echo $e->getMessage();
        } catch (\Twig_Error_Syntax $e) {
            echo $e->getMessage();
        }
    }

    public function workshop()
    {
        try {
            echo $this->twig->render('App/workshop.html.twig', [

            ]);
        } catch (\Twig_Error_Loader $e) {
            echo $e->getMessage();
        } catch (\Twig_Error_Runtime $e) {
            echo $e->getMessage();
        } catch (\Twig_Error_Syntax $e) {
            echo $e->getMessage();
        }
    }

    public function kustoms()
    {
        try {
            echo $this->twig->render('App/kustom.html.twig', [

            ]);
        } catch (\Twig_Error_Loader $e) {
            echo $e->getMessage();
        } catch (\Twig_Error_Runtime $e) {
            echo $e->getMessage();
        } catch (\Twig_Error_Syntax $e) {
            echo $e->getMessage();
        }
    }


    public function shop()
    {
        try {
            echo $this->twig->render('App/shop.html.twig', [

            ]);
        } catch (\Twig_Error_Loader $e) {
            echo $e->getMessage();
        } catch (\Twig_Error_Runtime $e) {
            echo $e->getMessage();
        } catch (\Twig_Error_Syntax $e) {
            echo $e->getMessage();
        }
    }
}
