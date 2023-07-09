<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;

class CreatePostTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    private function getRoute(): string
    {
        return '/api/posts';
    }

    public function test_api_respond_successfully()
    {
        $data = [
            'name' => 'Test Post',
            'content' => 'This is a test post'
        ];

        $response = $this->post($this->getRoute(), $data);
        $response->assertStatus(JsonResponse::HTTP_CREATED);
        $response->assertJsonStructure(
            [
                'id',
                'name',
                'content',
                'created_at',
                'updated_at'
            ]
        );
    }

    public function test_api_post_created_successfully()
    {
        $data = [
            'name' => 'Test Post',
            'content' => 'This is a test post'
        ];
        $response = $this->post($this->getRoute(), $data);

        $response->assertStatus(JsonResponse::HTTP_CREATED);
        $this->assertDatabaseHas('posts', $data);
    }

    public function test_api_respond_required_name()
    {
        $data = [
            'content' => 'This is a test post'
        ];
        $response = $this->post($this->getRoute(), $data);

        $response->assertStatus(JsonResponse::HTTP_OK);
        $response->assertJsonFragment(
            [
                "error" => "The name field is required."
            ]
        );
    }
}
