<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class UserTest extends TestCase
{
    private int $id;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->id = DB::table('urls')->insertGetId([
            'name' => 'http://' . strtolower(Str::random(10)) . ".ru",
            'created_at' => Carbon::now()
        ]);
    }

    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testUrls()
    {
        $response = $this->get('/urls');

        $response->assertStatus(200);
    }


    public function testStore()
    {
        $data = ['url' => ['name' => 'https://test.com']];
        $response = $this->post(route('start'), $data);
        $response->assertSessionHasNoErrors();
        //$response->assertRedirect();

        $this->assertDatabaseHas('urls', $data['url']);
    }

    public function testShow()
    {
        $response = $this->get(route('urls', ['id' =>$this->id]));
        $response->assertOk();
    }
}
