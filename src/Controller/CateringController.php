<?php
/**
 * Created by PhpStorm.
 * User: wilder14
 * Date: 18/04/18
 * Time: 14:57
 */

namespace Controller;

use Model\ItemCatering;
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

    public function cateringAdd()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $itemsCateringName = $_POST['name'];
            $itemsCateringDescription = $_POST['description'];
            $itemsCateringPrice = $_POST['price'];
            $itemsCateringCategory = $_POST['category'];

            $newItem = new ItemCatering();
            $newItem->setName($itemsCateringName);
            $newItem->setDescription($itemsCateringDescription);
            $newItem->setPrice($itemsCateringPrice);
            $newItem->setCategoryCateringId($itemsCateringCategory);

            $itemCateringManager = new ItemCateringManager();
            try {
                $itemCateringManager->cateringAdd($newItem);
            } catch (\LogicException $e) {
                $_SESSION['error_add'] = 'Le plat ou la boisson n\'a pas été ajouté.';
                header('Location: /admin/restauration/add');
            }

            header('Location: /admin/restauration');
            exit();
        }


        return $this->twig->render('Admin/addCatering.html.twig',[
            'post'=> $_POST
            ]);

    }

}