<?php

namespace Controller;

use Model\Workshop\ItemWorkshopManager;

class WorkshopController extends AbstractController
{
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

        return $this->twig->render(
            'Admin/workshop.html.twig',
            ['items' => $items]
        );
    }
}
