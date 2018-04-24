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

    public function catering()
    {
        $itemCateringManager = new ItemCateringManager();
        $cafeteriaItems = $itemCateringManager->selectCafeteria();
        $coffeeItems = $itemCateringManager->selectCoffee();

        return $this->twig->render('Home/catering.html.twig', [
            'cafeteriaItems' => $cafeteriaItems,
            'coffeeItems' => $coffeeItems,
        ]);
    }

    public function adminCatering()
    {
        $itemCateringManager = new ItemCateringManager();

        $cateringItems = $itemCateringManager->selectAll();

        return $this->twig->render('Admin/catering.html.twig', [
            'cateringItems' => $cateringItems,
        ]);
    }

    public function cateringDelete(int $id)
    {
        $manager = new ItemCateringManager();
        $deleted = $manager->delete($id);
        if ($deleted) {
            $get = '?deleted=true&id='. $id;
        }else {
            $get = '?deleted=false&id='. $id;
        }
        var_dump($get);
        header('Location: /admin/restauration'. $get);
        exit();
    }

}