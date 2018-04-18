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
}
