<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Models\BadanUsaha;
use App\Models\PengajuanDana;
use App\Models\Notifikasi;
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
            }else if (Auth::user()->role === "PERDAGANGAN") {
                return redirect('/perdagangan/dashboard');
            }else if (Auth::user()->role === "IKM") {
                return redirect('/member/dashboard');
            }else if (Auth::user()->role === "OJK") {
                return redirect('/ojk/dashboard');
            } else {
                if ($subPages != "") {
                    return view("pages.koperasi.{$subPages}", ['BadanUsaha' => $BadanUsaha, 'userDataProgress' => $userDataProgress, 'pages' => $pages,'fields'=>$this->fields]);
                } else {
                    // dd($pages);
                    $params=[];
                    $Notifikasi = Notifikasi::where("user_role","KOPERASI")->where("status","not read")->get();

                    if($pages == "daftarPengajuanDana"){
                        $PengajuanDana = PengajuanDana::leftJoin('users', 'pengajuan_dana.user_id', '=', 'users.id')
                        ->leftJoin('badan_usaha', 'users.nik', '=', 'badan_usaha.nik')
                        ->leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
                        ->select('badan_usaha.nama_usaha','kabupaten.name as kabupaten','pengajuan_dana.*')
                        ->where("instansi","KOPERASI")
                        ->orderBy('created_at', 'desc')->get();
    
                        $params = [
                            'PengajuanDana' => $PengajuanDana,
                            'pages' => $pages,
                            'Notifikasi' => $Notifikasi
                        ];
                    }
                    return view("pages.koperasi.{$pages}", $params);
                }
            }
        } else {
            return redirect('/login');
        }
    }
}
