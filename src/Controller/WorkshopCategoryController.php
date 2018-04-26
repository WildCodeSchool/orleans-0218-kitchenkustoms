<?php

namespace Controller;

use Model\Workshop\CategoryWorkshopManager;
use Validation\CategoryWorkshopValidator;

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
        $postData = array_map('trim', $_POST);

        $validator = new CategoryWorkshopValidator($postData);

        if (!$validator->isValid()) {
            $this->form_errors = $validator->getErrors();
        } else {
            $categoriesManager = new CategoryWorkshopManager();
            $categoriesManager->insert($postData);
            $this->notification = 'Une nouvelle catégorie ajoutée.';
        }

        return $this->adminIndex();
    }

    /**
     * @param int $id
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function adminDelete(int $id)
    {
        $categoryWorkshopManager = new CategoryWorkshopManager();

        $existElementCategory = $categoryWorkshopManager->selectElementsByCategoryId($id);

        if (!empty($existElementCategory)) {
            $this->form_errors['delete'] = 'Veuillez supprimer les éléments de la catégorie avant de la supprimer.';
        } else {
            $deleted = $categoryWorkshopManager->delete($id);

            if (!$deleted) {
                $this->form_errors['delete'] = 'Categorie inexistante, suppression impossible.';
            }
        }

        return $this->adminIndex();
    }
}
