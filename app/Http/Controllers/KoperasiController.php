<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Models\BadanUsaha;
use Illuminate\Support\Str;



class KoperasiController extends Controller
{
    function index($pages = "dashboard", $subPages = "")
    {
        if (Auth::check()) {
            if (Auth::user()->role === "ADMIN") {
                return redirect('/admin/tabel');
            }else if (Auth::user()->role === "BANK") {
                return redirect('/perbankan/dashboard');
            }else if (Auth::user()->role === "KOPERASI") {
                return redirect('/koperasi/dashboard');
            }else if (Auth::user()->role === "IKM") {
                return redirect('/member/dashboard');
            }else if (Auth::user()->role === "OJK") {
                return redirect('/ojk/dashboard');
            } else {
                if ($subPages != "") {
                    return view("pages.koperasi.{$subPages}", ['BadanUsaha' => $BadanUsaha, 'userDataProgress' => $userDataProgress, 'pages' => $pages,'fields'=>$this->fields]);
                } else {
                    // dd($pages);
                    return view("pages.koperasi.{$pages}", ['pages' => $pages]);
                }
            }
        } else {
            return redirect('/login');
        }
    }
}
