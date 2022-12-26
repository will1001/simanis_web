<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Models\BadanUsaha;
use App\Models\Kabupaten;
use App\Models\Notifikasi;
use App\Models\Produk;
use App\Models\KabupatenNTBMall;
use App\Models\KecamatanNTBMall;
use App\Models\KelurahanNTBMall;
use Illuminate\Support\Str;



class PerdaganganController extends Controller
{
    function index($pages = "dashboard", $subPages = "", $id = "")
    {
        $Notifikasi = Notifikasi::where("user_role", "PERDAGANGAN")->where("nik", Auth::user()->nik)->where("status", "not read")->get();

        if (Auth::check()) {
            if (Auth::user()->role === "ADMIN") {
                return redirect('/admin/tabel');
            } else if (Auth::user()->role === "BANK") {
                return redirect('/perbankan/dashboard');
            } else if (Auth::user()->role === "KOPERASI") {
                return redirect('/koperasi/daftarPengajuanDana');
            } else if (Auth::user()->role === "IKM") {
                return redirect('/member/dashboard');
            } else if (Auth::user()->role === "OJK") {
                return redirect('/ojk/dashboard');
            } else {
                if ($id != "") {
                    $BadanUsaha = BadanUsaha::find($id);
                }
                if ($subPages != "") {
                    $params = [
                        'pages' => $pages,
                        'Notifikasi' => $Notifikasi,
                        'User' => Auth::user()
                    ];



                    if ($subPages == "formTambahToko") {
                        $Kabupaten = Http::withHeaders([
                            'signature' => 'mns-1275151',
                        ])->get('https://absensinow.id/api/city');

                        // dd($Kabupaten['return']);

                        $Kabupaten2 = Http::get('https://jsonplaceholder.typicode.com/todos');
                        $params['Kabupaten'] = $Kabupaten;
                    }

                    return view("pages.perdagangan.{$subPages}", $params);
                } else {

                    // dd($BadanUsaha);
                    $params = [];

                    if ($pages == "dashboard") {
                        $Produk = Produk::leftJoin('badan_usaha', 'produk.id_badan_usaha', '=', 'badan_usaha.id')->get();
                        $params = ['Produk' => $Produk];
                        // dd($Produk);
                    }

                    if ($pages == "produkNTBMall") {
                    }
                    if ($pages == "daftarToko") {
                        $ListToko = [];
                        $params = ['ListToko' => $ListToko];
                    }

                    $params['User'] = Auth::user();

                    $params['Notifikasi'] = $Notifikasi;
                    $params['pages'] = $pages;
                    return view("pages.perdagangan.{$pages}", $params);
                }
            }
        } else {
            return redirect('/login');
        }
    }
    function updateDataLokasi()
    {

        $KabupatenNtbMall = Http::withHeaders([
            'signature' => 'mns-1275151',
        ])->get('https://absensinow.id/api/city');

        foreach ($KabupatenNtbMall['return'] as $key => $city) {
            $Kabupaten = new KabupatenNTBMall([
                'id' => $city['id'],
                "name" => $city['name'],
            ]);


            $Kabupaten->save();

            $KecamatanNtbMall = Http::withHeaders([
                'signature' => 'mns-1275151',
            ])->get('https://absensinow.id/api/district/' . $city['id']);
            foreach ($KecamatanNtbMall['return'] as $key => $district) {
                $Kecamatan = new KecamatanNTBMall([
                    'id' => $district['id'],
                    'id_kabupaten' => $city['id'],
                    "name" => $district['name'],
                ]);


                $Kecamatan->save();

                $KelurahanNtbMall = Http::withHeaders([
                    'signature' => 'mns-1275151',
                ])->get('https://absensinow.id/api/village/' . $district['id']);
                foreach ($KelurahanNtbMall['return'] as $key => $village) {
                    $Kelurahan = new KelurahanNTBMall([
                        'id' => $village['id'],
                        'id_kecamatan' => $district['id'],
                        "name" => $village['name'],
                        "postcode" => $village['postcode'],
                    ]);


                    $Kelurahan->save();
                }
            }
        }

        return "success";
    }
}
