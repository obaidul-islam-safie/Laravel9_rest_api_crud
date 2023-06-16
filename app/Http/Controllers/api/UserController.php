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
            'email' => 'required|unique:users,email|email',
            'password' => 'required|min:6',
        ]);

        if($validation->fails()){
            return response()->json(['errors' => $validation->errors(),'status' => false],422);
        }

        $input['password'] = bcrypt($input['password']);
        User::create($input);
        return response()->json(['message' => 'User Created successfully.','status'=>true],200);
    }

    public function getData(){
        $data = User::all();
        // $data = User::paginate(1);
        // $data = User::simplePaginate(1);
        return response()->json(['data'=> $data,'status'=>true],200);
    }

    public function findUser($id){
        $data = User::find($id);
        return response()->json(['data'=> $data,'status'=>true],200);
    }


    public function update($id,Request $request){
        $input = $request->all();

        $validation = Validator::make($input,[
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'required|min:6',
        ]);

        if($validation->fails()){
            return response()->json(['errors' => $validation->errors(),'status' => false],422);
        }

        $input['password'] = bcrypt($input['password']);
        User::where('id',$id)->update($input);
        return response()->json(['message' => 'User Update successfully.','status'=>true],200);
    }


    public function delete($id){
        User::where('id',$id)->delete();
        return response()->json(['message' => 'User Delete successfully.','status'=>true],200);
    }
}
