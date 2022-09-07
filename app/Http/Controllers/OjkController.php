<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Models\BadanUsaha;
use App\Models\Notifikasi;
use Illuminate\Support\Str;



class OjkController extends Controller
{
    function index($pages = "dashboard", $subPages = "", $id = "")
    {
        $Notifikasi = Notifikasi::where("user_role","OJK")->where("nik",Auth::user()->nik)->where("status","not read")->get();

        if (Auth::check()) {
            if (Auth::user()->role === "ADMIN") {
                return redirect('/admin/tabel');
            }else if (Auth::user()->role === "BANK") {
                return redirect('/perbankan/dashboard');
            }else if (Auth::user()->role === "KOPERASI") {
                return redirect('/koperasi/daftarPengajuanDana');
            }else if (Auth::user()->role === "IKM") {
                return redirect('/member/dashboard');
            }else if (Auth::user()->role === "PERDAGANGAN") {
                return redirect('/perdagangan/dashboard');
            } else {
                if ($id != "") {
                    $BadanUsaha = BadanUsaha::find($id);
                }
                if ($subPages != "") {
                    return view("pages.ojk.{$subPages}", ['BadanUsaha' => $BadanUsaha,  'pages' => $pages,'fields'=>$this->fields,'Notifikasi' => $Notifikasi]);
                } else {
                    // dd($BadanUsaha);
                    return view("pages.ojk.{$pages}", ['pages' => $pages]);
                }
            }
        } else {
            return redirect('/login');
        }
    }
}
