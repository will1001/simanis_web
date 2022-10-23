<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Models\BadanUsaha;
use App\Models\PengajuanDana;
use App\Models\Notifikasi;
use App\Models\JumlahPinjaman;
use App\Models\JangkaWaktu;
use App\Models\SimulasiAngsuran;
use App\Models\Instansi;
use App\Models\User;
use App\Models\Surat;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PengajuanDanaKoperasiExport;



class KoperasiController extends Controller
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
        $Notifikasi = Notifikasi::where("user_role","KOPERASI")->where("nik",Auth::user()->nik)->where("status","not read")->get();

        if (Auth::check()) {
            if (Auth::user()->role === "ADMIN") {
                return redirect('/admin/tabel');
            }else if (Auth::user()->role === "BANK") {
                return redirect('/perbankan/daftarPengajuanDana');
            }else if (Auth::user()->role === "PERDAGANGAN") {
                return redirect('/perdagangan/dashboard');
            }else if (Auth::user()->role === "IKM") {
                return redirect('/member/dashboard');
            }else if (Auth::user()->role === "OJK") {
                return redirect('/ojk/dashboard');
            } else {
                $Instansi = Instansi::where("user_id",Auth::id())->first();

                if ($id != "") {
                    // dd($id);
                    
                    $BadanUsaha = BadanUsaha::find($id);
                    // dd($BadanUsaha);
                }
                if ($subPages != "") {
                    $params= ['BadanUsaha' => $BadanUsaha,  'pages' => $subPages,'fields'=>$this->fields, 'Notifikasi' => $Notifikasi];
                    if($subPages == "ProfilBadanUsaha"){
                        $params = [
                            'BadanUsaha' => $BadanUsaha,
                            'pages' => $subPages,
                            'fields'=>$this->fields,
                            'Notifikasi' => $Notifikasi
                        ];
                    }
                    if($subPages == "suratRekomendasi"){
                        
                        $BadanUsaha = BadanUsaha::where('id',$id)->get();
                        $user= User::where('nik',$BadanUsaha[0]->nik)->first();
                        $surat = Surat::find(1);

                        // dd($user);
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
                    $params['Instansi'] = $Instansi;
                    $params['User'] = Auth::user();

                    return view("pages.koperasi.{$subPages}", $params);
                } else {
                    // dd($pages);
                    $params=[];

                    if($pages == "daftarPengajuanDana"){
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
                        ->where("instansi","KOPERASI")
                        ->where("pengajuan_dana.status","Menunggu")
                        ->orderBy('created_at', 'desc')->get();
    
                        $params = [
                            'PengajuanDana' => $PengajuanDana,
                        ];
                    }

                    $params['Notifikasi']= $Notifikasi;
                    $params['pages']= $pages;
                    $params['User'] = Auth::user();
                    $params['Instansi'] = Instansi::where("user_id",Auth::id())->first();

                    return view("pages.koperasi.{$pages}", $params);
                }
            }
        } else {
            return redirect('/login');
        }
    }

    public function gantiStatusPengajuanDana(Request $r,$id,$status)
    {
        $PengajuanDana = PengajuanDana::find($id);

        $User = User::find($PengajuanDana->user_id);

        $BadanUsaha = BadanUsaha::where('nik',$User->nik)->first();

        // dd($BadanUsaha);
        // dd($BadanUsaha);

        if($status == "Ditolak"){
            $PengajuanDana->alasan = $r->input('alasan');
        }else{
            if (!empty($r->file('pinjaman'))) {
                $file =$r->file('pinjaman');
                $extension = $file->getClientOriginalExtension(); 
                $filename = 'koperasi-pinjaman-'.$BadanUsaha->id.'.' . $extension;
    
                $file->move(public_path('pinjaman/'), $filename);
                // $data['foto']= 'images/'.$filename;
    
            }
            $PengajuanDana->alasan = "Selamat Pembiayaan Usaha Anda diterima Download file pada link untuk melihat detail pinjaman anda";
            $PengajuanDana->file_pinjaman = 'pinjaman/'.$filename; 
            $PengajuanDana->save();
    
        }

        $PengajuanDana->status = $status;
        
        $PengajuanDana->save();
        $instansi = User::find($PengajuanDana->id_instansi);
        // dd($instansi);
        if($status == "Diterima"){
            // $notifikasi = new Notifikasi([
            //     'id' => (string) Str::uuid(),
            //     'nik' => $instansi->nik,
            //     'deskripsi' => "Pembiayaan Usaha dari " . $BadanUsaha->nama_usaha,
            //     'user_role' => $PengajuanDana->instansi,
            // ]);
            
            // $notifikasi->save();

            $notifikasi = new Notifikasi([
                'id' => (string) Str::uuid(),
                'nik' => $User->nik,
                'deskripsi' => "Pembiayaan Usaha Anda Diterima",
                'user_role' => "MEMBER",
            ]);
            
            $notifikasi->save();
        }
        if($status == "Ditolak"){
            $notifikasi = new Notifikasi([
                'id' => (string) Str::uuid(),
                'nik' => $User->nik,
                'deskripsi' => "Pembiayaan Usaha Anda Ditolak",
                'user_role' => "MEMBER",
            ]);
            
            $notifikasi->save();
        }

      
        // dd($id);

        return redirect('/koperasi/daftarPengajuanDana');

    }

    public function exportExcel()
    {

        return Excel::download(new PengajuanDanaKoperasiExport, 'Pembiayaan Usaha.xlsx');
    }
}
