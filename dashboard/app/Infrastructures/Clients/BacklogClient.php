<?php

namespace App\Infrastructures\Clients;

use App\Domain\Models\Issue\IssueRepository;
use Itigoppo\BacklogApi\Backlog\Backlog;
use Itigoppo\BacklogApi\Connector\ApiKeyConnector;

class BacklogClient implements IssueRepository
{
    private $backlog;

    public function __construct()
    {
        $this->backlog = new Backlog(new ApiKeyConnector(
            config('backlog.project_key'),
            config('backlog.api_key'),
            config('backlog.domain')
        ));
    }

    public function getAllIssues()
    {
        // $parameter = [
        //     'statusId' => [ 1 ]
        // ];
        return $this->backlog->issues->load([]);
    }

    public function update($id, $status)
    {
        $response = $this->backlog->issues->update($id, [
            'statusId' => $status
        ]);

        return $response;
    }

}