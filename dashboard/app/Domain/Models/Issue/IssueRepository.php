<?php

namespace App\Domain\Models\Issue;

interface IssueRepository
{
    public function getAllIssues();

    public function update($id, $status);
}