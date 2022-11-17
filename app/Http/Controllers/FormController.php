<?php

namespace App\Http\Controllers;

use App\Models\BadanUsaha;
use App\Models\BadanUsahaDocuments;
use App\Models\DataPendukung;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\CabangIndustri;
use App\Models\SubCabangIndustri;
use App\Models\User;
use App\Models\Kbli;
use App\Models\Notifikasi;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



use Illuminate\Http\Request;

class FormController extends Controller
{
    private $fieldBadanUsaha = [
        'badan_usaha.id as id',
        'badan_usaha_documents.id as badan_usaha_documents_id',
        'badan_usaha.nik',
        'badan_usaha.nama_direktur',
        'badan_usaha.id_kabupaten as kabupaten',
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
        'cabang_industri.id as cabang_industri',
        'sub_cabang_industri.id as sub_cabang_industri',
        'kbli.id as id_kbli',
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
        'badan_usaha.merek_usaha',
        'data_tambahan.ktp',
        'data_tambahan.kk',

    ];
    function badan_usaha(Request $r, $userType, $id = null)
    {

        if ($r->isMethod('get')) {
            $badan_usaha = BadanUsaha::find(null);
            if ($id != null) {
                $badan_usaha = BadanUsaha::leftJoin('badan_usaha_documents', 'badan_usaha.id', '=', 'badan_usaha_documents.id_badan_usaha')
                    ->leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
                    ->leftJoin('cabang_industri', 'badan_usaha.cabang_industri', '=', 'cabang_industri.id')
                    ->leftJoin('sub_cabang_industri', 'badan_usaha.sub_cabang_industri', '=', 'sub_cabang_industri.id')
                    ->leftJoin('kbli', 'badan_usaha.id_kbli', '=', 'kbli.id')
                    ->leftJoin('data_tambahan', 'badan_usaha.id', '=', 'data_tambahan.id_badan_usaha')
                    ->where("badan_usaha.id", $id)
                    ->get($this->fieldBadanUsaha);
            }
            // dd($badan_usaha);

            $Notifikasi = Notifikasi::where("user_role", "MEMBER")->where("nik", Auth::user()->nik)->where("status", "not read")->get();


            return view('pages.form.badan_usaha', [
                'userType' => $userType,
                'BadanUsaha' => $badan_usaha,
                'Notifikasi' => $Notifikasi,
                'pages' => $userType == 'admin' ? 'admin' : 'dashboard',
                'Kabupaten' => Kabupaten::all(),
                'Kecamatan' => Kecamatan::all(),
                'Kelurahan' => Kelurahan::all(),
                'CabangIndustri' => CabangIndustri::all(),
                'SubCabangIndustri' => SubCabangIndustri::all(),
                'Kbli' => Kbli::all(),
                'User' => Auth::user(),
            ]);
        } else {

            $badan_usaha = null;
            $badan_usaha_documents = null;
            $data_tambahan = null;

            if ($id != null) {
                $badan_usaha = BadanUsaha::find($id);
                $badan_usaha_documents = BadanUsahaDocuments::where("id_badan_usaha", $badan_usaha->id);
                $data_tambahan = DataPendukung::where("id_badan_usaha", $badan_usaha->id);

                if (!empty($badan_usaha_documents)) {
                    $badan_usaha_documents = new BadanUsahaDocuments([
                        'id' =>  Str::uuid(36),
                        'id_badan_usaha' => $badan_usaha->id,
                        'nib_file' => '',
                        'bentuk_usaha_file' => '',
                        'sertifikat_halal_file' => '',
                        'sertifikat_sni_file' => '',
                        'sertifikat_merek_file' => ''
                    ]);
                    $data_tambahan = new DataPendukung([
                        'id' =>  Str::uuid(36),
                        'id_badan_usaha' => $badan_usaha->id,
                        'ktp' => '',
                        'kk' => ''
                    ]);
                }
            } else {
                $badan_usaha = new BadanUsaha;

                $r->merge([
                    'id' => Str::uuid(36),
                ]);

                $badan_usaha_documents = new BadanUsahaDocuments([
                    'id' =>  Str::uuid(36),
                    'id_badan_usaha' => $r->input('id'),
                    'nib_file' => '',
                    'bentuk_usaha_file' => '',
                    'sertifikat_halal_file' => '',
                    'sertifikat_sni_file' => '',
                    'sertifikat_merek_file' => ''
                ]);
                $data_tambahan = new DataPendukung([
                    'id' =>  Str::uuid(36),
                    'id_badan_usaha' => $r->input('id'),
                    'ktp' => '',
                    'kk' => ''
                ]);

                $User = User::where('nik', $r->input('nik'))->first();
                if (empty($User)) {
                    $users = new User([
                        'id' => (string) Str::uuid()->getHex(),
                        'nik' => $r->input('nik'),
                        'password' => Hash::make('12345678'),
                    ]);
                    $users->save();
                }
            }



            // dd($r);

            if ($r->file('foto_alat_produksi_file') != null) {
                $ext = $r->file('foto_alat_produksi_file')->getClientOriginalExtension();
                $name1 = 'foto_alat_produksi' . $id . '.' . $ext;

                $r->file('foto_alat_produksi_file')->storeAs('public/foto_alat_produksi', $name1);




                $r->merge([
                    'foto_alat_produksi' => '/storage/foto_alat_produksi/' . $name1,
                ]);
            };
            if ($r->file('foto_ruang_produksi_file') != null) {

                $ext2 = $r->file('foto_ruang_produksi_file')->getClientOriginalExtension();
                $name2 = 'foto_ruang_produksi' . $id . '.' . $ext2;


                $r->file('foto_ruang_produksi_file')->storeAs('public/foto_ruang_produksi', $name2);

                $r->merge([
                    'foto_ruang_produksi' => '/storage/foto_ruang_produksi/' . $name2,
                ]);
                // $input->foto_alat_produksi = '/storage/foto_alat_produksi/' . $name1;
                // $input->foto_ruang_produksi = '/storage/foto_ruang_produksi/' . $name2;
            };
            $input = $r->all();
            // dd($input);

            if ($r->file('bentuk_usaha_file') != null) {
                $ext = $r->file('bentuk_usaha_file')->getClientOriginalExtension();
                $name1 = 'bentuk_usaha_file' . $id . '.' . $ext;

                $r->file('bentuk_usaha_file')->storeAs('public/dokumen', $name1);

                $badan_usaha_documents->bentuk_usaha_file = '/storage/dokumen/' . $name1;
            };
            if ($r->file('nib_file') != null) {
                $ext = $r->file('nib_file')->getClientOriginalExtension();
                $name1 = 'nib_file' . $id . '.' . $ext;

                $r->file('nib_file')->storeAs('public/dokumen', $name1);

                $badan_usaha_documents->nib_file = '/storage/dokumen/' . $name1;
            };
            if ($r->file('sertifikat_halal_file') != null) {
                $ext = $r->file('sertifikat_halal_file')->getClientOriginalExtension();
                $name1 = 'sertifikat_halal_file' . $id . '.' . $ext;

                $r->file('sertifikat_halal_file')->storeAs('public/dokumen', $name1);

                $badan_usaha_documents->sertifikat_halal_file = '/storage/dokumen/' . $name1;
            };
            if ($r->file('sertifikat_merek_file') != null) {
                $ext = $r->file('sertifikat_merek_file')->getClientOriginalExtension();
                $name1 = 'sertifikat_merek_file' . $id . '.' . $ext;

                $r->file('sertifikat_merek_file')->storeAs('public/dokumen', $name1);

                $badan_usaha_documents->sertifikat_merek_file = '/storage/dokumen/' . $name1;
            };
            if ($r->file('sertifikat_sni_file') != null) {
                $ext = $r->file('sertifikat_sni_file')->getClientOriginalExtension();
                $name1 = 'sertifikat_sni_file' . $id . '.' . $ext;

                $r->file('sertifikat_sni_file')->storeAs('public/dokumen', $name1);

                $badan_usaha_documents->sertifikat_sni_file = '/storage/dokumen/' . $name1;
            };
            if ($r->file('ktp') != null) {
                $ext = $r->file('ktp')->getClientOriginalExtension();
                $name1 = 'ktp' . $id . '.' . $ext;

                $r->file('ktp')->storeAs('public/dokumen', $name1);

                $data_tambahan->ktp = '/storage/dokumen/' . $name1;
            };
            if ($r->file('kk') != null) {
                $ext = $r->file('kk')->getClientOriginalExtension();
                $name1 = 'kk' . $id . '.' . $ext;

                $r->file('kk')->storeAs('public/dokumen', $name1);

                $data_tambahan->kk = '/storage/dokumen/' . $name1;
            };


            // $r->file

            // dd($r->file('sertifikat_halal_file'));
            // dd($r->file('sertifikat_merek_file'));
            // dd($badan_usaha_documents);
            // dd($input);
            $input['investasi_modal'] = str_replace(',', '', $input['investasi_modal']);
            $input['jumlah_tenaga_kerja_pria'] = str_replace(',', '', $input['jumlah_tenaga_kerja_pria']);
            $input['jumlah_tenaga_kerja_wanita'] = str_replace(',', '', $input['jumlah_tenaga_kerja_wanita']);
            $input['kapasitas_produksi_perbulan'] = str_replace(',', '', $input['kapasitas_produksi_perbulan']);
            $input['nilai_produksi_perbulan'] = str_replace(',', '', $input['nilai_produksi_perbulan']);
            $input['nilai_bahan_baku_perbulan'] = str_replace(',', '', $input['nilai_bahan_baku_perbulan']);
            // dd($r->all());
            // dd($input);
            $badan_usaha->fill($input)->save();
            $badan_usaha_documents->save();
            $data_tambahan->save();


            if ($userType == 'admin') {
                return redirect('/admin/tabel');
            } else {
                return redirect('/member/dashboard');
            }
        }
    }

    function deleteBadanUsahaById($id = null)
    {
        $badan_usaha = BadanUsaha::find($id);

        $badan_usaha->delete();
        return redirect('/admin/tabel');
    }
}
