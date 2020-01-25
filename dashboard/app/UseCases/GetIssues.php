<?php

namespace App\UseCases;

use App\Domain\Models\Issue\IssueRepository;
use App\Infrastructures\Clients\BacklogClient;

class GetIssues
{
    private $issueRepo;

    public function __construct(BacklogClient $repo)
    {
        $this->issueRepo = $repo;
    }

    public function __invoke($request)
    {
        return $this->issueRepo->getAllIssues();
    }
}