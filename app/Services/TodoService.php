<?php
namespace App\Services;

use App\Models\User;
use App\Repositories\TodoRepository;

class TodoService
{
    /**
     * TodoRepository
     *
     * @var TodoRepository
     */
    protected $todoRepository;

    /**
     * construct
     *
     * @param TodoRepository $todoRepository
     */
    public function __construct(TodoRepository $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    /**
     * get todos
     *
     * @param int $todoId
     * @return array
     */
    public function getTodos(int $userId)
    {
        $todos = $this->todoRepository->getByUserId($userId);
        if ($todos->isEmpty()) {
            return [];
        }
        return $todos->toArray();
    }

    /**
     * get todo
     *
     * @param int $todoId
     * @param int $userId
     * @return array
     */
    public function getTodo(int $todoId, int $userId)
    {
        $todo = $this->todoRepository->getById($todoId);

        // check user id
        if (null === $todo || $userId !== $todo->user_id) {
            return [];
        }
        return $todo->toArray();
    }

    /**
     * add todo
     *
     * @param array $postData
     * @param int $userId
     * @return array
     */
    public function addTodo(array $postData, int $userId)
    {
        $todoData = $postData;
        $todoData['user_id'] = $userId;
        $todo = $this->todoRepository->create($todoData);
        return null === $todo ? [] : $todo->toArray();
    }

    /**
     * edit todo
     *
     * @param array $postData
     * @param int $todoId
     * @param int $userId
     * @return array
     */
    public function editTodo(array $postData, int $todoId , int $userId)
    {
        // check todo exist
        $todoData = $this->getTodo($todoId, $userId);
        if (empty($todoData)) {
            return [];
        }
        if (!$this->todoRepository->update($todoId, $postData)) {
            return [];
        }
        return $this->getTodo($todoId, $userId);
    }

    /**
     * del todo by id
     *
     * @param int $id
     * @return boolean
     */
    public function delTodo(int $todoId, int $userId)
    {
        // check todo exist
        $todoData = $this->getTodo($todoId, $userId);
        if (empty($todoData)) {
            return false;
        }
        return $this->todoRepository->deleteById($todoId);
    }

    /**
     * del todo by user id
     *
     * @param int $id
     * @return boolean
     */
    public function delTodos(int $userId)
    {
        return $this->todoRepository->deleteByUserId($userId);
    }
}
