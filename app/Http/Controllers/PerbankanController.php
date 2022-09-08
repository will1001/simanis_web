<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Models\BadanUsaha;
use App\Models\Notifikasi;
use App\Models\PengajuanDana;
use App\Models\JumlahPinjaman;
use App\Models\JangkaWaktu;
use App\Models\SimulasiAngsuran;
use App\Models\Instansi;
use Illuminate\Support\Str;



class PerbankanController extends Controller
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
    function index($pages = "dashboard", $subPages = "", $id = "")
    {
        $Notifikasi = Notifikasi::where("user_role","BANK")->where("nik",Auth::user()->nik)->where("status","not read")->get();

        if (Auth::check()) {
            if (Auth::user()->role === "ADMIN") {
                return redirect('/admin/tabel');
            }else if (Auth::user()->role === "PERDAGANGAN") {
                return redirect('/perdagangan/dashboard');
            }else if (Auth::user()->role === "KOPERASI") {
                return redirect('/koperasi/daftarPengajuanDana');
            }else if (Auth::user()->role === "IKM") {
                return redirect('/member/dashboard');
            }else if (Auth::user()->role === "OJK") {
                return redirect('/ojk/dashboard');
            } else {
                if ($id != "") {
                    
                    $BadanUsaha = BadanUsaha::find($id);
                }
                if ($subPages != "") {

                    return view("pages.perbankan.{$subPages}", ['BadanUsaha' => $BadanUsaha, 'pages' => $pages,'fields'=>$this->fields,'Notifikasi' => $Notifikasi]);
                } else {
                    $params=['pages' => $pages];

                    if($pages == "daftarPengajuanDana"){
                        $PengajuanDana = PengajuanDana::leftJoin('users', 'pengajuan_dana.user_id', '=', 'users.id')
                        ->leftJoin('badan_usaha', 'users.nik', '=', 'badan_usaha.nik')
                        ->leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
                        ->select(
                            'badan_usaha.*',
                            'kabupaten.name as kabupaten',
                            'pengajuan_dana.id as dana_id',
                            'pengajuan_dana.jumlah_dana',
                            'pengajuan_dana.status',
                            'pengajuan_dana.instansi',
                            'pengajuan_dana.jenis_pengajuan',
                            'pengajuan_dana.alasan',
                            'pengajuan_dana.user_id',
                            'pengajuan_dana.created_at as dana_created_at',
                            'pengajuan_dana.updated_at as dana_updated_at',
                            )
                        ->where("instansi","BANK")
                        ->where("pengajuan_dana.status","Diterima")
                        ->orderBy('created_at', 'desc')->get();
                        // dd($PengajuanDana);
                        $params = [
                            'PengajuanDana' => $PengajuanDana,
                            'pages' => $pages,
                            'Notifikasi' => $Notifikasi,
                            'fields'=>$this->fields
                        ];

                    }

                    if($pages == "simulasiAngsuran"){
                    $Simulasi = SimulasiAngsuran::leftJoin('list_jangka_waktu', 'simulasi_angsuran.id_jangka_waktu', '=', 'list_jangka_waktu.id')
                                ->leftJoin('list_jumlah_pinjaman', 'simulasi_angsuran.id_jml_pinjaman', '=', 'list_jumlah_pinjaman.id')
                                ->leftJoin('instansi', 'simulasi_angsuran.id_instansi', '=', 'instansi.id')
                                ->where("instansi.user_id",Auth::id())
                                ->orderByRaw('CONVERT(list_jangka_waktu.waktu, SIGNED) asc')
                                ->get();
                    $Instansi = Instansi::where("user_id",Auth::id())->first();


                        $JangkaWaktu = JangkaWaktu::where("id_instansi",$Instansi->id)->orderBy('waktu', 'ASC')->get();
                        $JumlahPinjaman = JumlahPinjaman::where("id_instansi",$Instansi->id)->orderByRaw('CONVERT(jumlah, SIGNED) asc')->get();
                        // dd($Simulasi);

                        $params = [
                            'pages' => $pages,
                            'Notifikasi' => $Notifikasi,
                            'Simulasi' => $Simulasi,
                            'JangkaWaktu' => $JangkaWaktu,
                            'JumlahPinjaman' => $JumlahPinjaman,
                        ];
                    }
                    return view("pages.perbankan.{$pages}", $params);
                }
            }
        } else {
            return redirect('/login');
        }
    }

    function tambahSimulasiAngsuran(Request $r)
    {
        $Instansi = Instansi::where("user_id",Auth::id())->first();
        $dana = JumlahPinjaman::where("id_instansi",$Instansi->id)->where("jumlah",$r->input("jumlah_dana"))->first();
        if(!$dana){
               $JumlahPinjaman = new JumlahPinjaman([
                    'id' => (string) Str::uuid(),
                    'id_instansi' => $Instansi->id,
                    'jumlah' => $r->input("jumlah_dana"),
                ]);
            
            $JumlahPinjaman->save();
        }
        $waktu = JangkaWaktu::where("id_instansi",$Instansi->id)->where("waktu",$r->input("jangka_waktu"))->first();
        if(!$waktu){
            $JangkaWaktu = new JangkaWaktu([
                 'id' => (string) Str::uuid(),
                 'id_instansi' => $Instansi->id,
                 'waktu' => $r->input("jangka_waktu"),
             ]);
         
         $JangkaWaktu->save();
        }
        $dana = JumlahPinjaman::where("id_instansi",$Instansi->id)->where("jumlah",$r->input("jumlah_dana"))->first();
        $waktu = JangkaWaktu::where("id_instansi",$Instansi->id)->where("waktu",$r->input("jangka_waktu"))->first();

            $simulasi = SimulasiAngsuran::where("id_jml_pinjaman",$dana->id)
            ->where("id_jangka_waktu",$waktu->id)
            ->first();
            if(!$simulasi){

                $SimulasiAngsuran = new SimulasiAngsuran([
                    'id' => (string) Str::uuid(),
                    'id_instansi' => $Instansi->id,
                    'id_jml_pinjaman' => $dana->id,
                    'id_jangka_waktu' => $waktu->id,
                    'angsuran' => $r->input("angsuran"),
                ]);
            
            $SimulasiAngsuran->save();
            }else{

                $simulasi->angsuran = $r->input("angsuran");
                $simulasi->save();
            }
            // dd($simulasi);
            // if($simulasi){

            // }

            // $notifikasi = new Notifikasi([
            //     'id' => (string) Str::uuid(),
            //     'nik' => $User->nik,
            //     'deskripsi' => "Pengajuan Dana Anda Diterima",
            //     'user_role' => "MEMBER",
            // ]);
            
            // $notifikasi->save();
            return redirect('/perbankan/simulasiAngsuran');
      
        // dd($waktu);
    }
}
