<?php

namespace Tests\Feature;

use App\Event;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SignContract extends TestCase
{
    // use DatabaseMigrations;

    /** @test */
    // function user_can_view_a_contract()
    // {
    //     $this->withoutExceptionHandling();
    //     $event = factory(Event::class)->make();

    //     $response = $this->get('/contract/sign', ['sign' => 'aVZlWnQyMDdQZTg2VGxpM2pkV3BzYktVWFdHWmhVUThkNkRKZC9JcDdhZEFxZmRlOFQvUk1MN01mYnFXVmZTbmpXRVlFK3FUNmJ6UTdhRVJpdkorVDlTSGxWUXFrbFkrT0cyTWR4elpTZ1VuZkZHUHdYSjAzV0pqZkdpUHVLSXk2ZDEvYy9GTVdGdlZoY1QrV2hLT2FjRldaMzd4bzVvRmRvMWRMaTdUbHBYb2l0b0hoNzhGYTJBSlJDaGJNMGpEd2thMU9XV2N1RXVWMUdLSk84b2tKd0FBZFNkbUxUckltWW8rbGt1WXNRVT0=']);

    //     $response->assertStatus(200);
    // }

    /** @test */
    function return_forbidden_with_invalid_param()
    {
        $response = $this->get('/contract/sign', ['sign' => 'aVZlWnQyMDdQZ']);
        $response->assertStatus(403);
    }

    /** @test */
    function return_forbidden_when_quote_declined()
    {
        $response = $this->get('/contract/sign', ['sign' => 'aVZlWnQyMDdQZTg2VGxpM2pkV3BzYktVWFdHWmhVUThkNkRKZC9JcDdhY1FITEVEN2ZhYW9KNWZIM1Yvd2lxelRFYXBhL1FLNnhxMlYwQWZ1RUd5R0syL2xWOHJNeUluZEpCTEVWeURYOURyNkwxcmtOSXlzV2NnOWtHSnFhejBFY0FlYjlWQ0krZXBSa0psZ3B2c2FxTy9xbnVOT3l1TWYyNSsrYTlBQ21Cb1ZKNjdFbldaU0N4MWgzblJVYjRxbTEyeTlpbzEyM0hCWWZBdmRjQzFwaGR0aHJGMU9TZWMzT3UrdTZ3ckdzWT0=']);

        $response->assertStatus(403);
    }
}
