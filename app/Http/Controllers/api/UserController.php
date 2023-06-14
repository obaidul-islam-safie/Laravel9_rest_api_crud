<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

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
            return response()->json(['errors' => $validation->errors()]);
        }

        // $input['password']= bcrypt($input['password']);
        // User::create($input);
        // return response()->json(['message' => 'User Created successfully.','status'=>true],200);
    }
}
