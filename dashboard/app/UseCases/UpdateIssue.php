<?php

namespace App\UseCases;

use App\Domain\Models\Issue\IssueStatus;
use App\Infrastructures\Clients\BacklogClient;

class UpdateIssue
{
    private $client;

    public function __construct(BacklogClient $client)
    {
        $this->client = $client;
    }

    public function __invoke($id, $status)
    {
        $statusObject = new IssueStatus($status);
        $issueStatus = $statusObject->value();

        return $this->client->update($id, $issueStatus);
    }
}