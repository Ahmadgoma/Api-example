<?php


namespace App\Repositories;


use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PostRepository implements PostRepositoryInterface
{
    /**
     * @var Post
     */
    private $model;

    /**
     * PostRepository constructor.
     * @param Post $model
     */
    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function paginate(): LengthAwarePaginator
    {
        return $this->model
            ->select
            (
                'posts.id',
                'posts.name',
                'posts.content',
                'posts.created_at',
                'posts.updated_at',
            )
            ->paginate();
    }

    /**
     * @param array $data
     * @return Post
     */
    public function create(array $data): Post
    {
        return $this->model->create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        $post = $this->find($id);

        $post->fill($data);

        if (!$post->isClean()) {
            $post->save();
            return true;
        }
        return false;
    }


    /**
     * @param int $id
     * @return Post
     */
    public function find(int $id): Post
    {
        $post = $this->model->find($id);

        if (!$post) {
            throw new ModelNotFoundException
            ('There is no post.');
        }

        return $post;
    }

    /**
     * @param int $id
     * @param array $conditions
     * @return bool
     */
    public function delete(int $id, array $conditions): bool
    {
        return $this->model->where($conditions)->delete($id);
    }
}
