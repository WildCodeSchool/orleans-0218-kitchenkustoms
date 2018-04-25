<?php

namespace Controller;

use Model\Workshop\CategoryWorkshopManager;
use Model\Workshop\ItemWorkshop;
use Model\Workshop\ItemWorkshopManager;
use Validation\ItemWorkshopValidator;

class WorkshopController extends AbstractController
{

    /**
     * stores errors in form
     * @var array
     */
    private $form_errors = [];

    /**
     * stores a notification string
     * @var string
     */
    private $notification = '';

    /**
     * Controls workshop public view
     * route: /atelier
     *
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function index()
    {
        $itemsManager = new ItemWorkshopManager();
        $itemsGroupByCategories = $itemsManager->selectAllGroupByCategories();

        return $this->twig->render(
            'Home/workshop.html.twig',
            ['itemsGroupByCategories' => $itemsGroupByCategories]
        );
    }

    /**
     * Controls workshop admin view
     * route: /admin/atelier
     *
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function adminIndex()
    {
        $itemsManager = new ItemWorkshopManager();
        $items = $itemsManager->selectAllWithCategories();
        $categoriesManager = new CategoryWorkshopManager();
        $categories = $categoriesManager->selectAll();

        $errors = $this->form_errors;
        $this->form_errors = [];

        return $this->twig->render(
            'Admin/workshop.html.twig',
            [
                'items' => $items,
                'categories' => $categories,
                'itemworkshopFormErrors' => $errors,
                'notification' => $this->notification
            ]
        );
    }

    /**
     * Admin add a new item
     * route: /admin/atelier with POST
     *
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function adminAdd()
    {
        $postData = array_map('trim', $_POST);

        $validator = new ItemWorkshopValidator($postData);

        if ($validator->isValid()) {
            $itemsManager = new ItemWorkshopManager();
            $itemsManager->insert($postData);
            $this->notification = 'Un nouvel item ajouté.';
        } else {
            $this->notification = sprintf('Erreur lors de l\'ajout: %d erreur(s) dans le formulaire', $validator->nbErrors());
            $this->form_errors = $validator->getErrors();
        }

        return $this->adminIndex();
    }


    public function adminUpdate($id)
    {
        $itemsManager = new ItemWorkshopManager();
        $formerrors = [];

        if (!empty($_POST)) {
            $postData = array_map('trim', $_POST);
            $validator = new ItemWorkshopValidator($postData);
            if ($validator->isValid()) {
                $item = new ItemWorkshop();
                $item->hydrate($postData);
                $itemsManager->updateItem($item);
                header('Location: /admin/atelier');
                exit();
            } else {
                $formerrors = $validator->getErrors();
            }
        }
        $item = $itemsManager->selectOneById($id);
        $categoriesManager = new CategoryWorkshopManager();
        $categories = $categoriesManager->selectAll();

        return $this->twig->render('Admin/updateItemWorkshop.html.twig', compact('item', 'categories', 'formerrors'));
    }
}
