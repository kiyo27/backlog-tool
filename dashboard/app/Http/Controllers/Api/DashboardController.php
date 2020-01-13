<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\UseCases\GetIssues;
use App\UseCases\UpdateIssue;
use Illuminate\Http\Request;

class DashboardController extends Controller
{    
    public function index()
    {
        return view('dashboard');
    }

    public function getIssues(GetIssues $useCase)
    {
        
        // $issues = $this->backlog->get();

        $issues = $useCase();
        
        return json_encode($issues);

    }

    public function update(Request $request, UpdateIssue $useCase)
    {
        $result = $useCase($request->taskId, $request->status);

        return json_encode($result);
    }
}
