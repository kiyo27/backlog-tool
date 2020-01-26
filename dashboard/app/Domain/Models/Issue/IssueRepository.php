<?php

namespace App\Domain\Models\Issue;

interface IssueRepository
{
    public function getIssues();

    public function update($id, $status);
}