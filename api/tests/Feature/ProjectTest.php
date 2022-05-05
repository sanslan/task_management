<?php

namespace Tests\Feature;

use App\Http\Middleware\Authenticate;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp():void
    {
        parent::setUp();

        $this->withoutMiddleware([Authenticate::class]);

        $this->artisan('migrate');
        $this->artisan('db:seed');
    }

    public function tearDown():void
    {
        $this->artisan('migrate:reset');
    }


    public function test_can_get_list_of_projects()
    {

        $response = $this->get('api/v1/projects');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'code',
                'data'
            ]);
        $this->assertGreaterThan(0,count($response->decodeResponseJson()['data']));
    }

    public function test_can_get_a_project()
    {

        $response = $this->get('api/v1/projects/1');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'code',
                'data'
            ]);
        $this->assertArrayHasKey('title',$response->decodeResponseJson()['data']);
    }

    public function test_can_create_a_project()
    {
        $project = [
            "title" => "project1",
            "description" => "project1 description",
            "status" =>"active",
            "duration" => "2 days"
        ];
        $response = $this->post('api/v1/projects', $project);

        $this->assertSame('project1', $response->decodeResponseJson()['data']['title']);
    }

    public function test_can_update_a_project()
    {
        $project = [
            "title" => "project1",
            "description" => "project1 description",
            "status" =>"active",
            "duration" => "2 days"
        ];
        $response = $this->put('api/v1/projects/1', $project);

        $this->assertSame('project1', $response->decodeResponseJson()['data']['title']);
    }

    public function test_can_delete_a_project()
    {

        $this->delete('api/v1/projects/1');
        $response = $this->get('api/v1/projects/1');

        $this->assertEmpty($response->decodeResponseJson()['data']);
    }

    public function test_all_fields_is_required()
    {
        $project = [];
        $response = $this->post('api/v1/projects', $project);
        $this->assertContains('The title field is required.', $response->decodeResponseJson()['validation_errors']);
        $this->assertContains('The description field is required.', $response->decodeResponseJson()['validation_errors']);
        $this->assertContains('The status field is required.', $response->decodeResponseJson()['validation_errors']);
        $this->assertContains('The duration field is required.', $response->decodeResponseJson()['validation_errors']);
    }
}
