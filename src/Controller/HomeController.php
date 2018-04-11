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
        $activities = [
            [
                'name' => 'Le Bar',
                'description' => 'Grignoter, boire un bon café, un bon thé, une bière artisanale, du vin naturel...',
                'link' => '/restauration',
                'image' => 'cafe.jpg'
            ],
            [
                'name' => 'L\'Atelier',
                'description' => 'Faire réparer son vélo',
                'link' => '/atelier',
                'image' => 'atelier.jpg'
            ],
            [
                'name' => 'Les Kustoms',
                'description' => 'Faire enjoliver son vélo pour une touche vintage.',
                'link' => '/kustoms',
                'image' => 'kustoms.jpg'
            ],
            [
                'name' => 'La Boutique',
                'description' => 'Acheter un vélo unique à partir de chinage et d\'un incroyable savoir-faire !',
                'link' => '/boutique',
                'image' => 'boutique.jpg'
            ]
        ];
        return $this->twig->render('Home/index.html.twig', ['activities'=>$activities]);
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
