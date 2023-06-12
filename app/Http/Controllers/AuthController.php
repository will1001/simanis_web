<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BadanUsaha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    function login(Request $r)
    {

        if ($r->isMethod('get')) {
            if (Auth::check()) {
                if (Auth::user()->role === "ADMIN") {
                    return redirect('/admin/tabel');
                } else if (Auth::user()->role === "BANK") {
                    return redirect('/perbankan/daftarPengajuanDana');
                } else if (Auth::user()->role === "KOPERASI") {
                    return redirect('/koperasi/daftarPengajuanDana');
                } else if (Auth::user()->role === "PERDAGANGAN") {
                    return redirect('/perdagangan/dashboard');
                } else if (Auth::user()->role === "OJK") {
                    return redirect('/ojk/dashboard');
                } else {
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
                    } else if ($user[0]->role === "BANK") {
                        return redirect('/perbankan/daftarPengajuanDana');
                    } else if ($user[0]->role === "KOPERASI") {
                        return redirect('/koperasi/daftarPengajuanDana');
                    } else if ($user[0]->role === "PERDAGANGAN") {
                        return redirect('/perdagangan/dashboard');
                    } else if ($user[0]->role === "OJK") {
                        return redirect('/ojk/dashboard');
                    } else {
                        if (Auth::user()->status == "Tidak Aktif") {
                            return view('pages.login', ['msg' => "Akun Anda Di Non Aktifkan"]);
                        }
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
                } else if (Auth::user()->role === "BANK") {
                    return redirect('/perbankan/daftarPengajuanDana');
                } else if (Auth::user()->role === "KOPERASI") {
                    return redirect('/koperasi/daftarPengajuanDana');
                } else if (Auth::user()->role === "PERDAGANGAN") {
                    return redirect('/perdagangan/dashboard');
                } else if (Auth::user()->role === "OJK") {
                    return redirect('/ojk/dashboard');
                } else {
                    return redirect('/member/dashboard');
                }
            } else {
                return view('pages.register');
            }
        } else {
            $nik = $r->input('nik');
            $password = $r->input('password');

            if (!$nik || !$password) {
                return view('pages.register', ['msg' => "Input NIK dan Password Terlebih dahulu"]);
            }

            $checkNIK = User::where('nik', $nik)->first();

            if ($checkNIK) {
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

    function changePassword(Request $r, $pages)
    {


        $validator = Validator::make($r->all(), [
            'password' => ['required', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/'],
        ]);

        if ($validator->fails()) {

            return redirect('/' . $pages . '/settingAkun')->with('failed', 'Password minimal 8 karakter, kombinasi huruf besar, huruf kecil, angka, dan
            karakter spesial');
        }
        $users = User::find($r->input("id"));
        // dd('/member'.$pages.'/settingAkun');

        if (Hash::check($r->input("password_lama"), $users->password)) {
            // dd("true");
            if ($pages === "member") {
                $BadanUsaha = BadanUsaha::where("nik", $users->nik)->first();
                $BadanUsaha->email =  $r->input("email");
                $BadanUsaha->save();
            }
            $users->password =  Hash::make($r->input("password"));

            $users->save();
            return redirect('/' . $pages . '/settingAkun')->with('success', 'Password Berhasil Dirubah');
        } else {
            // dd("pass salah");
            return redirect('/' . $pages . '/settingAkun')->with('failed', 'Password Lama Salah');
        }
    }
}
