<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
Use App\Http\Requests\AuthRequest;

class AuthController extends Controller
{
    public function showlogin(){
        return view('login');
    }
    public function login(AuthRequest $request)
    {
        $author = $request->only('email','password');
        if(Auth::attempt($author)){
            return redirect()->route('admin');
        }
        return back()->withErrors(['email'=>'認証に失敗しました'])->withInput();
    }
    //
}
