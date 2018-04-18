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
        $itemCateringCantine = $itemCateringManager->selectCantine();
        $itemCateringCafe = $itemCateringManager->selectCafe();
        var_dump($itemCateringCafe);
        var_dump($itemCateringCantine);
        return $this->twig->render('Home/catering.html.twig', [
            'itemCateringCantine' => $itemCateringCantine,
            'itemCateringCafe' => $itemCateringCafe,
        ]);
    }

}