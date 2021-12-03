<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $fields = $request->validate([
            'name'=>'required|string',
            'email'=>'required|string|unique:users,email',
            'password'=>'required|string|confirmed'
        ]);
        $user = User::create([
            'name'=>$fields['name'],
            'email'=>$fields['email'],
            'password' =>bcrypt($fields['password'])
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;
        $response = [
            'user'=>$user,
            'token'=>$token
        ];

        return response($response,201);
    }
    public function logout(Request $request){
        auth()->user()->tokens()->delete(); 
        $response =  "Logget out";
        return response($response,200);
    }

    public function login(Request $request){
        $fields = $request->validate([
            'email'=>'required|string',
            'password'=>'required|string'
        ]);

        //check email
        $user =User::where('email',$fields['email'])->first();
        //check password
        if(!$user || !Hash::check($fields['password'],$user->password)){
            return response(
                ['messsage' => 'Bad creds'],401
            );
        }
       

        $token = $user->createToken('myapptoken')->plainTextToken;
        $response = [
            'user'=>$user,
            'token'=>$token
        ];

        return response($response,201);
    }
    public function update(Request $request){
        $fields = $request->validate([
            'email'=>'required|string|email',
            'password'=>'required|string|confirmed'
        ]);
        $user = User::find($fields['email']);
        $user->update($request->all());

        $response = [
            'user'=>$user
        ];

        return response($response,201);
    }

    public function show(){

        return response("Este mensaje solo se mostrara si ustes tiene un token, es ecir si esta logeado",200);
    }
}
