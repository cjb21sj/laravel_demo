<?php

namespace App\Http\Controllers\Api;

use App\Services\User\UserServiceInterface;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    public function __construct(Request $request, UserServiceInterface $userService)
    {
        $this->userService = $userService;

        parent::__construct($request);
    }

    /**
     * @return mixed
     */
    public function index() {

        $page = $this->request->get('page') ?? 1;
        $pageSize = $this->request->get('page_size') ?? 4;

        return $this->message($this->userService->getList($page, $pageSize));
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function show(int $id) {
event("");
        return $this->message($this->userService->getInfo($id));
    }

    public function test() {
        return $this->message($this->userService->test());
    }
}
