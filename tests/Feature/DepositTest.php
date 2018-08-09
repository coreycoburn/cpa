<?php

namespace Tests\Feature;

use App\Event;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DepositTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function an_event_has_a_deposit_due()
    {
        $event = factory(Event::class)->make();

        $this->assertEquals(88000, $event->deposit_due);
    }

    /** @test */
    function can_get_deposit_due_in_dollars()
    {
        $event = factory(Event::class)->make([
            'deposit_due' => 55000
        ]);

        $this->assertEquals('550', $event->deposit_due_in_dollars);
    }

    /** @test */
    function can_view_payments_for_an_event()
    {
        $event = factory(Event::class)->create();
        $payments = $event->payments();

        dd($payments);
    }
}
