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
use App\Models\User;
use App\Models\JumlahPinjaman;
use App\Models\JangkaWaktu;
use App\Models\SimulasiAngsuran;
use App\Models\Instansi;
use App\Models\Surat;
use App\Models\DataPendukung;


use Illuminate\Support\Str;



class MemberController extends Controller
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
        'lat',
        'lng',
        'media_sosial',
        'foto_alat_produksi',
        'foto_ruang_produksi',
        'ktp',
        'kk',
        'ktp_pasangan',
        // 'created_at',
        // 'updated_at'
    ];
    //
    function index($pages = "dashboard", $subPages = "", $id = "")
    {
        $Notifikasi = Notifikasi::where("user_role", "MEMBER")->where("nik", Auth::user()->nik)->where("status", "not read")->get();

        if (Auth::check()) {
            if (Auth::user()->role === "ADMIN") {
                return redirect('/admin/tabel');
            } else if (Auth::user()->role === "BANK") {
                return redirect('/perbankan/daftarPengajuanDana');
            } else if (Auth::user()->role === "KOPERASI") {
                return redirect('/koperasi/daftarPengajuanDana');
            } else if (Auth::user()->role === "PERDAGANGAN") {
                return redirect('/perdagangan/dashboard');
            } else if (Auth::user()->role === "OJK") {
                return redirect('/ojk/dashboard');
            } else {
                // dd(Auth::user()->nik);
                $BadanUsaha = BadanUsaha::where('nik', Auth::user()->nik)->get();
                $userDataProgress = array();
                // dd(count($this->fields));
                // dd(!$BadanUsaha->first());
                // dd(empty($BadanUsaha));
                if (!$BadanUsaha->first()) {
                    $NewBadanUsaha = new BadanUsaha;
                    $NewBadanUsaha->id = (string) Str::uuid();
                    $NewBadanUsaha->nik = Auth::user()->nik;

                    // BUAT BADAN USAHA
                    $NewBadanUsaha->save();
                }
                // $BadanUsaha = BadanUsaha::where('nik', Auth::user()->nik)->get();
                $badan_usaha = BadanUsaha::leftJoin('badan_usaha_documents', 'badan_usaha.id', '=', 'badan_usaha_documents.id_badan_usaha')
                    ->leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
                    ->leftJoin('kecamatan', 'badan_usaha.kecamatan', '=', 'kecamatan.id')
                    ->leftJoin('kelurahan', 'badan_usaha.kelurahan', '=', 'kelurahan.id')
                    ->leftJoin('cabang_industri', 'badan_usaha.cabang_industri', '=', 'cabang_industri.id')
                    ->leftJoin('sub_cabang_industri', 'badan_usaha.sub_cabang_industri', '=', 'sub_cabang_industri.id')
                    ->leftJoin('kbli', 'badan_usaha.id_kbli', '=', 'kbli.id')
                    ->leftJoin('data_tambahan', 'badan_usaha.id', '=', 'data_tambahan.id_badan_usaha')
                    ->where("nik", Auth::user()->nik)
                    ->get($this->fieldBadanUsaha);
                // dd($BadanUsaha);

                foreach ($badan_usaha as $key => &$item) {
                    $userDataProgress[$key] = 0;
                    $totalnull = 0;
                    foreach ($this->fields as &$field) {

                        if (!isset($item->{$field})) {
                            $totalnull += 1;
                        }
                    }
                    $userDataProgress[$key] = ((count($this->fields) - ($totalnull - 9)) / (count($this->fields))) * 100;
                }

                if ($id != "") {

                    $badan_usaha = BadanUsaha::leftJoin('badan_usaha_documents', 'badan_usaha.id', '=', 'badan_usaha_documents.id_badan_usaha')
                        ->leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
                        ->leftJoin('kecamatan', 'badan_usaha.kecamatan', '=', 'kecamatan.id')
                        ->leftJoin('kelurahan', 'badan_usaha.kelurahan', '=', 'kelurahan.id')
                        ->leftJoin('cabang_industri', 'badan_usaha.cabang_industri', '=', 'cabang_industri.id')
                        ->leftJoin('sub_cabang_industri', 'badan_usaha.sub_cabang_industri', '=', 'sub_cabang_industri.id')
                        ->leftJoin('kbli', 'badan_usaha.id_kbli', '=', 'kbli.id')
                        ->leftJoin('data_tambahan', 'badan_usaha.id', '=', 'data_tambahan.id_badan_usaha')
                        ->where("badan_usaha.id", $id)
                        ->get($this->fieldBadanUsaha);
                    // dd($badan_usaha[0]);
                }
                if ($subPages != "") {
                    // dd($userDataProgress);
                    // dd($totalnull);
                    // dd(count($this->fields));
                    return view("pages.member.{$subPages}", ['BadanUsaha' => $badan_usaha, 'userDataProgress' => $userDataProgress, 'pages' => $pages, 'fields' => $this->fields, 'Notifikasi' => $Notifikasi, 'User' => Auth::user()]);
                } else {
                    $params = ['BadanUsaha' => $BadanUsaha, 'userDataProgress' => $userDataProgress, 'pages' => $pages, 'fields' => $this->fields];

                    if ($pages == "kartu") {
                        $kabupaten = Kabupaten::find($BadanUsaha[0]->id_kabupaten);
                        $CabangIndustri = CabangIndustri::where('name', $BadanUsaha[0]->cabang_industri)->first();
                        $BadanUsaha[0]->kabupaten = $kabupaten ? $kabupaten->name : null;
                        $BadanUsaha[0]->id_cabang_industri = $CabangIndustri ? $CabangIndustri->id : null;
                        // dd($BadanUsaha);
                        $params = ['BadanUsaha' => $BadanUsaha];
                    }
                    if ($pages == "downloadKartu") {
                        $kabupaten = Kabupaten::find($BadanUsaha[0]->id_kabupaten);
                        $CabangIndustri = CabangIndustri::where('name', $BadanUsaha[0]->cabang_industri)->first();
                        $BadanUsaha[0]->kabupaten = $kabupaten ? $kabupaten->name : null;
                        $BadanUsaha[0]->id_cabang_industri = $CabangIndustri ? $CabangIndustri->id : null;

                        $params = ['BadanUsaha' => $BadanUsaha];
                    }

                    if ($pages == "PengajuanDana") {
                        $PengajuanDana = PengajuanDana::leftJoin('users', 'pengajuan_dana.id_instansi', '=', 'users.id')
                            ->leftJoin('instansi', 'pengajuan_dana.id_instansi', '=', 'instansi.user_id')
                            ->select("pengajuan_dana.id as id", "pengajuan_dana.*", "pengajuan_dana.status as status", "instansi.nama")
                            ->where('pengajuan_dana.user_id', Auth::id())->orderBy('pengajuan_dana.created_at', 'desc')->get();
                        $BadanUsaha = BadanUsaha::leftJoin('produk', 'badan_usaha.id', '=', 'produk.id_badan_usaha')
                            ->select("badan_usaha.id as id", "badan_usaha.*", "produk.*")
                            ->where('nik', Auth::user()->nik)->get();


                        $JumlahPinjaman = JumlahPinjaman::all();
                        $JangkaWaktu = JangkaWaktu::all();
                        $SimulasiAngsuran = SimulasiAngsuran::all();
                        $Instansi = Instansi::all();
                        $DataPendukung = DataPendukung::where('id_badan_usaha', $BadanUsaha[0]->id)->first();
                        // dd($BadanUsaha);


                        $params = [
                            'PengajuanDana' => $PengajuanDana,
                            'BadanUsaha' => $BadanUsaha,
                            'JumlahPinjaman' => $JumlahPinjaman,
                            'JangkaWaktu' => $JangkaWaktu,
                            'SimulasiAngsuran' => $SimulasiAngsuran,
                            'Instansi' => $Instansi,
                            'DataPendukung' => $DataPendukung,

                        ];
                    }
                    if ($pages == "produk") {

                        $BadanUsaha = BadanUsaha::where('nik', Auth::user()->nik)->get();
                        $Produk = Produk::where('id_badan_usaha', $BadanUsaha[0]->id)->get();
                        // dd($Produk);

                        $params = ['Produk' => $Produk, 'BadanUsaha' => $BadanUsaha];
                    }
                    if ($pages == "settingBadanUsaha") {

                        $BadanUsaha = BadanUsaha::where('nik', Auth::user()->nik)->get();

                        $params = [
                            'BadanUsaha' => $BadanUsaha,
                            'Kabupaten' => Kabupaten::all(),
                            'Kecamatan' => Kecamatan::all(),
                            'Kelurahan' => Kelurahan::all(),
                            'CabangIndustri' => CabangIndustri::all(),
                            'SubCabangIndustri' => SubCabangIndustri::all(),
                            'Kbli' => Kbli::all(),
                        ];
                    }

                    if ($pages == "suratRekomendasi") {

                        $BadanUsaha = BadanUsaha::where('nik', Auth::user()->nik)->get();
                        $PengajuanDana = PengajuanDana::leftJoin('users', 'pengajuan_dana.id_instansi', '=', 'users.id')
                            ->leftJoin('instansi', 'pengajuan_dana.id_instansi', '=', 'instansi.user_id')
                            ->select("pengajuan_dana.id as id", "instansi.*", "pengajuan_dana.*")
                            ->where('pengajuan_dana.user_id', Auth::id())->where('pengajuan_dana.status', "Menunggu")
                            ->where('pengajuan_dana.alasan', 'LIKE', "%Dinas Perindustrian%")->orderBy('pengajuan_dana.created_at', 'desc')->first();
                        $surat = Surat::find(1);

                        // dd($PengajuanDana);
                        $params = [
                            'BadanUsaha' => $BadanUsaha,
                            'PengajuanDana' => $PengajuanDana,
                            'Surat' => $surat,
                        ];
                    }

                    if ($pages == "downloadSurat") {

                        $BadanUsaha = BadanUsaha::where('nik', Auth::user()->nik)->get();
                        $PengajuanDana = PengajuanDana::leftJoin('users', 'pengajuan_dana.id_instansi', '=', 'users.id')
                            ->leftJoin('instansi', 'pengajuan_dana.id_instansi', '=', 'instansi.user_id')
                            ->select("pengajuan_dana.id as id", "instansi.*", "pengajuan_dana.*")
                            ->where('pengajuan_dana.user_id', Auth::id())->where('pengajuan_dana.status', "Menunggu")
                            ->where('pengajuan_dana.alasan', 'LIKE', "%Dinas Perindustrian%")->orderBy('pengajuan_dana.created_at', 'desc')->first();
                        // $PengajuanDana = PengajuanDana::where('user_id', Auth::id())->orderBy('created_at', 'desc')->first();
                        // dd($PengajuanDana);
                        $surat = Surat::find(1);
                        $params = [
                            'BadanUsaha' => $BadanUsaha,
                            'PengajuanDana' => $PengajuanDana,
                            'Surat' => $surat,
                        ];
                    }

                    if ($pages == "settingAkun") {
                        $BadanUsaha = BadanUsaha::where('nik', Auth::user()->nik)->get();

                        $params = [
                            'BadanUsaha' => $BadanUsaha
                        ];
                    }
                    $params['Notifikasi'] = $Notifikasi;
                    $params['userDataProgress'] = $userDataProgress;
                    $params['pages'] = $pages;
                    $params['User'] = Auth::user();

                    return view("pages.member.{$pages}", $params);
                }
            }
        } else {
            return redirect('/login');
        }
    }
    function ajukan_dana(Request $r)
    {
        // dd($r);
        $instansi = User::find($r->input("instansi"));
        $jumlah_dana = null;
        $waktu_pinjaman = null;
        // dd($r->input("jumlah_dana_bank") != null);

        if ($r->input("jumlah_dana_bank") != null) {
            $JumlahPinjaman = JumlahPinjaman::find($r->input("jumlah_dana_bank"));
            $JangkaWaktu = JangkaWaktu::find($r->input("jangka_waktu_bank"));
            $jumlah_dana = $JumlahPinjaman->jumlah;
            $waktu_pinjaman = $JangkaWaktu->waktu;
        } else {
            $jumlah_dana = $r->input("jumlah_dana");
            $waktu_pinjaman = $r->input("waktu_pinjaman");
        }
        // dd($waktu_pinjaman);

        $pengajuanDana = new PengajuanDana([
            'id' => (string) Str::uuid(),
            'id_instansi' => $r->input("instansi"),
            'user_id' => Auth::id(),
            'status' => "Menunggu",
            'jumlah_dana' => $jumlah_dana,
            'waktu_pinjaman' => $waktu_pinjaman,
            'alasan' => $r->input("alasan"),
            'instansi' => $instansi->role,
            'jenis_pengajuan' => $r->input("jenis_pengajuan"),
        ]);
        // dd($pengajuanDana);

        $BadanUsaha = BadanUsaha::where('nik', Auth::user()->nik)->first();


        $notifikasi = new Notifikasi([
            'id' => (string) Str::uuid(),
            "nik" => "00000000",
            'deskripsi' => "Pembiayaan Usaha dari " . $BadanUsaha->nama_usaha,
            'user_role' => "ADMIN",
        ]);

        // dd($notifikasi);

        // BUAT USER
        // dd($BadanUsaha->nama_usaha);

        $notifikasi->save();
        if ($instansi == "BANK") {
            $notifikasi = new Notifikasi([
                'id' => (string) Str::uuid(),
                'nik' => "33333333",
                'deskripsi' => "Pembiayaan Usaha dari " . $BadanUsaha->nama_usaha,
                'user_role' => "OJK",
            ]);

            $notifikasi->save();
        }

        $pengajuanDana->save();
        return redirect('/member/PengajuanDana');
        // $PengajuanDana = PengajuanDana::where('user_id',Auth::id())->get();

        // return view('pages.member.PengajuanDana', ['PengajuanDana' => $PengajuanDana,'msg' => "Dana Telah di ajukan , menunggu verifiaksi admin"]);
    }
    function ajukan_produk(Request $r)
    {
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
        $BadanUsaha = BadanUsaha::where('nik', Auth::user()->nik)->first();
        $cek_sertifikat_halal = str_contains(json_encode($sertifikat_halal), "null");
        $cek_sertifikat_haki = str_contains(json_encode($sertifikat_haki), "null");
        $cek_sertifikat_sni = str_contains(json_encode($sertifikat_sni), "null");



        $data = array(
            'id' => (string) Str::uuid(),
            'id_badan_usaha' => $BadanUsaha->id,
            'sertifikat_halal' => $cek_sertifikat_halal ? null : json_encode($sertifikat_halal),
            'sertifikat_haki' => $cek_sertifikat_haki ? null : json_encode($sertifikat_haki),
            'sertifikat_sni' => $cek_sertifikat_sni ? null : json_encode($sertifikat_sni),
            'nama' => $r->input("nama"),
            'harga' => $r->input("harga"),
            'deskripsi' => $r->input("deskripsi"),
        );


        if (!empty($r->file('foto'))) {
            $file = $r->file('foto');
            $extension = $file->getClientOriginalExtension();
            $BadanUsaha = BadanUsaha::where('nik', Auth::user()->nik)->first();
            $filename = $BadanUsaha->id . '-' . time() . '.' . $extension;

            $file->move(public_path('images/'), $filename);
            $data['foto'] = '/images/' . $filename;
        }
        // dd($data);




        $produk = new Produk($data);

        // BUAT produk
        $produk->save();
        return redirect('/member/produk');

        // $BadanUsaha = BadanUsaha::where('nik',Auth::user()->nik)->first();
        // $Produk = Produk::where('id_badan_usaha',$BadanUsaha->id)->get();

        // return view('pages.member.produk', ['Produk' => $Produk,'msg' => "produk Telah di atambahakan"]);
    }
    function hapus_produk($id)
    {
        $res = Produk::where('id', $id)->delete();

        return redirect('/member/produk');
    }

    function ganti_foto(Request $r)
    {

        $filename = null;
        $User = User::find(Auth::id());


        if (!empty($r->file('foto'))) {
            $file = $r->file('foto');
            $extension = $file->getClientOriginalExtension();
            $filename = Auth::id() . '.' . $extension;

            $file->move(public_path('images/'), $filename);
            // $data['foto']= 'images/'.$filename;

        }
        // dd($data);




        $User->foto = 'images/' . $filename;

        // BUAT produk
        $User->save();
        return redirect('/member/kartu');
    }
    function uploadDataPendukung(Request $r)
    {
        // dd($r);
        $filenameKTP = null;
        $filenameKK = null;
        $User = User::find(Auth::id());
        $BadanUsaha = BadanUsaha::where('nik', $User->nik)->first();
        // $DataPendukung = DataPendukung::where('id_badan_usaha',$BadanUsaha->id)->first();
        // dd($r);


        // if (!empty($DataPendukung)) {
        //     dd("data ada");
        // }else{
        //     dd("data kosong");

        // }


        if (!empty($r->file('ktp'))) {
            $file = $r->file('ktp');
            $extension = $file->getClientOriginalExtension();
            $filenameKTP = Auth::id() . '_ktp.' . $extension;

            $file->move(public_path('data_tambahan/'), $filenameKTP);
            // $data['foto']= 'images/'.$filename;

        }
        // dd($data);



        if (!empty($r->file('kk'))) {
            $file = $r->file('kk');
            $extension = $file->getClientOriginalExtension();
            $filenameKK = Auth::id() . '_kk.' . $extension;

            $file->move(public_path('data_tambahan/'), $filenameKK);
            // $data['foto']= 'images/'.$filename;

        }
        // dd($data);


        // dd($filenameKTP);
        // dd($filenameKK);

        $data = array(
            'id' => (string) Str::uuid(),
            'id_badan_usaha' => $BadanUsaha->id,
            'ktp' => 'data_tambahan/' . $filenameKTP,
            'kk' => 'data_tambahan/' . $filenameKK,
        );
        // dd($data);
        $DataPendukung = new DataPendukung($data);
        $DataPendukung->save();


        return redirect('member/PengajuanDana');
    }
}
