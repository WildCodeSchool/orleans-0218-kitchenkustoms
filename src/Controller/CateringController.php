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
        ]);
    }

    public function cateringAdd()
    {
       if(!empty($_POST)) {
           $postData = array_map('trim', $_POST);
           $validator = new ItemCateringValidator($postData);

           if ($validator->isValid()) {
                $data = new ItemCatering();
                $data->setName($postData['name']);
                $data->setDescription($postData['description']);
                $data->setPrice($postData['price']);
                $data->setCategoryCateringId($postData['category_catering_id']);


               $itemsManager = new ItemCateringManager();
               $itemsManager->cateringAdd($data);
               $this->notification = 'Un nouvel item ajouté.';

           }
       }
        return $this->twig->render('Admin/addCatering.html.twig');
    }

}