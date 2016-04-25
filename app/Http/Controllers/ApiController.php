<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function responseOk($data = null)
    {
        return response()->json($data, Response::HTTP_OK);
    }

    public function responseNotFound($message)
    {
        return response()->json([
          'error' => $message,
        ], Response::HTTP_NOT_FOUND);
    }


}
