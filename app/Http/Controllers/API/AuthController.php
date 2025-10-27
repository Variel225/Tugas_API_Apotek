<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
     public function register(Request $request){
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'password_confirmation' => 'required|same:password'
        ]);

        //encrypt password (bcrypt)
        $validate['password'] = bcrypt($request->password);

        //simpan data user ke tabel users
        $user = User::create($validate);
        if($user){
            $data['succes'] = true;
            $data['message'] = "User Berhasil disimpan";
            $data['data'] = $user->name; //nama user
            $data['token'] = $user->createToken('MDPApp')->plainTextToken;
            return response()->json($data, Response::HTTP_CREATED);
        } else {
            $data['succes'] = false;
            $data['message'] = "User gagal Berhasil disimpan";
            return response()->json($data, Response::HTTP_BAD_REQUEST);
        }
    }

    public function login(Request $request){
         if(Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
         ])) {
            $user = Auth::user();
            $data['succes'] = true;
            $data['message'] = "Login Berhasil";
            $data['data'] = $user;
            return response()->json($data, Response::HTTP_OK);
         } else {
            $data['succes'] = false;
            $data['message'] = "Email atau password Salah";
            return response()->json($data, Response::HTTP_NOT_FOUND);
         }
    }

}
