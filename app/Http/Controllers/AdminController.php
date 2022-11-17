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
use App\Models\Instansi;
use App\Models\Surat;
use App\Models\Kabupaten;
use App\Models\CabangIndustri;
use App\Models\DataPendukung;
use App\Imports\UserImport;
use App\Imports\BadanUsahaImport;
use App\Exports\BadanUsahaExport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;



class AdminController extends Controller
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
        'badan_usaha.rata_rata_pendidikan_tenaga_kerja',
        'badan_usaha.kapasitas_produksi_perbulan',
        'badan_usaha.satuan_produksi',
        'badan_usaha.nilai_produksi_perbulan',
        'badan_usaha.nilai_bahan_baku_perbulan',
        'badan_usaha.created_at',
        'badan_usaha.updated_at'
    ];

    private $fields2 = [
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

    private $orWhere = [
        'badan_usaha.nama_direktur',
        'badan_usaha.kecamatan',
        'badan_usaha.kelurahan',
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
    public function index($pages, $subPages = "", $id = "")
    {
        if (Auth::check()) {

            if (Auth::user()->role === "PERDAGANGAN") {
                return redirect('/perdagangan/dashboard');
            } else if (Auth::user()->role === "BANK") {
                return redirect('/perbankan/daftarPengajuanDana');
            } else if (Auth::user()->role === "KOPERASI") {
                return redirect('/koperasi/daftarPengajuanDana');
            } else if (Auth::user()->role === "IKM") {
                return redirect('/member/dashboard');
            } else if (Auth::user()->role === "OJK") {
                return redirect('/ojk/dashboard');
            } else {
                $Notifikasi = Notifikasi::where("user_role", "ADMIN")->where("nik", Auth::user()->nik)->where("status", "not read")->get();

                if ($id != "") {
                    // dd($id);

                    $BadanUsaha = BadanUsaha::find($id);
                    // dd($BadanUsaha);

                }
                if ($subPages != "") {

                    $subPagesParams = ['BadanUsaha' => $BadanUsaha,  'pages' => $subPages, 'fields' => $this->fields2, 'Notifikasi' => $Notifikasi, 'User' => Auth::user()];

                    if ($subPages == "downloadKartu") {
                        $kabupaten = Kabupaten::find($BadanUsaha[0]->id_kabupaten);
                        $CabangIndustri = CabangIndustri::where('name', $BadanUsaha[0]->cabang_industri)->first();
                        $BadanUsaha[0]->kabupaten = $kabupaten ? $kabupaten->name : null;
                        $BadanUsaha[0]->id_cabang_industri = $CabangIndustri ? $CabangIndustri->id : null;

                        $subPagesParams['BadanUsaha'] = $BadanUsaha;
                    }

                    if ($subPages == "dataTambahan") {
                        $dataPendukung = DataPendukung::where('id_badan_usaha', $id)->first();
                        // dd($dataPendukung);
                        $subPagesParams = [
                            'BadanUsaha' => $BadanUsaha,
                            'dataPendukung' => $dataPendukung,
                            'pages' => $subPages,
                            'Notifikasi' => $Notifikasi

                        ];
                    }
                    if ($subPages == "suratRekomendasi") {

                        $BadanUsaha = BadanUsaha::where('id', $id)->get();
                        $user = User::where('nik', $BadanUsaha[0]->nik)->first();
                        $surat = Surat::find(1);

                        // dd($surat);
                        $PengajuanDana = PengajuanDana::leftJoin('users', 'pengajuan_dana.id_instansi', '=', 'users.id')
                            ->leftJoin('instansi', 'pengajuan_dana.id_instansi', '=', 'instansi.user_id')
                            ->select("pengajuan_dana.id as id", "instansi.*", "pengajuan_dana.*")
                            ->where('pengajuan_dana.user_id', $user->id)->where('pengajuan_dana.status', "Menunggu")
                            ->orderBy('pengajuan_dana.created_at', 'desc')->first();
                        // $PengajuanDana = PengajuanDana::where('user_id', $user->id)->orderBy('created_at', 'desc')->first();
                        // dd($PengajuanDana);
                        $subPagesParams = [
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
                        $PengajuanDana = PengajuanDana::leftJoin('users', 'pengajuan_dana.id_instansi', '=', 'users.id')
                            ->leftJoin('instansi', 'pengajuan_dana.id_instansi', '=', 'instansi.user_id')
                            ->select("pengajuan_dana.id as id", "instansi.*", "pengajuan_dana.*")
                            ->where('pengajuan_dana.user_id', $user->id)->where('pengajuan_dana.status', "Menunggu")
                            ->orderBy('pengajuan_dana.created_at', 'desc')->first();
                        // $PengajuanDana = PengajuanDana::where('user_id', $user->id)->orderBy('created_at', 'desc')->first();
                        $subPagesParams = [
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
                            ->where("badan_usaha.id", $id)
                            ->get($this->fieldBadanUsaha);
                        // dd($BadanUsaha[0]);
                        // $kabupaten = Kabupaten::find($BadanUsaha[0]->id_kabupaten);

                        // $CabangIndustri = CabangIndustri::where('name', $BadanUsaha[0]->cabang_industri)->first();

                        // $BadanUsaha[0]->kabupaten = $kabupaten ? $kabupaten->name : null;

                        // $BadanUsaha[0]->id_cabang_industri = $CabangIndustri ? $CabangIndustri->id : null;

                        $subPagesParams['BadanUsaha'] = $BadanUsaha[0];
                    }
                    // dd($subPagesParams);
                    return view("pages.admin.{$subPages}", $subPagesParams);
                } else {
                    $params = null;
                    // dd(Auth::user()->nik);
                    $User = User::leftJoin('badan_usaha', 'users.nik', '=', 'badan_usaha.nik')
                        ->leftJoin('instansi', 'users.id', '=', 'instansi.user_id')
                        ->select('badan_usaha.*', 'instansi.*', 'users.*', 'users.nik as nik')
                        ->get();
                    if ($pages == "tabel") {
                        $BadanUsaha = BadanUsaha::leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
                            ->leftJoin('cabang_industri', 'badan_usaha.cabang_industri', '=', 'cabang_industri.id')
                            ->leftJoin('sub_cabang_industri', 'badan_usaha.sub_cabang_industri', '=', 'sub_cabang_industri.id')
                            ->paginate(100, $this->fields);
                        $Kabupaten = Kabupaten::all();
                        $params = [
                            'BadanUsaha' => $BadanUsaha,
                            'SlideShow' => SlideShow::all(),
                            'Survei' => Survei::all(),
                            'keyword' => "",
                            'pages' => $pages,
                            'Notifikasi' => $Notifikasi,
                            'Kabupaten' => $Kabupaten,
                            'fields' => $this->fields2

                        ];
                    }
                    if ($pages == "daftarAkun") {

                        // dd($User);
                        $params = [
                            'pages' => $pages,
                            'User' => $User,
                            'Notifikasi' => $Notifikasi,
                        ];
                    }
                    if ($pages == "daftarPengajuanDana") {
                        $PengajuanDana = PengajuanDana::leftJoin('users', 'pengajuan_dana.user_id', '=', 'users.id')
                            ->leftJoin('badan_usaha', 'users.nik', '=', 'badan_usaha.nik')
                            ->leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
                            ->where("pengajuan_dana.status", "Menunggu")
                            ->select('badan_usaha.nama_usaha', 'badan_usaha.nik', 'badan_usaha.nama_direktur', 'badan_usaha.id as id_badan_usaha', 'kabupaten.name as kabupaten', 'pengajuan_dana.*')->orderBy('created_at', 'desc')->get();
                        // dd($PengajuanDana);

                        $params = [
                            'PengajuanDana' => $PengajuanDana,
                            'pages' => $pages,
                            'Notifikasi' => $Notifikasi
                        ];
                    }
                    if ($pages == "historyPengajuanDana") {
                        $PengajuanDana = PengajuanDana::leftJoin('users', 'pengajuan_dana.user_id', '=', 'users.id')
                            ->leftJoin('badan_usaha', 'users.nik', '=', 'badan_usaha.nik')
                            ->leftJoin('data_tambahan', 'badan_usaha.id', '=', 'data_tambahan.id_badan_usaha')
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
                                'data_tambahan.ktp',
                                'data_tambahan.kk',
                            )
                            ->where("pengajuan_dana.status", "Diterima")
                            ->orWhere("pengajuan_dana.status", "Ditolak")
                            ->orderBy('created_at', 'desc')->get();
                        // dd($PengajuanDana);

                        $params = [
                            'PengajuanDana' => $PengajuanDana,
                            'pages' => $pages,
                            'Notifikasi' => $Notifikasi
                        ];
                    }
                    if ($pages == "setting") {
                        $User = User::all();
                        // dd($User);
                        $params = [
                            'pages' => $pages,
                            'User' => $User,
                            'Notifikasi' => $Notifikasi,
                            'SlideShow' => SlideShow::all(),
                            'Survei' => Survei::all()

                        ];
                    }
                    if ($pages == "settingAkun") {
                        $params['UserAdmin'] = Auth::User();
                    }
                    if ($pages == "settingSurat") {
                        $params['surat'] = Surat::first();
                    }


                    $params['Notifikasi'] = $Notifikasi;
                    $params['pages'] = $pages;
                    $params['User'] = $User;
                    $params['Instansi'] = Instansi::all();



                    // dd($params);
                    return view(
                        "pages.admin.{$pages}",
                        $params
                    );
                }
            }
        } else {
            return redirect('/login');
        }
    }


    public function searchBadanUsaha(Request $request)
    {
        $keyword = $request->input('keyword');
        $Notifikasi = Notifikasi::where("user_role", "ADMIN")->where("nik", Auth::user()->nik)->where("status", "not read")->get();
        $Kabupaten = Kabupaten::all();



        $BadanUsaha = BadanUsaha::leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
            ->leftJoin('cabang_industri', 'badan_usaha.cabang_industri', '=', 'cabang_industri.id')
            ->leftJoin('sub_cabang_industri', 'badan_usaha.sub_cabang_industri', '=', 'sub_cabang_industri.id')
            ->where('badan_usaha.nik', 'LIKE', "%{$keyword}%");


        foreach ($this->orWhere as &$field) {
            $BadanUsaha = $BadanUsaha->orWhere($field, 'LIKE', "%{$keyword}%");
        }

        $BadanUsaha = $BadanUsaha->paginate(100, $this->fields);

        return view(
            'pages.admin.tabel',
            [
                'BadanUsaha' => $BadanUsaha,
                'keyword' => $keyword,
                'pages' => 'tabel',
                'Notifikasi' => $Notifikasi,
                'Kabupaten' => $Kabupaten,
                'fields' => $this->fields2
            ]
        );
    }
    public function searchPengajuanDana(Request $request, $pages)
    {
        $keyword = $request->input('keyword');
        $Notifikasi = Notifikasi::where("user_role", $request->input('role'))->where("nik", Auth::user()->nik)->where("status", "not read")->get();


        $PengajuanDana = PengajuanDana::leftJoin('users', 'pengajuan_dana.user_id', '=', 'users.id')
            ->leftJoin('badan_usaha', 'users.nik', '=', 'badan_usaha.nik')
            ->leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
            // ->where("pengajuan_dana.status","Menunggu")
            ->where('badan_usaha.nama_usaha', 'LIKE', "%{$keyword}%")
            ->select('badan_usaha.nama_usaha', 'badan_usaha.nik', 'badan_usaha.id as id_badan_usaha', 'kabupaten.name as kabupaten', 'pengajuan_dana.*')->orderBy('created_at', 'desc')->get();
        // dd($PengajuanDana);

        $params = [
            'PengajuanDana' => $PengajuanDana,
            'pages' => $pages,
            'Notifikasi' => $Notifikasi
        ];

        // dd($PengajuanDana);
        return view('pages.' . $pages . '.daftarPengajuanDana', $params);
    }

    public function deleteBadanUsahaPerKabupaten(Request $r)
    {
        // dd(count($r->request));
        $filter = $r->except(['_token']);
        // unset($filter['KABUPATEN_LOMBOK_BARAT']);
        $BadanUsaha = BadanUsaha::whereIn('id_kabupaten', $filter)->get();
        dd($BadanUsaha);

        // $BadanUsaha->delete();

        return redirect('/admin/tabel');
    }

    public function deleteAllBadanUsaha()
    {

        BadanUsaha::truncate();

        return redirect('/admin/tabel');
    }

    public function importExcel(Request $request)
    {

        Excel::import(new UserImport, request()->file('file'));
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

        $path = $r->file('slide')->storeAs('public/slide', 'slide' . $id . '.' . $ext);

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

    public function gantiStatusPengajuanDana(Request $r, $id, $status)
    {
        $PengajuanDana = PengajuanDana::find($id);
        $User = User::find($PengajuanDana->user_id);

        $BadanUsaha = BadanUsaha::where('nik', $User->nik)->first();

        // dd($BadanUsaha);

        if ($status == "Ditolak") {
            $PengajuanDana->alasan = $r->input('alasan');
        } else {
            $PengajuanDana->alasan = "Pembiayaan Usaha Anda diterima Dinas Perindustrian";
        }

        $PengajuanDana->status = $status;

        $PengajuanDana->save();
        $instansi = User::find($PengajuanDana->id_instansi);
        // dd($instansi);
        if ($status == "Diterima") {
            $notifikasi = new Notifikasi([
                'id' => (string) Str::uuid(),
                'nik' => $instansi->nik,
                'deskripsi' => "Pembiayaan Usaha dari " . $BadanUsaha->nama_usaha,
                'user_role' => $PengajuanDana->instansi,
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
        if ($status == "Ditolak") {
            $notifikasi = new Notifikasi([
                'id' => (string) Str::uuid(),
                'nik' => $User->nik,
                'deskripsi' => $r->input('alasan'),
                'user_role' => "MEMBER",
            ]);

            $notifikasi->save();
        }



        return redirect('/admin/daftarPengajuanDana');
    }
    public function gantiStatusNotifikasi(Request $r, $userRole, $recentPage)
    {

        $Notifikasi = Notifikasi::where("user_role", $userRole)->where("nik", $r->input('nik'))->update(['status' => "read"]);

        // $Notifikasi->status = "read";

        // $Notifikasi->save();

        return redirect('/admin/' . $recentPage);
    }
    public function tambahUser(Request $r)
    {

        // dd($r);
        $id = (string) Str::uuid()->getHex();
        $users = new User([
            'id' => $id,
            'role' => $r->input("role"),
            'password' => Hash::make("12345678"),
        ]);
        $users->nik = $r->input("nik");

        if ($r->input("role") == "BANK" || $r->input("role") == "KOPERASI") {
            $users->nik = (string) Str::uuid()->getHex();

            $Instansi = new Instansi([
                'id' => (string) Str::uuid()->getHex(),
                'user_id' => $id,
                'nama' => $r->input("nama_instansi"),
            ]);
            $Instansi->save();
        }
        $users->save();

        return redirect('/admin/daftarAkun');
    }

    public function ubahStatusUser($id, $status)
    {

        $user = User::find($id);

        $user->status = $status;
        $user->save();



        return redirect('/admin/daftarAkun');
    }

    public function hapusUser($id)
    {

        $res = User::where('id', $id)->delete();



        return redirect('/admin/daftarAkun');
    }
    //
    public function settingSurat(Request $r)
    {
        $surat = Surat::find(1);
        // dd($surat);
        $surat->judul_kop = $r->judul_kop;
        $surat->alamat_kop = $r->alamat_kop;
        $surat->nama_kadis = $r->nama_kadis;
        $surat->nip = $r->nip;
        $surat->jabatan = $r->jabatan;
        $surat->alamat = $r->alamat;
        $surat->nomor_surat = $r->nomor_surat;
        if (!empty($r->file('ttd'))) {
            $file = $r->file('ttd');
            $extension = $file->getClientOriginalExtension();
            $filename = "signKadis" . '.' . $extension;
            $file->move(public_path('images/'), $filename);
            $surat->ttd = 'images/' . $filename;
        }
        $surat->save();

        return redirect('/admin/settingSurat');
    }
    public function resetPasswordUser($id)
    {
        $User = User::find($id);
        // dd($surat);
        $User->password = Hash::make('12345678');

        $User->save();

        return redirect('/admin/daftarAkun');
    }
}
