<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Models\BadanUsaha;
use App\Models\Notifikasi;
use App\Models\PengajuanDana;
use App\Models\DataPendukung;
use App\Models\User;
use App\Models\Surat;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PengajuanDanaOJKExport;




class OjkController extends Controller
{
    private $fieldBadanUsaha = [
        'badan_usaha.id as id',
        'badan_usaha_documents.id as badan_usaha_documents_id',
        'badan_usaha.nik',
        'badan_usaha.nama_direktur',
        'kabupaten.name as kabupaten',
        'kecamatan.name as kecamatan',
        'kelurahan.name as kelurahan',
        'badan_usaha.alamat_lengkap',
        'badan_usaha.no_hp',
        'badan_usaha.nama_usaha',
        'badan_usaha.bentuk_usaha',
        'badan_usaha.tahun_berdiri',
        'badan_usaha.nib_tahun',
        'badan_usaha.nomor_sertifikat_halal_tahun',
        'badan_usaha.sertifikat_merek_tahun',
        'badan_usaha.nomor_test_report_tahun',
        'badan_usaha.sni_tahun',
        'badan_usaha.jenis_usaha',
        'badan_usaha.merek_usaha',
        'cabang_industri.name as cabang_industri',
        'sub_cabang_industri.name as sub_cabang_industri',
        'kbli.name as kbli',
        'badan_usaha.investasi_modal',
        'badan_usaha.jumlah_tenaga_kerja_pria',
        'badan_usaha.jumlah_tenaga_kerja_wanita',
        'badan_usaha.rata_rata_pendidikan_tenaga_kerja',
        'badan_usaha.kapasitas_produksi_perbulan',
        'badan_usaha.satuan_produksi',
        'badan_usaha.nilai_produksi_perbulan',
        'badan_usaha.nilai_bahan_baku_perbulan',
        'badan_usaha_documents.nib_file',
        'badan_usaha_documents.bentuk_usaha_file',
        'badan_usaha_documents.sertifikat_halal_file',
        'badan_usaha_documents.sertifikat_sni_file',
        'badan_usaha_documents.sertifikat_merek_file',
        'badan_usaha.foto_alat_produksi',
        'badan_usaha.foto_ruang_produksi',
        'produk.foto as produk',

    ];
    private $fields = [
        // 'id',
        'nik',
        'nama_direktur',
        'kabupaten',
        'kecamatan',
        'kelurahan',
        'alamat_lengkap',
        'no_hp',
        'nama_usaha',
        'bentuk_usaha',
        'bentuk_usaha_file',
        'tahun_berdiri',
        'nib_tahun',
        'nib_file',
        'nomor_sertifikat_halal_tahun',
        'sertifikat_halal_file',
        'sertifikat_merek_tahun',
        'sertifikat_merek_file',
        'nomor_test_report_tahun',
        'sni_tahun',
        'sertifikat_sni_file',
        'jenis_usaha',
        'merek_usaha',
        'cabang_industri',
        'sub_cabang_industri',
        'kbli',
        'investasi_modal',
        'jumlah_tenaga_kerja_pria',
        'jumlah_tenaga_kerja_wanita',
        'rata_rata_pendidikan_tenaga_kerja',
        'kapasitas_produksi_perbulan',
        'satuan_produksi',
        'nilai_produksi_perbulan',
        'nilai_bahan_baku_perbulan',
        'lat',
        'lng',
        'media_sosial',
        'foto_alat_produksi',
        'foto_ruang_produksi',
        'produk',
        // 'created_at',
        // 'updated_at'
    ];
    function index($pages = "dashboard", $subPages = "", $id = "")
    {
        $Notifikasi = Notifikasi::where("user_role", "OJK")->where("nik", Auth::user()->nik)->where("status", "not read")->get();

        if (Auth::check()) {
            if (Auth::user()->role === "ADMIN") {
                return redirect('/admin/tabel');
            } else if (Auth::user()->role === "BANK") {
                return redirect('/perbankan/dashboard');
            } else if (Auth::user()->role === "KOPERASI") {
                return redirect('/koperasi/daftarPengajuanDana');
            } else if (Auth::user()->role === "IKM") {
                return redirect('/member/dashboard');
            } else if (Auth::user()->role === "PERDAGANGAN") {
                return redirect('/perdagangan/dashboard');
            } else {

                $Notifikasi = Notifikasi::where("user_role", "OJK")->where("nik", Auth::user()->nik)->where("status", "not read")->get();

                if ($id != "") {
                    $BadanUsaha = BadanUsaha::leftJoin('badan_usaha_documents', 'badan_usaha.id', '=', 'badan_usaha_documents.id_badan_usaha')
                        ->leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
                        ->leftJoin('kecamatan', 'badan_usaha.kecamatan', '=', 'kecamatan.id')
                        ->leftJoin('kelurahan', 'badan_usaha.kelurahan', '=', 'kelurahan.id')
                        ->leftJoin('cabang_industri', 'badan_usaha.cabang_industri', '=', 'cabang_industri.id')
                        ->leftJoin('sub_cabang_industri', 'badan_usaha.sub_cabang_industri', '=', 'sub_cabang_industri.id')
                        ->leftJoin('kbli', 'badan_usaha.id_kbli', '=', 'kbli.id')
                        ->leftJoin('produk', 'badan_usaha.id', '=', 'produk.id_badan_usaha')
                        ->where("badan_usaha.id", $id)
                        ->get($this->fieldBadanUsaha);
                }
                if ($subPages != "") {
                    $params = ['BadanUsaha' => $BadanUsaha[0],  'pages' => $subPages, 'fields' => $this->fields, 'Notifikasi' => $Notifikasi];
                    $params['User'] = Auth::user();

                    if ($subPages == "dataTambahan") {
                        $BadanUsaha = BadanUsaha::where('id', $id)->first();

                        $dataPendukung = DataPendukung::where('id_badan_usaha', $id)->first();
                        // dd($BadanUsaha);
                        $user = User::where('nik', $BadanUsaha->nik)->first();

                        $params = [
                            'BadanUsaha' => $BadanUsaha,
                            'dataPendukung' => $dataPendukung,
                            'pages' => $subPages,
                            'Notifikasi' => $Notifikasi,
                            'User' => $user,
                        ];
                    }

                    if ($subPages == "suratRekomendasi") {

                        $BadanUsaha = BadanUsaha::where('id', $id)->get();
                        $user = User::where('nik', $BadanUsaha[0]->nik)->first();
                        $surat = Surat::find(1);

                        // dd($BadanUsaha);
                        $PengajuanDana = PengajuanDana::leftJoin('users', 'pengajuan_dana.id_instansi', '=', 'users.id')
                        ->leftJoin('instansi', 'pengajuan_dana.id_instansi', '=', 'instansi.user_id')
                        ->select("pengajuan_dana.id as id", "instansi.*", "pengajuan_dana.*")
                        ->where('pengajuan_dana.user_id', $user->id)->where('pengajuan_dana.status', "Menunggu")
                        ->orderBy('pengajuan_dana.created_at', 'desc')->first();
                        // $PengajuanDana = PengajuanDana::where('user_id', $user->id)->orderBy('created_at', 'desc')->first();
                        // dd($PengajuanDana);
                        $params = [
                            'BadanUsaha' => $BadanUsaha,
                            'PengajuanDana' => $PengajuanDana,
                            'pages' => $subPages,
                            'fields' => $this->fields,
                            'Notifikasi' => $Notifikasi,
                            'Surat' => $surat,
                            'User' => $user,

                        ];
                    }
                    if ($subPages == "downloadSurat") {
                        $BadanUsaha = BadanUsaha::where('id', $id)->get();
                        $user = User::where('nik', $BadanUsaha[0]->nik)->first();
                        $surat = Surat::find(1);
                        $PengajuanDana = PengajuanDana::leftJoin('users', 'pengajuan_dana.id_instansi', '=', 'users.id')
                        ->leftJoin('instansi', 'pengajuan_dana.id_instansi', '=', 'instansi.user_id')
                        ->select("pengajuan_dana.id as id", "instansi.*", "pengajuan_dana.*")
                        ->where('pengajuan_dana.user_id', $user->id)->where('pengajuan_dana.status', "Menunggu")
                       ->orderBy('pengajuan_dana.created_at', 'desc')->first();
                        // $PengajuanDana = PengajuanDana::where('user_id', $user->id)->orderBy('created_at', 'desc')->first();
                        $params = [
                            'BadanUsaha' => $BadanUsaha,
                            'PengajuanDana' => $PengajuanDana,
                            'pages' => $subPages,
                            'fields' => $this->fields,
                            'Notifikasi' => $Notifikasi,
                            'Surat' => $surat,
                        ];
                    }
                    return view("pages.ojk.{$subPages}", $params);
                } else {
                    // dd($BadanUsaha);
                    $params = ['pages' => $pages];

                    if ($pages == "dashboard") {
                        $PengajuanDana = PengajuanDana::leftJoin('users', 'pengajuan_dana.user_id', '=', 'users.id')
                            ->leftJoin('badan_usaha', 'users.nik', '=', 'badan_usaha.nik')
                            ->leftJoin('data_tambahan', 'badan_usaha.id', '=', 'data_tambahan.id_badan_usaha')
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
                            ->where("instansi", "BANK")
                            // ->where("pengajuan_dana.status","Diterima")
                            // ->where("pengajuan_dana.alasan","Selamat Pembiayaan Usaha Anda diterima")
                            // ->where("pengajuan_dana.alasan", 'LIKE', "%Pembiayaan Usaha Anda diterima Dinas Perindustrian%")
                            // ->Where("pengajuan_dana.admin_agree", 1)
                            ->whereNotNull("data_tambahan.ktp")
                            ->whereNotNull("data_tambahan.kk")
                            ->latest('dana_created_at')->get();
                        $params = [
                            'PengajuanDana' => $PengajuanDana,
                            'pages' => $pages,
                            'Notifikasi' => $Notifikasi,
                            'fields' => $this->fields
                        ];
                    }

                    $params['Notifikasi'] = $Notifikasi;
                    $params['pages'] = $pages;
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
