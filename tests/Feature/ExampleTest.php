<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testTheApplicationReturnsASuccessfulResponse()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testStore()
    {
        $urlData = [
            'name' => 'http://test.by',
            'created_at' => Carbon::now()->toString()
        ];

        $newUrlId = DB::table('urls')->insertGetId($urlData);

        $testHtml = file_get_contents(__DIR__ . '../../Fixtures/test.html');

        if ($testHtml === false) {
            throw new \Exception("Cannot get content from fixture");
        }

        Http::fake([$urlData['name'] => Http::response($testHtml, 200)]);

        $expectedData = [
            'url_id' => $newUrlId,
            'status_code' => 200,
            'h1' => 'test_header',
            'title' => 'Анализатор страниц',
            'description' => 'test_description'
        ];

        $response = $this->post(route('checks', $newUrlId));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('url_checks', $expectedData);
    }
}
