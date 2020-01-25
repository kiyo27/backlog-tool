<?php

namespace App\Infrastructures\Repositories;

use App\Infrastructures\Clients\BacklogClient;
use App\Domain\Models\Category\CategoryRepository;

class BacklogCategoryRepository implements CategoryRepository
{
    private $backlog;

    public function __construct()
    {
        $backlogInstance = new BacklogClient;
        $this->backlog = $backlogInstance->getInstance();
    }

    public function getCategories()
    {
        return $this->backlog->projects->categories('MOONSHOT');
    }
}