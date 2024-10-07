<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getMe(Request $request)
    {
        return response()->json([
            "user" => UserResource::make(Auth::user()),
        ]);
    }
}
