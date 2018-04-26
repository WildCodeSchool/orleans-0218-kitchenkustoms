<?php

namespace Controller;

use Model\Workshop\CategoryWorkshop;
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
     * Controls workshop categories update
     * route: /admin/atelier/categories/{id}
     *
     * @param $id
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function adminUpdate($id)
    {
        $formError = false;
        $categoriesManager = new CategoryWorkshopManager();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $postName = isset($_POST['name']) ? trim($_POST['name']) : '';

            $validator = new CategoryWorkshopValidator(['name' => $postName]);
            if (!$validator->isValid()) {
                $formError = $validator->getErrors();
            } else {
                $category = new CategoryWorkshop();
                $category->setId($id);
                $category->setName($postName);
                $categoriesManager->updateCategory($category);
                header('Location: /admin/atelier/categories');
                exit();
            }
        }
        $category = $categoriesManager->selectOneById($id);

        return $this->twig->render(
            'Admin/updateCategoryWorkshop.html.twig',
            compact('category', 'formError')
        );
    }
}
