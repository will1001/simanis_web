<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Models\BadanUsaha;
use Illuminate\Support\Str;



class MemberController extends Controller
{
    private $fields = [
        'id',
        'nik',
        'nama_direktur',
        'id_kabupaten',
        'kecamatan',
        'kelurahan',
        'alamat_lengkap',
        'no_hp',
        'nama_usaha',
        'bentuk_usaha',
        'tahun_berdiri',
        'formal_informal',
        'nib_tahun',
        'nomor_sertifikat_halal_tahun',
        'sertifikat_merek_tahun',
        'nomor_test_report_tahun',
        'sni_tahun',
        'jenis_usaha',
        'cabang_industri',
        'sub_cabang_industri',
        'id_kbli',
        'investasi_modal',
        'jumlah_tenaga_kerja_pria',
        'jumlah_tenaga_kerja_wanita',
        'kapasitas_produksi_perbulan',
        'satuan_produksi',
        'nilai_produksi_perbulan',
        'nilai_bahan_baku_perbulan',
        'lat',
        'lng',
        'media_sosial',
        'foto_alat_produksi',
        'foto_ruang_produksi',
        // 'created_at',
        // 'updated_at'
    ];
    //
    function index($pages = "dashboard", $subPages = "", $id = "")
    {
        if (Auth::check()) {
            if (Auth::user()->role === "ADMIN") {
                return redirect('/admin/tabel');
            }else if (Auth::user()->role === "BANK") {
                return redirect('/perbankan/dashboard');
            }else if (Auth::user()->role === "KOPERASI") {
                return redirect('/koperasi/dashboard');
            }else if (Auth::user()->role === "PERDAGANGAN") {
                return redirect('/perdagangan/dashboard');
            }else if (Auth::user()->role === "OJK") {
                return redirect('/ojk/dashboard');
            } else {
                // dd(Auth::user()->nik);
                $BadanUsaha = BadanUsaha::where('nik', Auth::user()->nik)->get();
                $userDataProgress = array();
                // dd(count($this->fields));
                // dd(!$BadanUsaha->first());
                // dd(empty($BadanUsaha));
                if(!$BadanUsaha->first()){
                    $NewBadanUsaha = new BadanUsaha;
                    $NewBadanUsaha->id = (string) Str::uuid();
                    $NewBadanUsaha->nik = Auth::user()->nik;

                     // BUAT BADAN USAHA
                        $NewBadanUsaha->save();

                }
                $BadanUsaha = BadanUsaha::where('nik', Auth::user()->nik)->get();

                foreach ($BadanUsaha as $key => &$item) {
                    $userDataProgress[$key] = 0;
                    $totalnull = 0;
                    foreach ($this->fields as &$field) {

                        if (!isset($item->{$field})) {
                            $totalnull += 1;
                        }
                    }
                    $userDataProgress[$key] = ((count($this->fields)-$totalnull) / count($this->fields)) * 100;
                }

                if ($id != "") {
                    
                    $BadanUsaha = BadanUsaha::find($id);
                }
                if ($subPages != "") {

                    return view("pages.member.{$subPages}", ['BadanUsaha' => $BadanUsaha, 'userDataProgress' => $userDataProgress, 'pages' => $pages,'fields'=>$this->fields]);
                } else {
                    // dd($BadanUsaha);
                    return view("pages.member.{$pages}", ['BadanUsaha' => $BadanUsaha, 'userDataProgress' => $userDataProgress, 'pages' => $pages,'fields'=>$this->fields]);
                }
            }
        } else {
            return redirect('/login');
        }
    }
}
