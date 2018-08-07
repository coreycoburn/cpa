<?php

namespace Tests\Unit;

use App\Event;
use App\Http\Controllers\Contract\Declined;
use App\Http\Controllers\Contract\ParseUrl;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CheckQuoteMiddleware extends TestCase
{
    use DatabaseMigrations;

    private $sign = 'aVZlWnQyMDdQZTg2VGxpM2pkV3BzYktVWFdHWmhVUThkNkRKZC9JcDdhZEFxZmRlOFQvUk1MN01mYnFXVmZTbmpXRVlFK3FUNmJ6UTdhRVJpdkorVDlTSGxWUXFrbFkrT0cyTWR4elpTZ1VuZkZHUHdYSjAzV0pqZkdpUHVLSXk2ZDEvYy9GTVdGdlZoY1QrV2hLT2FjRldaMzd4bzVvRmRvMWRMaTdUbHBYb2l0b0hoNzhGYTJBSlJDaGJNMGpEd2thMU9XV2N1RXVWMUdLSk84b2tKd0FBZFNkbUxUckltWW8rbGt1WXNRVT0=';

    /** @test */
    function sign_param_returns_valid_get_param_for_contract()
    {
        $response = $this->call('GET', '/contract/sign', ['sign' => $this->sign]);
        $parse = new ParseUrl();
        $data = $parse->get();

        $this->assertEquals(57977, $data['client']);
        $this->assertEquals(2, $data['proposal_id']);
        $this->assertNull($data['confirmation_id']);
        $this->assertEquals(14748, $data['contract_id']);
        $this->assertEquals(1570863600, $data['expires']);
        $this->assertEquals('90fd06c70ca1eb53d73b2241f02caa00', $data['signature']);
    }

    /** @test */
    function quote_has_not_been_declined()
    {
        $event = factory(Event::class)->create();

        $response = $this->call('GET', '/contract/sign', ['sign' => $this->sign]);

        $status = new Declined(new ParseUrl());

        $this->assertFalse($status->declined);
    }
}
