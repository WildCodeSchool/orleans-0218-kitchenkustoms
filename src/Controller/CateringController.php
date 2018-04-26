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
            'get' => $_GET,
        ]);
    }

    public function adminCateringUpdate($id)
    {
        $itemsManager = new ItemCateringManager();
        $item = $itemsManager->selectOneById($id);

        if (!empty($_POST)) {
            $item->setId($_POST['id']);
            $item->setName($_POST['name']);
            $item->setPrice($_POST['price']);
            $item->setDescription($_POST['description']);
            $item->setCategoryCateringId($_POST['category_catering_id']);
            $itemsManager->updateItemCatering($item);
            header('Location: /admin/restauration');

            exit();

        }

        return $this->twig->render('Admin/updateItemCatering.html.twig',
            ['item' => $item,
            ]);
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
