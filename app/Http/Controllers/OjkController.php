<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Models\BadanUsaha;
use App\Models\Notifikasi;
use App\Models\PengajuanDana;
use App\Models\dataPendukung;
use App\Models\User;
use App\Models\Surat;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PengajuanDanaOJKExport;




class OjkController extends Controller
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

        $Notifikasi = Notifikasi::where("user_role","OJK")->where("nik",Auth::user()->nik)->where("status","not read")->get();
                
                if ($id != "") {
                    $BadanUsaha = BadanUsaha::find($id);
                }
                if ($subPages != "") {
                    $params=['BadanUsaha' => $BadanUsaha,  'pages' => $subPages,'fields'=>$this->fields,'Notifikasi' => $Notifikasi];
                    $params['User'] = Auth::user();

                    if($subPages == "dataTambahan"){
                        $BadanUsaha = BadanUsaha::where('id',$id)->first();

                        $dataPendukung = DataPendukung::where('id_badan_usaha',$id)->first();
                        // dd($BadanUsaha);
                        $user= User::where('nik',$BadanUsaha->nik)->first();

                        $params = [
                            'BadanUsaha' => $BadanUsaha,
                            'dataPendukung' => $dataPendukung,
                            'pages' => $subPages,
                            'Notifikasi' => $Notifikasi,
                            'User' => $user,
                        ];
                    }

                    if($subPages == "suratRekomendasi"){
                            
                        $BadanUsaha = BadanUsaha::where('id',$id)->get();
                        $user= User::where('nik',$BadanUsaha[0]->nik)->first();
                        $surat = Surat::find(1);

                        // dd($BadanUsaha);
                        $PengajuanDana = PengajuanDana::where('user_id',$user->id)->orderBy('created_at', 'desc')->first();
                        // dd($PengajuanDana);
                            $params = [
                                'BadanUsaha' => $BadanUsaha,
                                'PengajuanDana' => $PengajuanDana,
                                'pages' => $subPages,
                                'fields'=>$this->fields,
                                'Notifikasi' => $Notifikasi,
                                'Surat' => $surat,
                                'User' => $user,

                            ];
                        }
                        if($subPages == "downloadSurat"){
                            $BadanUsaha = BadanUsaha::where('id',$id)->get();
                            $user= User::where('nik',$BadanUsaha[0]->nik)->first();
                            $surat = Surat::find(1);
                            $PengajuanDana = PengajuanDana::where('user_id',$user->id)->where('status',"Diterima")->orderBy('created_at', 'desc')->first();
                            $params = [
                                'BadanUsaha' => $BadanUsaha,
                                'PengajuanDana' => $PengajuanDana,
                                'pages' => $subPages,
                                'fields'=>$this->fields,
                                'Notifikasi' => $Notifikasi,
                                'Surat' => $surat,
                            ];
                        }
                    return view("pages.ojk.{$subPages}", $params);
                } else {
                    // dd($BadanUsaha);
                    $params=['pages' => $pages];

                    if($pages == "dashboard"){
                        $PengajuanDana = PengajuanDana::leftJoin('users', 'pengajuan_dana.user_id', '=', 'users.id')
                        ->leftJoin('badan_usaha', 'users.nik', '=', 'badan_usaha.nik')
                        ->leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
                        ->select(
                            'badan_usaha.*',
                            'kabupaten.name as kabupaten',
                            'pengajuan_dana.id as dana_id',
                            'pengajuan_dana.jumlah_dana',
                            'pengajuan_dana.waktu_pinjaman',
                            'pengajuan_dana.status',
                            'pengajuan_dana.instansi',
                            'pengajuan_dana.jenis_pengajuan',
                            'pengajuan_dana.alasan',
                            'pengajuan_dana.user_id',
                            'pengajuan_dana.created_at as dana_created_at',
                            'pengajuan_dana.updated_at as dana_updated_at',
                            )
                        ->where("instansi","BANK")
                        // ->where("pengajuan_dana.status","Diterima")
                        // ->where("pengajuan_dana.alasan","Selamat Pembiayaan Usaha Anda diterima")
                        ->orderBy('created_at', 'desc')->get();
    
                        $params = [
                            'PengajuanDana' => $PengajuanDana,
                            'pages' => $pages,
                            'Notifikasi' => $Notifikasi,
                            'fields'=>$this->fields
                        ];
                    }

                    $params['Notifikasi']= $Notifikasi;
                    $params['pages']= $pages;
                    $params['User'] = Auth::user();

                    return view("pages.ojk.{$pages}", $params);
                }
            }
        } else {
            return redirect('/login');
        }
    }

    public function exportExcel()
    {
        return Excel::download(new PengajuanDanaOJKExport, 'Pembiayaan Usaha.xlsx');
    }
}
