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
use Validation\CateringValidator;
use Validation\ItemCateringValidator;

class CateringController extends AbstractController
{
    /**
     * store errors in form
     * @var array
     */
    private $form_errors = [];

    /**
     * stores a notification string
     * @var string
     */
    private $notification = '';

    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
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

    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function adminCatering()
    {
        $itemCateringManager = new ItemCateringManager();
        $cateringItems = $itemCateringManager->selectAll();

        return $this->twig->render('Admin/catering.html.twig', [
            'cateringItems' => $cateringItems,
            'get' => $_GET,
        ]);
    }

    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function cateringAdd()
    {
        $formErrors = [];
       if(!empty($_POST)) {
            $postData = array_map('trim', $_POST);
            $validator = new CateringValidator($postData);
            if ($validator->isValid()) {
                $data = new ItemCatering();
                $data->setName($postData['name']);
                $data->setDescription($postData['description']);
                $data->setPrice($postData['price']);
                $data->setCategoryCateringId($postData['category_catering_id']);
                $itemsManager = new ItemCateringManager();
                $itemsManager->cateringAdd($data);
                header('Location: /admin/restauration');
                exit();
            } else {
                $this->notification = sprintf('Erreur lors de l\'ajout: %   d erreur(s) dans le formulaire', $validator->getErrors());
                $formErrors = $validator->getErrors();
            }
       }
        return $this->twig->render('Admin/addCatering.html.twig',[
            'formErrors' => $formErrors,
        ]);
    }

    /**
     * @param int $id
     */
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

