<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;

class DeletePostTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Post::factory(1)->create();
    }

    private function getRoute(): string
    {
        return '/api/posts/1';
    }

    public function test_api_respond_successfully()
    {
        $response = $this->delete($this->getRoute());
        $response->assertStatus(JsonResponse::HTTP_OK);
        $response->assertJsonFragment(
            [
                'Post has been deleted successfully'
            ]
        );
    }

    public function test_api_post_deleted_successfully()
    {
        $this->assertDatabaseCount('posts', 1);
        $response = $this->delete($this->getRoute());
        $response->assertStatus(JsonResponse::HTTP_OK);
        $this->assertDatabaseCount('posts', 0);
    }
}
