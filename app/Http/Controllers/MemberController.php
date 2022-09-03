<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Models\BadanUsaha;
use App\Models\PengajuanDana;
use App\Models\Kabupaten;
use App\Models\CabangIndustri;
use App\Models\Produk;
use App\Models\Notifikasi;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\SubCabangIndustri;
use App\Models\Kbli;


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
                return redirect('/koperasi/daftarPengajuanDana');
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
                    $params = ['BadanUsaha' => $BadanUsaha, 'userDataProgress' => $userDataProgress, 'pages' => $pages,'fields'=>$this->fields];
                    
                    if($pages == "kartu"){
                    $kabupaten = Kabupaten::find($BadanUsaha[0]->id_kabupaten);
                    $CabangIndustri = CabangIndustri::where('name',$BadanUsaha[0]->cabang_industri)->first();
                    $BadanUsaha[0]->kabupaten = $kabupaten ? $kabupaten->name : null;
                    $BadanUsaha[0]->id_cabang_industri = $CabangIndustri ? $CabangIndustri->id : null;

                        $params = ['BadanUsaha' => $BadanUsaha[0],'User' => Auth::user()];
                    }

                    if($pages == "PengajuanDana"){
                    $PengajuanDana = PengajuanDana::where('user_id',Auth::id())->orderBy('created_at', 'desc')->get();
                    $BadanUsaha = BadanUsaha::where('nik',Auth::user()->nik)->first();
                    // dd($BadanUsaha);


                        $params = ['PengajuanDana' => $PengajuanDana,'BadanUsaha' => $BadanUsaha];
                    }
                    if($pages == "produk"){
                        
                    $BadanUsaha = BadanUsaha::where('nik',Auth::user()->nik)->first();
                    $Produk = Produk::where('id_badan_usaha',$BadanUsaha->id)->get();

                        $params = ['Produk' => $Produk];
                    }
                    if($pages == "settingBadanUsaha"){
                        
                    $BadanUsaha = BadanUsaha::where('nik',Auth::user()->nik)->first();

                        $params = [
                            'badan_usaha' => $BadanUsaha,
                            'Kabupaten' => Kabupaten::all(),
                            'Kecamatan' => Kecamatan::all(),
                            'Kelurahan' => Kelurahan::all(),
                            'CabangIndustri' => CabangIndustri::all(),
                            'SubCabangIndustri' => SubCabangIndustri::all(),
                            'Kbli' => Kbli::all(),
                        ];
                    }
                    return view("pages.member.{$pages}", $params);
                }
            }
        } else {
            return redirect('/login');
        }
    }
    function ajukan_dana(Request $r){
        $pengajuanDana = new PengajuanDana([
            'id' => (string) Str::uuid(),
            'user_id' => Auth::id(),
            'status' => "Menunggu",
            'jumlah_dana' => $r->input("jumlah_dana"),
            'alasan' => $r->input("alasan"),
            'instansi' => $r->input("instansi"),
            'jenis_pengajuan' => $r->input("jenis_pengajuan"),
        ]);

        $BadanUsaha = BadanUsaha::where('nik',Auth::user()->nik)->first();
       

        $notifikasi = new Notifikasi([
            'id' => (string) Str::uuid(),
            'deskripsi' => "Pengajuan Dana dari " . $BadanUsaha->nama_usaha,
            'user_role' => "ADMIN",
        ]);

        // dd($pengajuanDana);

        // BUAT USER
        // dd($BadanUsaha->nama_usaha);

        $notifikasi->save();
        $pengajuanDana->save();
        return redirect('/member/PengajuanDana');
        // $PengajuanDana = PengajuanDana::where('user_id',Auth::id())->get();

        // return view('pages.member.PengajuanDana', ['PengajuanDana' => $PengajuanDana,'msg' => "Dana Telah di ajukan , menunggu verifiaksi admin"]);
    }
    function ajukan_produk(Request $r){
        $sertifikat_halal = 
        (object)array(
            "tahun" => $r->input("sertifikat_halal_thn"),
            "nomor" => $r->input("sertifikat_halal_no"),
        );
        $sertifikat_haki = 
        (object)array(
            "tahun" => $r->input("sertifikat_haki_thn"),
            "nomor" => $r->input("sertifikat_haki_no"),
        );
        $sertifikat_sni = 
        (object)array(
            "tahun" => $r->input("sertifikat_sni_thn"),
            "nomor" => $r->input("sertifikat_sni_no"),
        );
        $BadanUsaha = BadanUsaha::where('nik',Auth::user()->nik)->first();
        $cek_sertifikat_halal = str_contains(json_encode($sertifikat_halal),"null");
        $cek_sertifikat_haki = str_contains(json_encode($sertifikat_haki),"null");
        $cek_sertifikat_sni = str_contains(json_encode($sertifikat_sni),"null");
        
        $data= array(
            'id' => (string) Str::uuid(),
            'id_badan_usaha' => $BadanUsaha->id,
            'sertifikat_halal' => $cek_sertifikat_halal? null : json_encode($sertifikat_halal),
            'sertifikat_haki' => $cek_sertifikat_haki? null : json_encode($sertifikat_haki),
            'sertifikat_sni' => $cek_sertifikat_sni? null : json_encode($sertifikat_sni),
            'nama' => $r->input("nama"),
            'deskripsi' => $r->input("deskripsi"),
            'foto' => "foto",
        );


        $produk = new Produk($data);

        // BUAT produk
        $produk->save();
        return redirect('/member/produk');

        // $BadanUsaha = BadanUsaha::where('nik',Auth::user()->nik)->first();
        // $Produk = Produk::where('id_badan_usaha',$BadanUsaha->id)->get();

        // return view('pages.member.produk', ['Produk' => $Produk,'msg' => "produk Telah di atambahakan"]);
    }
}
