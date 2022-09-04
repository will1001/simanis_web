<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Models\BadanUsaha;
use App\Models\Notifikasi;
use Illuminate\Support\Str;



class PerdaganganController extends Controller
{
    function index($pages = "dashboard", $subPages = "")
    {
        if (Auth::check()) {
            if (Auth::user()->role === "ADMIN") {
                return redirect('/admin/tabel');
            }else if (Auth::user()->role === "BANK") {
                return redirect('/perbankan/dashboard');
            }else if (Auth::user()->role === "KOPERASI") {
                return redirect('/koperasi/daftarPengajuanDana');
            }else if (Auth::user()->role === "IKM") {
                return redirect('/member/dashboard');
            }else if (Auth::user()->role === "OJK") {
                return redirect('/ojk/dashboard');
            } else {
                if ($subPages != "") {
                    return view("pages.perdagangan.{$subPages}", ['BadanUsaha' => $BadanUsaha, 'userDataProgress' => $userDataProgress, 'pages' => $pages,'fields'=>$this->fields]);
                } else {
                    
                    // dd($BadanUsaha);
                    $params=[];
                    $Notifikasi = Notifikasi::where("user_role","PERDAGANGAN")->where("status","not read")->get();
                    
                    if($pages == "dashboard"){
                       
                    }

                    if($pages == "produkNTBMall"){
                       
                    }
                    
                    $params['Notifikasi']= $Notifikasi;
                    $params['pages']= $pages;
                    return view("pages.perdagangan.{$pages}",$params);
                }
            }
        } else {
            return redirect('/login');
        }
    }
}
