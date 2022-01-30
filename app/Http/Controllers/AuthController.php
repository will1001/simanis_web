<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BadanUsaha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use function PHPUnit\Framework\isEmpty;

class AuthController extends Controller
{

    function login(Request $r)
    {
        if ($r->isMethod('get')) {
            return view('pages.login');
        } else {
            $nik = $r->input('nik');
            $password = $r->input('password');
            $user = User::where('nik', $nik)->get();
            if (!$user->isEmpty()) {
                if (Auth::attempt(['nik' => $nik, 'password' => $password])) {
                    if ($user[0]->isAdmin === 1) {
                        return redirect('/admin');
                    } else {
                        return redirect('/member');
                    }
                } else {
                    return view('pages.login', ['msg' => "Password Salah"]);
                }
            } else {
                return view('pages.login', ['msg' => "NIK Tidak Terdaftar"]);
            }
        }
    }



    function register(Request $r)
    {
        if ($r->isMethod('get')) {
            return view('pages.register');
        } else {
            $nik = $r->input('nik');
            $password = $r->input('password');

            $users = new User([
                'id' => (string) Str::uuid(),
                'nik' => $nik,
                'password' => Hash::make($password),
            ]);

            // BUAT USER
            $users->save();

            return view('pages.login');
        }
    }
}
