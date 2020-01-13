<?php

namespace App\Domain\Models\Issue;

use InvalidArgumentException;

class IssueStatus
{
    private $value;

    public function __construct(string $status)
    {
        if ($status === "open") {
            $this->value = 1;
        }

        if ($status === "wip") {
            $this->value = 2;
        };

        if ($status === "done") {
            $this->value = 3;
        };

        if (is_null($this->value)) {
            throw new InvalidArgumentException('status is invalid.');
        }
    }

    public function value()
    {
        return $this->value;
    }
}