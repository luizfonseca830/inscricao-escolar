<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AddUserController extends Controller
{
    //
    public function store(Request $request){
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verified_at' => now(),
            'tipo' => $request->type,
        ]);
        session()->put('sucess', 'Usuário criado com sucesso!');
        return redirect()->route('user.index');
    }
}
