<?php

namespace Tests\Feature;

use App\Event;
use App\Http\Controllers\Contract\Deposit\Deposits;
use App\Payment;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PaymentsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function payments_can_be_added()
    {
        $event = factory(Event::class)->make();
        $event->payments()->create(['amount' => 2000]);
        $event->payments()->create(['amount' => 3000]);

        $this->assertEquals('5000', $event->payments()->sum('amount'));
    }

    /** @test */
    function payment_can_be_viewed_in_dollars()
    {
        $event = factory(Event::class)->make();
        $event->payments()->create(['amount' => 2000]);
        $payment = $event->payments()->first();

        $this->assertEquals('20.00', $payment->payment_made_in_dollars);
    }

    /** @test */
    function a_client_still_owes_a_deposit()
    {
        $event = factory(Event::class)->make();
        $event->payments()->create(['amount' => 10000]);

        $deposits = new Deposits($event);

        $this->assertEquals('780.00', $deposits->due_in_dollars());
    }
}
