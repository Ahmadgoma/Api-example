<?php


namespace App\Repositories;


use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface PostRepositoryInterface
{
    /**
     * @return LengthAwarePaginator
     */
    public function paginate(): LengthAwarePaginator;

    /**
     * @param int $id
     * @return Post
     */
    public function find(int $id): Post;

    /**
     * @param array $data
     * @return Post
     */
    public function create(array $data): Post;

    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function Update(int $id, array $data): bool;

    /**
     * @param int $id
     * @param array $conditions
     * @return bool
     */
    public function delete(int $id, array $conditions): bool;
}
