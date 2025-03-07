<?php

namespace App\Http\Controllers;

use App\Models\User;
Use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register');
    
    }
    //
    public function store(AuthRequest $request)
    {
        User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=>Hash::make($request->password)

        ]
        );
        return redirect('/login')->with('success','ユーザー登録が完了しました');
    }
}
