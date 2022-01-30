<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    function login(Request $r)
    {
        if ($r->isMethod('get')) {
            if (Auth::check()) {
                if (Auth::user()->isAdmin === 1) {
                    return redirect('/admin');
                } else {
                    return redirect('/member')->with('user', Auth::user());
                }
            } else {
                return view('pages.login');
            }
        } else {
            $nik = $r->input('nik');
            $user = User::where('nik', $nik)->get();
            if (!$user->isEmpty()) {
                $credentials = $r->only('nik', 'password');
                if (Auth::attempt($credentials)) {
                    $r->session()->regenerate();

                    if ($user[0]->isAdmin === 1) {
                        return redirect()->intended('admin');
                    } else {
                        return redirect()->intended('member');
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
            if (Auth::check()) {
                if (Auth::user()->isAdmin === 1) {
                    return redirect('/admin');
                } else {
                    return redirect('/member')->with('user', Auth::user());;
                }
            } else {
                return view('pages.register');
            }
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

            return view('pages.login', ['msg' => "Pendaftaran Berhasil Silahkan Login"]);
        }
    }

    function logout(Request $r)
    {
        Session::flush();
        Auth::logout();

        $r->session()->invalidate();

        $r->session()->regenerateToken();

        return redirect('/');
    }
}
