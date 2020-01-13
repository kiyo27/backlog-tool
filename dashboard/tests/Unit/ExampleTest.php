<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Itigoppo\BacklogApi\Backlog\Backlog;
use Itigoppo\BacklogApi\Connector\ApiKeyConnector;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $backlog = new Backlog(new ApiKeyConnector(
            config('backlog.project_key'),
            config('backlog.api_key'),
            config('backlog.domain')
        ));
        $info = $backlog->space->info();
        $this->assertJson($info);
    }
}
