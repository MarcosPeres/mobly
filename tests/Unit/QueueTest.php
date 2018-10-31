<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Events\OrderShipped;
use App\Events\OrderFailedToShip;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class QueueTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function testQueueFiles()
    {
        Queue::fake();

        // Do some things to set up date, call an endpoint, etc.

        Queue::assertPushed(ProcessXLS::class, function ($job) {
            return $job->data['action'] === 'deleteAllFiles';
        });
    }
}
