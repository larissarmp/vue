<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->assertTrue(true);
    }

    public function testGroupIndex(Request $request){
        $response = $this->json('GET', '/api/v1/group');
        $response
            ->assertStatus(201);
    } 

}
