<?php

namespace Model\Workshop;

use Model\AbstractManager;

class CategoryWorkshopManager extends AbstractManager
{
    const TABLE = 'category_workshop';

    public function __construct()
    {
        parent::__construct(self::TABLE);
        $this->className = __NAMESPACE__ . '\\' . 'CategoryWorkshop';
    }
}
