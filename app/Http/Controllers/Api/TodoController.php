<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\TodoService;

class TodoController extends Controller
{
    /**
     * TodoService
     *
     * @var TodoService
     */
    protected $todoService;

    /**
     * result
     *
     * @var array
     */
    protected $result = [
        'status' => false,
        'message' => 'Error',
        'data' => null,
    ];

    /**
     * construct
     *
     * @param TodoService $todoService
     */
    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    /**
     * index
     *
     * @param Request $request
     */
    public function index(Request $request)
    {
        // all
        $todoDatas = $this->todoService->getTodos($request->user()->id);
        if (empty($todoDatas)) {
            $this->result['message'] = sprintf('Fail');
            return response()->json($this->result);
        }

        // success
        return $this->renderSuccessJson($todoDatas);
    }

    /**
     * store
     *
     * @param Request $request
     */
    public function store(Request $request)
    {
        // add
        $todoData = $this->todoService->addTodo($request->all(), $request->user()->id);
        if (empty($todoData)) {
            $this->result['message'] = sprintf('Fail');
            return response()->json($this->result);
        }

        // success
        return $this->renderSuccessJson($todoData);
    }

    /**
     * show
     *
     * @param mix $id
     * @param Request $request
     */
    public function show($id, Request $request)
    {
        // show
        $todoData = $this->todoService->getTodo((int)$id, $request->user()->id);
        if (empty($todoData)) {
            $this->result['message'] = sprintf('Fail');
            return response()->json($this->result);
        }

        // success
        return $this->renderSuccessJson($todoData);
    }

    /**
     * update
     *
     * @param mix $id
     * @param Request $request
     */
    public function update($id, Request $request)
    {
        // edit
        $todoData = $this->todoService->editTodo($request->all(), (int)$id, $request->user()->id);
        if (empty($todoData)) {
            $this->result['message'] = sprintf('Fail');
            return response()->json($this->result);
        }

        // success
        return $this->renderSuccessJson($todoData);
    }

    /**
     * destroy
     *
     * @param mix $id
     * @param Request $request
     */
    public function destroy($id, Request $request)
    {
        // del
        if (!$this->todoService->delTodo((int)$id, $request->user()->id)) {
            $this->result['message'] = sprintf('Fail');
            return response()->json($this->result);
        }

        // success
        return $this->renderSuccessJson();
    }

    /**
     * destroy all
     *
     * @param Request $request
     */
    public function destroyAll(Request $request)
    {
        // del all
        $this->todoService->delTodos($request->user()->id);

        // success
        return $this->renderSuccessJson();
    }

    /**
     * update token
     *
     * @param Request $request
     */
    public function updateToken(Request $request)
    {
        $user = $request->user();
        $user->updateApiToken();

        // success
        return $this->renderSuccessJson($user->api_token);
    }

    /**
     * render success JSON
     *
     * @param mix $data
     */
    protected function renderSuccessJson($data = null)
    {
        $this->result['status'] = true;
        $this->result['message'] = sprintf('Success');
        if (!empty($data)) {
            $this->result['data'] = $data;
        }
        return response()->json($this->result);
    }

}
