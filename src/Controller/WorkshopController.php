<?php

namespace Controller;

use Model\Workshop\CategoryWorkshopManager;
use Model\Workshop\ItemWorkshopManager;

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
                'notification'=>$this->notification
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
        $errors = ItemWorkshopManager::checkErrors($_POST);

        $nbErrors = array_reduce($errors, function ($nb, $error) {
            return $nb + ($error['error'] !== false);
        }, 0);

        if ($nbErrors === 0) {
            $itemsManager = new ItemWorkshopManager();
            $itemsManager->insert($_POST);
            $this->notification = '1 nouvel item ajouté.';
        } else {
            $this->notification = sprintf('Erreur lors de l\'ajout: %d erreur(s) dans le formulaire', $nbErrors);
            $this->form_errors = $errors;
        }
        return $this->adminIndex();
    }
}
