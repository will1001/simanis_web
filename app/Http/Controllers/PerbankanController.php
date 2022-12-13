<?php

namespace App\Http\Controllers;

use App\Exports\BadanUsahaExport;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\BadanUsaha;
use App\Models\Notifikasi;
use App\Models\PengajuanDana;
use App\Models\JumlahPinjaman;
use App\Models\JangkaWaktu;
use App\Models\SimulasiAngsuran;
use App\Models\DataPendukung;
use App\Models\Instansi;
use App\Models\User;
use App\Models\Surat;
use Illuminate\Support\Str;
use App\Exports\PengajuanDanaPerbankanExport;
use App\Exports\BadanUsahaExportByID;




class PerbankanController extends Controller
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
        'badan_usaha.omset',
        'badan_usaha_documents.nib_file',
        'badan_usaha_documents.bentuk_usaha_file',
        'badan_usaha_documents.sertifikat_halal_file',
        'badan_usaha_documents.sertifikat_sni_file',
        'badan_usaha_documents.sertifikat_merek_file',
        'badan_usaha.foto_alat_produksi',
        'badan_usaha.foto_ruang_produksi',
        'produk.foto as produk',
        'data_tambahan.ktp',
        'data_tambahan.kk',
        'data_tambahan.ktp_pasangan',

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
        'omset',
        'lat',
        'lng',
        'media_sosial',
        'foto_alat_produksi',
        'foto_ruang_produksi',
        'produk',
        'ktp',
        'kk',
        'ktp_pasangan',
        // 'created_at',
        // 'updated_at'
    ];
    function index($pages = "dashboard", $subPages = "", $id = "")
    {
        $Notifikasi = Notifikasi::where("user_role", "BANK")->where("nik", Auth::user()->nik)->where("status", "not read")->get();

        if (Auth::check()) {
            if (Auth::user()->role === "ADMIN") {
                return redirect('/admin/tabel');
            } else if (Auth::user()->role === "PERDAGANGAN") {
                return redirect('/perdagangan/dashboard');
            } else if (Auth::user()->role === "KOPERASI") {
                return redirect('/koperasi/daftarPengajuanDana');
            } else if (Auth::user()->role === "IKM") {
                return redirect('/member/dashboard');
            } else if (Auth::user()->role === "OJK") {
                return redirect('/ojk/dashboard');
            } else {
                $Instansi = Instansi::where("user_id", Auth::id())->first();
                $BadanUsaha = [];

                if ($id != "") {

                    $BadanUsaha = BadanUsaha::find($id);
                }
                if ($subPages != "") {
                    // dd($BadanUsaha);
                    $params = ['BadanUsaha' => $BadanUsaha, 'pages' => $subPages, 'fields' => $this->fields, 'Notifikasi' => $Notifikasi];
                    if ($subPages == "dataTambahan") {
                        $dataPendukung = DataPendukung::where('id_badan_usaha', $id)->first();
                        // dd($dataPendukung);
                        $params = [
                            'BadanUsaha' => $BadanUsaha,
                            'dataPendukung' => $dataPendukung,
                            'pages' => $subPages,
                            'Notifikasi' => $Notifikasi

                        ];
                    }
                    if ($subPages == "suratRekomendasi") {

                        $BadanUsaha = BadanUsaha::where('id', $id)->first();
                        $user = User::where('nik', $BadanUsaha->nik)->first();
                        $surat = Surat::find(1);

                        // dd($user);
                        $PengajuanDana = PengajuanDana::leftJoin('users', 'pengajuan_dana.id_instansi', '=', 'users.id')
                            ->leftJoin('instansi', 'pengajuan_dana.id_instansi', '=', 'instansi.user_id')
                            ->select("pengajuan_dana.id as id", "instansi.*", "pengajuan_dana.*")
                            ->where('pengajuan_dana.user_id', $user->id)
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

                        ];
                    }
                    if ($subPages == "downloadSurat") {
                        // dd("adad");
                        $BadanUsaha = BadanUsaha::where('id', $id)->get();
                        // dd($BadanUsaha);
                        $user = User::where('nik', $BadanUsaha[0]->nik)->first();
                        $surat = Surat::find(1);
                        $PengajuanDana = PengajuanDana::leftJoin('users', 'pengajuan_dana.id_instansi', '=', 'users.id')
                            ->leftJoin('instansi', 'pengajuan_dana.id_instansi', '=', 'instansi.user_id')
                            ->select("pengajuan_dana.id as id", "instansi.*", "pengajuan_dana.*")
                            ->where('pengajuan_dana.user_id', $user->id)
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
                        ];
                    }

                    if ($subPages == "ProfilBadanUsaha") {
                        $BadanUsaha = BadanUsaha::leftJoin('badan_usaha_documents', 'badan_usaha.id', '=', 'badan_usaha_documents.id_badan_usaha')
                            ->leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
                            ->leftJoin('kecamatan', 'badan_usaha.kecamatan', '=', 'kecamatan.id')
                            ->leftJoin('kelurahan', 'badan_usaha.kelurahan', '=', 'kelurahan.id')
                            ->leftJoin('cabang_industri', 'badan_usaha.cabang_industri', '=', 'cabang_industri.id')
                            ->leftJoin('sub_cabang_industri', 'badan_usaha.sub_cabang_industri', '=', 'sub_cabang_industri.id')
                            ->leftJoin('kbli', 'badan_usaha.id_kbli', '=', 'kbli.id')
                            ->leftJoin('produk', 'badan_usaha.id', '=', 'produk.id_badan_usaha')
                            ->leftJoin('data_tambahan', 'badan_usaha.id', '=', 'data_tambahan.id_badan_usaha')
                            ->where("badan_usaha.id", $id)
                            ->get($this->fieldBadanUsaha);
                        $params = [
                            'BadanUsaha' => $BadanUsaha[0],
                            'pages' => $subPages,
                            'fields' => $this->fields,
                            'Notifikasi' => $Notifikasi
                        ];
                    }
                    if ($subPages == "downloadProfilBadanUsaha") {
                        $BadanUsaha = BadanUsaha::leftJoin('badan_usaha_documents', 'badan_usaha.id', '=', 'badan_usaha_documents.id_badan_usaha')
                            ->leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
                            ->leftJoin('kecamatan', 'badan_usaha.kecamatan', '=', 'kecamatan.id')
                            ->leftJoin('kelurahan', 'badan_usaha.kelurahan', '=', 'kelurahan.id')
                            ->leftJoin('cabang_industri', 'badan_usaha.cabang_industri', '=', 'cabang_industri.id')
                            ->leftJoin('sub_cabang_industri', 'badan_usaha.sub_cabang_industri', '=', 'sub_cabang_industri.id')
                            ->leftJoin('kbli', 'badan_usaha.id_kbli', '=', 'kbli.id')
                            ->leftJoin('produk', 'badan_usaha.id', '=', 'produk.id_badan_usaha')
                            ->leftJoin('data_tambahan', 'badan_usaha.id', '=', 'data_tambahan.id_badan_usaha')
                            ->where("badan_usaha.id", $id)
                            ->get($this->fieldBadanUsaha);
                        $params = [
                            'BadanUsaha' => $BadanUsaha[0],
                            'pages' => $subPages,
                            'fields' => $this->fields,
                            'Notifikasi' => $Notifikasi
                        ];
                    }
                    $params['Instansi'] = $Instansi;
                    $params['User'] = Auth::user();
                    // dd($subPages);
                    return view("pages.perbankan.{$subPages}", $params);
                } else {

                    $params = ['pages' => $pages];



                    if ($pages == "daftarPengajuanDana") {
                        $PengajuanDana = PengajuanDana::leftJoin('users', 'pengajuan_dana.user_id', '=', 'users.id')
                            ->leftJoin('badan_usaha', 'users.nik', '=', 'badan_usaha.nik')
                            ->leftJoin('instansi', 'pengajuan_dana.id_instansi', '=', 'instansi.user_id')
                            // ->leftJoin('data_tambahan', 'badan_usaha.id', '=', 'data_tambahan.id_badan_usaha')
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
                                'instansi.nama as nama_instansi',
                                // 'data_tambahan.ktp',
                                // 'data_tambahan.kk',
                            )
                            ->where("alasan", "!=", "")
                            ->where("alasan", "!=", null)
                            ->where("id_instansi", Auth::id())
                            ->where("pengajuan_dana.status", "Menunggu")
                            ->where("pengajuan_dana.alasan", "!=", "Ditolak Admin")
                            // ->whereNotNull("data_tambahan.ktp")
                            // ->whereNotNull("data_tambahan.kk")
                            ->latest('dana_created_at')->get();
                        // dd($Auth::id());
                        $JumlahPinjaman = JumlahPinjaman::all();
                        $JangkaWaktu = JangkaWaktu::all();
                        $SimulasiAngsuran = SimulasiAngsuran::all();
                        $Instansi = Instansi::all();

                        $params = [
                            'PengajuanDana' => $PengajuanDana,
                            'pages' => $pages,
                            'Notifikasi' => $Notifikasi,
                            'fields' => $this->fields,
                            'JumlahPinjaman' => $JumlahPinjaman,
                            'JangkaWaktu' => $JangkaWaktu,
                            'Instansi' => $Instansi,
                            'SimulasiAngsuran' => $SimulasiAngsuran,
                        ];
                    }
                    if ($pages == "historyPengajuanDana") {
                        $PengajuanDana = PengajuanDana::leftJoin('users', 'pengajuan_dana.user_id', '=', 'users.id')
                            ->leftJoin('badan_usaha', 'users.nik', '=', 'badan_usaha.nik')
                            ->leftJoin('instansi', 'pengajuan_dana.id_instansi', '=', 'instansi.user_id')
                            // ->leftJoin('data_tambahan', 'badan_usaha.id', '=', 'data_tambahan.id_badan_usaha')
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
                                'instansi.nama as nama_instansi',
                                // 'data_tambahan.ktp',
                                // 'data_tambahan.kk',
                            )
                            // ->where("instansi", "BANK")
                            ->where("id_instansi", Auth::id())
                            // ->where("pengajuan_dana.status", "Diterima")
                            // ->orWhere("pengajuan_dana.status", "Ditolak")
                            // ->orWhere("pengajuan_dana.status", "Lunas")
                            ->where("pengajuan_dana.status", "not like", "%Menunggu%")
                            ->where("pengajuan_dana.alasan", "not like", "%Ditolak Admin%")
                            ->orderBy('dana_created_at', 'desc')->get();
                        // dd($PengajuanDana);
                        // dd(Auth::id());

                        $params = [
                            'PengajuanDana' => $PengajuanDana,
                            'pages' => $pages,
                            'Notifikasi' => $Notifikasi,
                            'fields' => $this->fields
                        ];
                    }

                    if ($pages == "simulasiAngsuran") {

                        $Instansi = Instansi::where('user_id', Auth::id())->first();
                        $Simulasi = SimulasiAngsuran::leftJoin('list_jangka_waktu', 'simulasi_angsuran.id_jangka_waktu', '=', 'list_jangka_waktu.id')
                            ->leftJoin('list_jumlah_pinjaman', 'simulasi_angsuran.id_jml_pinjaman', '=', 'list_jumlah_pinjaman.id')
                            ->leftJoin('instansi', 'simulasi_angsuran.id_instansi', '=', 'instansi.id')
                            ->select('list_jangka_waktu.*', 'list_jumlah_pinjaman.*', 'instansi.*', 'simulasi_angsuran.*', 'list_jangka_waktu.id as id_jangka_waktu', 'list_jumlah_pinjaman.id as id_jumlah_pinjaman', 'instansi.id as id_instansi', 'simulasi_angsuran.id as id')
                            ->where("instansi.user_id", Auth::id())
                            ->where("simulasi_angsuran.id_instansi", $Instansi->id)
                            ->orderByRaw('CONVERT(list_jangka_waktu.waktu, SIGNED) asc')
                            ->get();
                        // dd($Simulasi);


                        $JangkaWaktu = JangkaWaktu::where("id_instansi", $Instansi->id)->orderBy('waktu', 'ASC')->get();
                        $JumlahPinjaman = JumlahPinjaman::where("id_instansi", $Instansi->id)->orderByRaw('CONVERT(jumlah, SIGNED) asc')->get();
                        // dd($JangkaWaktu);

                        $params = [
                            'pages' => $pages,
                            'Notifikasi' => $Notifikasi,
                            'Simulasi' => $Simulasi,
                            'JangkaWaktu' => $JangkaWaktu,
                            'JumlahPinjaman' => $JumlahPinjaman,
                        ];
                    }

                    if ($pages == "settingAkun") {
                        // $BadanUsaha = BadanUsaha::where('nik',Auth::user()->nik)->get();
                        // dd("asdad");
                        // $params = [
                        //     'BadanUsaha' => $BadanUsaha
                        // ];
                    }

                    $params['User'] = Auth::user();
                    $params['Notifikasi'] = $Notifikasi;
                    $params['Instansi'] = Instansi::where("user_id", Auth::id())->first();


                    return view("pages.perbankan.{$pages}", $params);
                }
            }
        } else {
            return redirect('/login');
        }
    }

    function tambahSimulasiAngsuran(Request $r)
    {
        $Instansi = Instansi::where("user_id", Auth::id())->first();
        $dana = JumlahPinjaman::where("id_instansi", $Instansi->id)->where("jumlah", $r->input("jumlah_dana"))->first();
        if (!$dana) {
            $id_dana = (string) Str::uuid();
            $JumlahPinjaman = new JumlahPinjaman([
                'id' => $id_dana,
                'id_instansi' => $Instansi->id,
                'jumlah' => $r->input("jumlah_dana"),
            ]);

            $JumlahPinjaman->save();

            for ($i = 1; $i < 8; $i++) {
                $SimulasiAngsuran = new SimulasiAngsuran([
                    'id' => (string) Str::uuid(),
                    'id_instansi' => $Instansi->id,
                    'id_jml_pinjaman' => $id_dana,
                    'id_jangka_waktu' => $i,
                    'angsuran' => "",
                ]);

                $SimulasiAngsuran->save();
            }
        }
        $waktu = JangkaWaktu::where("id_instansi", $Instansi->id)->where("waktu", $r->input("jangka_waktu"))->first();
        // if (!$waktu) {
        //     $JangkaWaktu = new JangkaWaktu([
        //         'id' => (string) Str::uuid(),
        //         'id_instansi' => $Instansi->id,
        //         'waktu' => $r->input("jangka_waktu"),
        //     ]);

        //     $JangkaWaktu->save();
        // }

        $dana = JumlahPinjaman::where("id_instansi", $Instansi->id)->where("jumlah", $r->input("jumlah_dana"))->first();
        $waktu = JangkaWaktu::where("id_instansi", $Instansi->id)->where("waktu", $r->input("jangka_waktu"))->first();





        $simulasi = SimulasiAngsuran::where("id_jml_pinjaman", $dana->id)
            ->first();
        if (!$simulasi) {
            for ($i = 1; $i < 8; $i++) {
                $SimulasiAngsuran = new SimulasiAngsuran([
                    'id' => (string) Str::uuid(),
                    'id_instansi' => $Instansi->id,
                    'id_jml_pinjaman' => $dana->id,
                    'id_jangka_waktu' => $i,
                    'angsuran' => "",
                ]);

                $SimulasiAngsuran->save();
            }
        }


        $simulasi2 = SimulasiAngsuran::where("id_jml_pinjaman", $dana->id)
            ->where("id_jangka_waktu", $waktu->id)
            ->first();

        if (!$simulasi2) {

            $SimulasiAngsuran = new SimulasiAngsuran([
                'id' => (string) Str::uuid(),
                'id_instansi' => $Instansi->id,
                'id_jml_pinjaman' => $dana->id,
                'id_jangka_waktu' => $waktu->id,
                'angsuran' => $r->input("angsuran"),
            ]);

            $SimulasiAngsuran->save();
        } else {

            $simulasi2->angsuran = $r->input("angsuran");
            $simulasi2->save();
        }

        return redirect('/perbankan/simulasiAngsuran');

        // dd($waktu);
    }

    function hapusSimulasiAngsuran(Request $r, $jumlah_dana)
    {
        $Instansi = Instansi::where("user_id", Auth::id())->first();
        $dana = JumlahPinjaman::where("id_instansi", $Instansi->id)->where("jumlah", $jumlah_dana)->first();
        // dd($dana);
        $simulasi = SimulasiAngsuran::where("id_jml_pinjaman", $dana->id)->delete();
        $dana->delete();

        return redirect('/perbankan/simulasiAngsuran');

        // dd($waktu);
    }
    function editSimulasiAngsuran(Request $r, $id)
    {
        $simulasi = SimulasiAngsuran::find($id);
        // dd($simulasi);
        $simulasi->angsuran = $r->input('angsuran');
        $simulasi->save();

        return redirect('/perbankan/simulasiAngsuran');

        // dd($waktu);
    }

    public function gantiStatusPengajuanDana(Request $r, $id, $status)
    {
        $PengajuanDana = PengajuanDana::find($id);
        // dd($id);

        $User = User::find($PengajuanDana->user_id);

        $BadanUsaha = BadanUsaha::where('nik', $User->nik)->first();
        // dd($status);
        // dd($r->input('alasan'));

        if ($status == "Ditolak" || $status == "Menunggu") {
            $PengajuanDana->alasan = $r->input('alasan');
        } else {
            if ($status == "Lunas") {

                $PengajuanDana->alasan = "Pembiayaan Usaha Anda Sudah Lunas";
            } else {

                $PengajuanDana->alasan = "Selamat Pembiayaan Usaha Anda diterima";
            }
        }

        $PengajuanDana->status = $status;
        // dd($PengajuanDana);
        $PengajuanDana->save();
        $instansi = User::find($PengajuanDana->id_instansi);
        // dd($instansi);
        if ($status == "Diterima") {
            $notifikasi = new Notifikasi([
                'id' => (string) Str::uuid(),
                'nik' => "33333333",
                'deskripsi' => "Pembiayaan Usaha dari " . $BadanUsaha->nama_usaha . "Diterima",
                'user_role' => "OJK",
            ]);

            $notifikasi->save();

            $notifikasi = new Notifikasi([
                'id' => (string) Str::uuid(),
                'nik' => $User->nik,
                'deskripsi' => "Pembiayaan Usaha Anda Diterima",
                'user_role' => "MEMBER",
            ]);

            $notifikasi->save();
        }
        // if ($status == "Ditolak" || $status == "Menunggu") {

        //     $PengajuanDana->jumlah_dana = $r->input('jumlah_dana_bank');
        //     $PengajuanDana->waktu_pinjaman = $r->input('jangka_waktu_bank');
        //     $PengajuanDana->save();

        //     $notifikasi = new Notifikasi([
        //         'id' => (string) Str::uuid(),
        //         'nik' => $User->nik,
        //         'deskripsi' => $r->input('alasan'),
        //         'user_role' => "MEMBER",
        //     ]);

        //     $notifikasi->save();
        // }


        if ($status == "Lunas") {

            return redirect('/perbankan/historyPengajuanDana');
        } else {

            return redirect('/perbankan/daftarPengajuanDana');
        }
    }

    public function exportExcel()
    {

        return Excel::download(new PengajuanDanaPerbankanExport, 'Pembiayaan Usaha.xlsx');
    }
    public function exportBadanUsahaByID($id)
    {
        return Excel::download(new BadanUsahaExportByID("277874d0-5529-11ed-bd42-ad674e7682c0"), 'Pembiayaan Usaha.xlsx');
    }
}
