<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Infrastructures\Repositories\BacklogCategoryRepository;
use App\UseCases\GetIssues;
use App\UseCases\UpdateIssue;
use Illuminate\Http\Request;

class DashboardController extends Controller
{    
    public function index()
    {
        return view('dashboard');
    }

    public function getIssues(GetIssues $useCase, Request $request)
    {
        $issues = $useCase($request);
        
        return json_encode($issues);
    }

    public function update(Request $request, UpdateIssue $useCase)
    {
        $result = $useCase($request->taskId, $request->status);

        return json_encode($result);
    }

    public function getCategories()
    {
        $repository = new BacklogCategoryRepository;
        $result = $repository->getCategories();
        return json_encode($result);
    }
}
