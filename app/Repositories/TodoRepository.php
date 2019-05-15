<?php
namespace App\Repositories;

use App\Models\Todo;
use Illuminate\Database\Eloquent\Collection;

class TodoRepository
{
    /**
     * Todo
     *
     * @var Todo
     */
    private $todo;

    /**
     * construct
     *
     * @param Todo $todo
     */
    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }

    /**
     * create
     *
     * @param array $data
     * @return Todo
     */
    public function create(array $data = [])
    {
        if (empty($data)) {
            return null;
        }
        return $this->todo->create($data);
    }

    /**
     * update
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data)
    {
        return $this->todo->find($id)->update($data);
    }

    /**
     * get by id
     *
     * @param int $id
     * @return Todo
     */
    public function getById(int $id)
    {
        return $this->todo->find($id);
    }

    /**
     * get by user id
     *
     * @param int $id
     * @return Collection
     */
    public function getByUserId(int $userId)
    {
        return $this->todo->where('user_id', $userId)->get();
    }

    /**
     * delete by id
     *
     * @param int $id
     * @return
     */
    public function deleteById(int $id)
    {
        return $this->todo->find($id)->delete();
    }

    /**
     * delete by user id
     *
     * @param int $userId
     * @return
     */
    public function deleteByUserId(int $userId)
    {
        return $this->todo->where('user_id', $userId)->delete();
    }
}
