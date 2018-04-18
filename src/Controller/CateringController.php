<?php
/**
 * Created by PhpStorm.
 * User: wilder14
 * Date: 18/04/18
 * Time: 14:57
 */

namespace Controller;

use Model\ItemCateringManager;

class CateringController extends AbstractController
{

    public function itemCatering()
    {
        $itemCateringManager = new ItemCateringManager();
        $itemCatering = $itemCateringManager->selectCantine();
        var_dump($itemCatering);
        return $this->twig->render('Home/catering.html.twig', [
            'itemCatering' => $itemCatering
        ]);
    }
}