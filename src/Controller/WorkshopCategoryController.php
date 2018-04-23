<?php

namespace Controller;

use Model\Workshop\CategoryWorkshopManager;

class WorkshopCategoryController extends AbstractController
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
     * Controls workshop categories admin view
     * route: /admin/atelier/categories
     *
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function adminIndex()
    {
        $categoriesManager = new CategoryWorkshopManager();
        $categories = $categoriesManager->selectAll();
        return $this->twig->render('Admin/workshopCategory.html.twig', [
            'categories' => $categories,
            'catworkshopFormErrors' => $this->form_errors,
            'notification' => $this->notification
        ]);
    }

    /**
     * Admin add a new category
     * route: /admin/atelier/categories with POST
     *
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function adminAdd()
    {
        if (empty(trim($_POST['name']))) {
            $this->form_errors['name'] = [
                'value' => $_POST['name'],
                'error' => 'Le champ ne peut pas être vide'
            ];
        } else {
            $categoriesManager = new CategoryWorkshopManager();
            $categoriesManager->insert($_POST);
            $this->notification = 'Une nouvelle catégorie ajoutée.';
        }
        return $this->adminIndex();
    }
}
