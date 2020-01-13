<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Itigoppo\BacklogApi\Backlog\Backlog;
use Itigoppo\BacklogApi\Connector\ApiKeyConnector;

class DashboardController extends Controller
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
    public function index()
    {
        return view('dashboard');
    }

    public function getIssues()
    {
        
        $issues = $this->backlog->issues->load([]);

        return json_encode($issues);
    }

    public function update(Request $request)
    {
        if ($request->status === "open") {
            $status = 1;
        }

        if ($request->status === "wip") {
            $status = 2;
        };

        if ($request->status === "done") {
            $status = 3;
        };

        $response = $this->backlog->issues->update($request->taskId, [
            'statusId' => $status
        ]);
        
        return json_encode($response);
    }
}
