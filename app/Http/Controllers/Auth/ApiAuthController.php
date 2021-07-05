<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiAuthController extends Controller
{
    public function index()
    {
        dd('Landed in index');
    }

    public function login(Request $request)
    {
        // TODO: Login here
        dd($request->all());
    }

    public function register(Request $request)
    {
        // TODO: Register here
        dd($request->all());
    }
}
