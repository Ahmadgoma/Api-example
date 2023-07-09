<?php


namespace App\Services;


use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface PostServiceInterface
{
    /**
     * @return AnonymousResourceCollection
     */
    public function getAllPaginated(): AnonymousResourceCollection;

    /**
     * @param int $postId
     * @return PostResource
     */
    public function getPost(int $postId): PostResource;

    /**
     * @param PostRequest $request
     * @return Post
     */
    public function create(PostRequest $request): Post;

    /**
     * @param int $postId
     * @param PostRequest $request
     * @return bool
     */
    public function update(int $postId, PostRequest $request): bool;

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}
