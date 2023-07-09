<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;

class GetPostsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Post::factory(30)->create();
    }

    private function getRoute(): string
    {
        return '/api/posts';
    }

    public function test_api_respond_successfully()
    {
        $response = $this->get($this->getRoute());

        $response->assertStatus(JsonResponse::HTTP_OK);

        $response->assertStatus(JsonResponse::HTTP_OK)
            ->assertJsonStructure(
                [
                    [
                     'name',
                     'content',
                    ]
                ]
            );
    }

    public function test_api_respond_with_pagination()
    {
        $response = $this->get($this->getRoute().'?page=2');

        $response->assertStatus(JsonResponse::HTTP_OK)
            ->assertJsonStructure(
                [
                    [
                        'name',
                        'content',
                    ]
                ]
            );
    }

    public function test_api_respond_with_empty_data()
    {
        $response = $this->get($this->getRoute().'?page=3');

        $response->assertStatus(JsonResponse::HTTP_OK)
            ->assertJsonStructure([]);
        $this->assertDatabaseCount('posts', 30);
    }
}
