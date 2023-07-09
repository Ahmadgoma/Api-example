<?php


namespace App\Services;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Repositories\PostRepositoryInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PostService implements PostServiceInterface
{
    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;

    /**
     * PostService constructor.
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct
    (
        PostRepositoryInterface $postRepository
    )
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function getAllPaginated(): AnonymousResourceCollection
    {
        $posts = $this->postRepository->paginate();

        return PostResource::collection($posts);
    }

    /**
     * @param int $postId
     * @return PostResource
     */
    public function getPost(int $postId): PostResource
    {
        return new PostResource($this->postRepository->find($postId));
    }

    /**
     * @param PostRequest $request
     * @return Post
     */
    public function create(PostRequest $request): Post
    {
        return $this->postRepository->create
        (
            [
                'name' => $request['name'],
                'content' => $request['content'],
            ]
        );
    }

    /**
     * @param int $postId
     * @param PostRequest $request
     * @return bool
     */
    public function update(int $postId, PostRequest $request): bool
    {
       return $this->postRepository->update(
            $postId,
            [
                'content' => $request['content'],
                'name' => $request['name']
            ]
        );
    }


    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->postRepository->delete($id, ['id' => $id]);
    }
}
