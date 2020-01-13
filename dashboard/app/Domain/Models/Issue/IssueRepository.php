<?php

namespace App\Domain\Models\Issue;

interface IssueRepository
{
    public function get();

    public function update($id, $status);
}