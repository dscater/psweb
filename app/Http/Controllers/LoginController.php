<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $res = Auth::attempt(["name" => $request->name, "password" => $request->password, "status" => 1]);

        if ($res) {
            return redirect()->route("home");
        }

        return redirect()->back()->withErrors([
            "name" => "El usuario o contraseña son incorrectos"
        ]);
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route("inicio_app");
    }
}
