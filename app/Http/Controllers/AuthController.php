<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BadanUsaha;
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
                if (Auth::user()->role === "ADMIN") {
                    return redirect('/admin/tabel');
                }else if (Auth::user()->role === "BANK") {
                    return redirect('/perbankan/daftarPengajuanDana');
                }else if (Auth::user()->role === "KOPERASI") {
                    return redirect('/koperasi/daftarPengajuanDana');
                }else if (Auth::user()->role === "PERDAGANGAN") {
                    return redirect('/perdagangan/dashboard');
                }else if (Auth::user()->role === "OJK") {
                    return redirect('/ojk/dashboard');
                }  else {
                    return redirect('/member/dashboard');
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

                    if ($user[0]->role === "ADMIN") {
                        return redirect()->intended('/admin/tabel');
                    }else if ($user[0]->role === "BANK") {
                        return redirect('/perbankan/daftarPengajuanDana');
                    }else if ($user[0]->role === "KOPERASI") {
                        return redirect('/koperasi/daftarPengajuanDana');
                    }else if ($user[0]->role === "PERDAGANGAN") {
                        return redirect('/perdagangan/dashboard');
                    }else if ($user[0]->role === "OJK") {
                        return redirect('/ojk/dashboard');
                    } else {
                        return redirect()->intended('/member/dashboard');
                    }
                } else {
                    return view('pages.login', ['msg' => "Password Salah"]);
                }
            } else {
                return view('pages.login', ['msg' => "NIK Tidak Terdaftar, Silahkan Klik Daftar Terlebih Dahulu"]);
            }
        }
    }



    function register(Request $r)
    {
        if ($r->isMethod('get')) {
            if (Auth::check()) {
                if (Auth::user()->role === "ADMIN") {
                    return redirect('/admin/tabel');
                }else if (Auth::user()->role === "BANK") {
                    return redirect('/perbankan/daftarPengajuanDana');
                }else if (Auth::user()->role === "KOPERASI") {
                    return redirect('/koperasi/daftarPengajuanDana');
                }else if (Auth::user()->role === "PERDAGANGAN") {
                    return redirect('/perdagangan/dashboard');
                }else if (Auth::user()->role === "OJK") {
                    return redirect('/ojk/dashboard');
                }  else {
                    return redirect('/member/dashboard');
                }
            } else {
                return view('pages.register');
            }
        } else {
            $nik = $r->input('nik');
            $password = $r->input('password');

            if(!$nik || !$password){
                return view('pages.register', ['msg' => "Input NIK dan Password Terlebih dahulu"]);
            }

            $checkNIK = User::where('nik', $nik)->first();

            if($checkNIK){
                return view('pages.register', ['msg' => "NIK sudah terdaftar di Sistem"]);
            }


            $users = new User([
                'id' => (string) Str::uuid()->getHex(),
                'nik' => $nik,
                'password' => Hash::make($password),
            ]);

            $NewBadanUsaha = new BadanUsaha;
            $NewBadanUsaha->id = (string) Str::uuid();
            $NewBadanUsaha->nik = $nik;
            $NewBadanUsaha->nama_direktur = $r->input('nama_direktur');
            $NewBadanUsaha->no_hp = $r->input('no_hp');

             // BUAT BADAN USAHA
            $NewBadanUsaha->save();

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
