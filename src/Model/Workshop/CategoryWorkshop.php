<?php

namespace Model\Workshop;

class CategoryWorkshop
{
    /**
     * @param int $id
     * @return null|string
     */
    public function delete(int $id): ?string
    {
        $categoryWorkshopManager = new CategoryWorkshopManager();

        $existElementCategory = $categoryWorkshopManager->selectElementsByCategoryId($id);

        if (!empty($existElementCategory)) {
            return 'Veuillez supprimer les éléments de la catégorie avant de la supprimer.';
        } else {
            $deleted = $categoryWorkshopManager->delete($id);

            if (!$deleted) {
                return 'Categorie inexistante, suppression impossible.';
            }
        }
        return null;
    }

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
