<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\BadanUsaha;
use App\Models\SlideShow;
use App\Models\Survei;
use App\Models\User;
use App\Models\PengajuanDana;
use App\Models\Notifikasi;
use App\Imports\BadanUsahaImport;
use App\Exports\BadanUsahaExport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class AdminController extends Controller
{
    private $fields = [
        'badan_usaha.id',
        'badan_usaha.nik',
        'badan_usaha.nama_direktur',
        'kabupaten.name as kabupaten',
        'badan_usaha.kecamatan',
        'badan_usaha.kelurahan',
        'badan_usaha.alamat_lengkap',
        'badan_usaha.no_hp',
        'badan_usaha.nama_usaha',
        'badan_usaha.bentuk_usaha',
        'badan_usaha.tahun_berdiri',
        'legalitas_usaha.name as formal_informal',
        'badan_usaha.nib_tahun',
        'badan_usaha.nomor_sertifikat_halal_tahun',
        'badan_usaha.sertifikat_merek_tahun',
        'badan_usaha.nomor_test_report_tahun',
        'badan_usaha.sni_tahun',
        'badan_usaha.jenis_usaha',
        'cabang_industri.name as cabang_industri',
        'sub_cabang_industri.name as sub_cabang_industri',
        'badan_usaha.investasi_modal',
        'badan_usaha.jumlah_tenaga_kerja_pria',
        'badan_usaha.jumlah_tenaga_kerja_wanita',
        'badan_usaha.kapasitas_produksi_perbulan',
        'badan_usaha.satuan_produksi',
        'badan_usaha.nilai_produksi_perbulan',
        'badan_usaha.nilai_bahan_baku_perbulan',
        'badan_usaha.created_at',
        'badan_usaha.updated_at'
    ];

    private $orWhere = [
        'badan_usaha.nama_direktur',
        'badan_usaha.kecamatan',
        'badan_usaha.kelurahan',
        'badan_usaha.alamat_lengkap',
        'badan_usaha.no_hp',
        'badan_usaha.nama_usaha',
        'badan_usaha.bentuk_usaha',
        'badan_usaha.tahun_berdiri',
        'badan_usaha.formal_informal',
        'badan_usaha.nib_tahun',
        'badan_usaha.nomor_sertifikat_halal_tahun',
        'badan_usaha.sertifikat_merek_tahun',
        'badan_usaha.nomor_test_report_tahun',
        'badan_usaha.sni_tahun',
        'badan_usaha.jenis_usaha',
        'badan_usaha.cabang_industri',
        'badan_usaha.sub_cabang_industri',
        'badan_usaha.investasi_modal',
        'badan_usaha.jumlah_tenaga_kerja_pria',
        'badan_usaha.jumlah_tenaga_kerja_wanita',
        'badan_usaha.kapasitas_produksi_perbulan',
        'badan_usaha.satuan_produksi',
        'badan_usaha.nilai_produksi_perbulan',
        'badan_usaha.nilai_bahan_baku_perbulan',
    ];
    public function index($pages)
    {
        if (Auth::check()) {

            if (Auth::user()->role === "PERDAGANGAN") {
                return redirect('/perdagangan/dashboard');
            }else if (Auth::user()->role === "BANK") {
                return redirect('/perbankan/daftarPengajuanDana');
            }else if (Auth::user()->role === "KOPERASI") {
                return redirect('/koperasi/daftarPengajuanDana');
            }else if (Auth::user()->role === "IKM") {
                return redirect('/member/dashboard');
            }else if (Auth::user()->role === "OJK") {
                return redirect('/ojk/dashboard');
            }else{
                $params;
                $Notifikasi = Notifikasi::where("user_role","ADMIN")->where("status","not read")->get();

                if($pages == "tabel"){
                    $BadanUsaha = BadanUsaha::leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
                    ->leftJoin('cabang_industri', 'badan_usaha.cabang_industri', '=', 'cabang_industri.id')
                    ->leftJoin('sub_cabang_industri', 'badan_usaha.sub_cabang_industri', '=', 'sub_cabang_industri.id')
                    ->leftJoin('legalitas_usaha', 'badan_usaha.formal_informal', '=', 'legalitas_usaha.id')
                    ->paginate(100, $this->fields);
                    $params = [
                        'BadanUsaha' => $BadanUsaha,
                        'SlideShow' => SlideShow::all(),
                        'Survei' => Survei::all(),
                        'keyword' => "",
                        'pages' => $pages,
                        'Notifikasi' => $Notifikasi

                    ];
                }
                if($pages == "daftarAkun"){
                    $User = User::all();
                    $params = [
                        'pages' => $pages,
                        'User' => $User,
                        'Notifikasi' => $Notifikasi

                    ];
                }
                if($pages == "daftarPengajuanDana"){
                    $PengajuanDana = PengajuanDana::leftJoin('users', 'pengajuan_dana.user_id', '=', 'users.id')
                    ->leftJoin('badan_usaha', 'users.nik', '=', 'badan_usaha.nik')
                    ->leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
                    ->select('badan_usaha.nama_usaha','kabupaten.name as kabupaten','pengajuan_dana.*')->orderBy('created_at', 'desc')->get();
                    // dd($PengajuanDana);

                    $params = [
                        'PengajuanDana' => $PengajuanDana,
                        'pages' => $pages,
                        'Notifikasi' => $Notifikasi
                    ];
                }

                
               
                // dd($params);
                return view(
                    "pages.admin.{$pages}",
                    $params
                );
            }
           
        } else {
            return redirect('/login');
        }
    }


    public function searchBadanUsaha(Request $request)
    {
        $keyword = $request->input('keyword');

        $BadanUsaha = BadanUsaha::leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
            ->leftJoin('cabang_industri', 'badan_usaha.cabang_industri', '=', 'cabang_industri.id')
            ->leftJoin('sub_cabang_industri', 'badan_usaha.sub_cabang_industri', '=', 'sub_cabang_industri.id')
            ->leftJoin('legalitas_usaha', 'badan_usaha.formal_informal', '=', 'legalitas_usaha.id')
            ->where('badan_usaha.nik', 'LIKE', "%{$keyword}%");


        foreach ($this->orWhere as &$field) {
            $BadanUsaha = $BadanUsaha->orWhere($field, 'LIKE', "%{$keyword}%");
        }

        $BadanUsaha = $BadanUsaha->paginate(100, $this->fields);

        return view('pages.admin.tabel', ['BadanUsaha' => $BadanUsaha, 'keyword' => $keyword, 'pages' => 'tabel']);
    }

    public function deleteAllBadanUsaha()
    {

        BadanUsaha::truncate();

        return redirect('/admin/tabel');
    }

    public function importExcel(Request $request)
    {



        Excel::import(new BadanUsahaImport, request()->file('file'));
        return back();
    }

    public function exportExcel()
    {

        return Excel::download(new BadanUsahaExport, 'Badan Usaha.xlsx');
    }

    public function gantiSlide(Request $r, $id)
    {

        $ext = $r->file('slide')->getClientOriginalExtension();

        $path = $r->file('slide')->storeAs('public/slide', 'slide' .$id .'.'.$ext);

        $Survei = SlideShow::find($id);
        $Survei->img = '/storage/slide/slide' . $id . '.' . $ext;
        $Survei->save();

        return back();
    }

    public function gantiLinksurvei(Request $r, $id)
    {

        
        $Survei = Survei::find($id);
        $input = $r->all();
        $Survei->fill($input)->save();

        return back();
    }

    public function gantiStatusPengajuanDana(Request $r,$id,$status)
    {
        $PengajuanDana = PengajuanDana::find($id);
        $User = User::find($PengajuanDana->user_id);

        $BadanUsaha = BadanUsaha::where('nik',$User->nik)->first();

        // dd($BadanUsaha);

        if($status == "Ditolak"){
            $PengajuanDana->alasan = $r->input('alasan');
        }else{
            $PengajuanDana->alasan = "Selamat Pengajuan Dana Anda diterima";

        }

        $PengajuanDana->status = $status;
        
        $PengajuanDana->save();

        if($status == "Diterima"){
            $notifikasi = new Notifikasi([
                'id' => (string) Str::uuid(),
                'deskripsi' => "Pengajuan Dana dari " . $BadanUsaha->nama_usaha,
                'user_role' => $PengajuanDana->instansi,
            ]);
            
            $notifikasi->save();

            $notifikasi = new Notifikasi([
                'id' => (string) Str::uuid(),
                'deskripsi' => "Pengajuan Dana Anda Diterima",
                'user_role' => "MEMBER",
            ]);
            
            $notifikasi->save();
        }
        if($status == "Ditolak"){
            $notifikasi = new Notifikasi([
                'id' => (string) Str::uuid(),
                'deskripsi' => "Pengajuan Dana Anda Ditolak",
                'user_role' => "MEMBER",
            ]);
            
            $notifikasi->save();
        }

      

        return redirect('/admin/daftarPengajuanDana');

    }
    public function gantiStatusNotifikasi($userRole,$recentPage)
    {

        $Notifikasi = Notifikasi::where("user_role",$userRole)->update(['status'=>"read"]);

        // $Notifikasi->status = "read";

        // $Notifikasi->save();

        return redirect('/admin/'.$recentPage);

    }
    //
}
