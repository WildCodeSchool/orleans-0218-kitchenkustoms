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
use Validation\ItemCateringValidator;

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
            'get' => $_GET,
        ]);
    }

    public function cateringAdd()
    {
       if(!empty($_POST)) {
            $postData = array_map('trim', $_POST);
            $data = new ItemCatering();

            $data->setName($postData['name']);
            $data->setDescription($postData['description']);
            $data->setPrice($postData['price']);
            $data->setCategoryCateringId($postData['category_catering_id']);

           $itemsManager = new ItemCateringManager();
           $itemsManager->cateringAdd($data);

           header('Location: /admin/restauration');
           exit();
       }
        return $this->twig->render('Admin/addCatering.html.twig');
    }


    public function cateringDelete(int $id)
    {
        $cateringManager = new ItemCateringManager();
        $deleted = $cateringManager->delete($id);
        if ($deleted) {
            $get = '?deleted=true&id='. $id;
        }else {
            $get = '?deleted=false&id='. $id;
        }
        header('Location: /admin/restauration'. $get);
        exit();
    }
}

