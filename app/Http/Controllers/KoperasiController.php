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
        $Notifikasi = Notifikasi::where("user_role", "KOPERASI")->where("nik", Auth::user()->nik)->where("status", "not read")->get();

        if (Auth::check()) {
            if (Auth::user()->role === "ADMIN") {
                return redirect('/admin/tabel');
            } else if (Auth::user()->role === "BANK") {
                return redirect('/perbankan/daftarPengajuanDana');
            } else if (Auth::user()->role === "PERDAGANGAN") {
                return redirect('/perdagangan/dashboard');
            } else if (Auth::user()->role === "IKM") {
                return redirect('/member/dashboard');
            } else if (Auth::user()->role === "OJK") {
                return redirect('/ojk/dashboard');
            } else {
                $Instansi = Instansi::where("user_id", Auth::id())->first();

                if ($id != "") {
                    // dd($id);

                    $BadanUsaha = BadanUsaha::find($id);
                    // dd($BadanUsaha);
                }
                if ($subPages != "") {
                    $params = ['BadanUsaha' => $BadanUsaha,  'pages' => $subPages, 'fields' => $this->fields, 'Notifikasi' => $Notifikasi];
                    if ($subPages == "ProfilBadanUsaha") {
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
                        $params = [
                            'BadanUsaha' => $BadanUsaha[0],
                            'pages' => $subPages,
                            'fields' => $this->fields,
                            'Notifikasi' => $Notifikasi
                        ];
                    }
                    if ($subPages == "suratRekomendasi") {

                        $BadanUsaha = BadanUsaha::where('id', $id)->get();
                        $user = User::where('nik', $BadanUsaha[0]->nik)->first();
                        $surat = Surat::find(1);

                        // dd($user);
                        $PengajuanDana = PengajuanDana::leftJoin('users', 'pengajuan_dana.id_instansi', '=', 'users.id')
                            ->leftJoin('instansi', 'pengajuan_dana.id_instansi', '=', 'instansi.user_id')
                            ->select("pengajuan_dana.id as id", "instansi.*", "pengajuan_dana.*")
                            ->where('pengajuan_dana.user_id', Auth::id())->where('pengajuan_dana.status', "Menunggu")
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

                    if ($subPages == "downloadSurat") {
                        $BadanUsaha = BadanUsaha::where('id', $id)->get();
                        $user = User::where('nik', $BadanUsaha[0]->nik)->first();
                        $surat = Surat::find(1);
                        $PengajuanDana = PengajuanDana::where('user_id', $user->id)->orderBy('created_at', 'desc')->first();

                        $params = [
                            'BadanUsaha' => $BadanUsaha,
                            'PengajuanDana' => $PengajuanDana,
                            'pages' => $subPages,
                            'fields' => $this->fields,
                            'Notifikasi' => $Notifikasi,
                            'Surat' => $surat,
                        ];
                    }
                    $params['Instansi'] = $Instansi;
                    $params['User'] = Auth::user();

                    return view("pages.koperasi.{$subPages}", $params);
                } else {
                    // dd($pages);
                    $params = [];

                    if ($pages == "daftarPengajuanDana") {
                        $PengajuanDana = PengajuanDana::leftJoin('users', 'pengajuan_dana.user_id', '=', 'users.id')
                            ->leftJoin('badan_usaha', 'users.nik', '=', 'badan_usaha.nik')
                            ->leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
                            ->select(
                                'badan_usaha.*',
                                'badan_usaha.nama_direktur',
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
                            ->where("instansi", "KOPERASI")
                            ->where("pengajuan_dana.status", "Menunggu")
                            ->orderBy('created_at', 'desc')->get();

                        $params = [
                            'PengajuanDana' => $PengajuanDana,
                        ];
                    }

                    $params['Notifikasi'] = $Notifikasi;
                    $params['pages'] = $pages;
                    $params['User'] = Auth::user();
                    $params['Instansi'] = Instansi::where("user_id", Auth::id())->first();

                    return view("pages.koperasi.{$pages}", $params);
                }
            }
        } else {
            return redirect('/login');
        }
    }

    public function gantiStatusPengajuanDana(Request $r, $id, $status)
    {
        $PengajuanDana = PengajuanDana::find($id);

        $User = User::find($PengajuanDana->user_id);

        $BadanUsaha = BadanUsaha::where('nik', $User->nik)->first();

        // dd($BadanUsaha);
        // dd($BadanUsaha);

        if ($status == "Ditolak") {
            $PengajuanDana->alasan = $r->input('alasan');
        } else {
            if (!empty($r->file('pinjaman'))) {
                $file = $r->file('pinjaman');
                $extension = $file->getClientOriginalExtension();
                $filename = 'koperasi-pinjaman-' . $BadanUsaha->id . '.' . $extension;

                $file->move(public_path('pinjaman/'), $filename);
                // $data['foto']= 'images/'.$filename;

            }
            $PengajuanDana->alasan = "Selamat Pembiayaan Usaha Anda diterima Download file pada link untuk melihat detail pinjaman anda";
            $PengajuanDana->file_pinjaman = 'pinjaman/' . $filename;
            $PengajuanDana->save();
        }

        $PengajuanDana->status = $status;

        $PengajuanDana->save();
        $instansi = User::find($PengajuanDana->id_instansi);
        // dd($instansi);
        if ($status == "Diterima") {
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
        if ($status == "Ditolak") {
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
