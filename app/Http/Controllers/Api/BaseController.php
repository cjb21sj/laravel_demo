<?php

namespace App\Http\Controllers\Api;

use App\Helper\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    use ApiResponse;

    //
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
}
