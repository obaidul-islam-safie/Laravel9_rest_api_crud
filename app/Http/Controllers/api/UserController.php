<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{
    public function store(Request $request){
        $input = $request->all();

        $validation = Validator::make($input,[
            'name' => 'required',
            'email' => 'required|unique:user,email|email',
            'password' => 'required|min:6',
        ]);

        if($validation->fails()){

        }
    }
}
