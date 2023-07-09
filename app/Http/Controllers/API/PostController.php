<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Services\PostServiceInterface;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    use ApiResponseTrait;

    /**
     * @var PostServiceInterface
     */
    private $postService;

    /**
     * PostController constructor.
     * @param PostServiceInterface $postService
     */
    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }

    public function index(): JsonResponse
    {
        $posts = $this->postService->getAllPaginated();

        return $this->apiResponse($posts);
    }

    public function store(PostRequest $request): JsonResponse
    {
        $post = $this->postService->create($request);

        return $this->apiResponse($post, JsonResponse::HTTP_CREATED);
    }

    public function show(int $id): JsonResponse
    {
        $post = $this->postService->getPost($id);

        return $this->apiResponse($post);
    }

    public function update(PostRequest $request, int $id): JsonResponse
    {
        $this->postService->update($id, $request);
        return $this->apiResponse('Post has been updated successfully');
    }

    public function destroy(int $id): JsonResponse
    {
        $isDeleted = $this->postService->delete($id);
        if ($isDeleted)
            return $this->apiResponse('Post has been deleted successfully');
        return $this->apiResponseError('Error in deleting post.', JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }
}
