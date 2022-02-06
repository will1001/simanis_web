<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\BadanUsaha;
use App\Models\SlideShow;
use App\Models\Survei;
use App\Imports\BadanUsahaImport;
use App\Exports\BadanUsahaExport;
use Illuminate\Support\Facades\Auth;

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
        'badan_usaha.formal_informal',
        'badan_usaha.nib_tahun',
        'badan_usaha.nomor_sertifikat_halal_tahun',
        'badan_usaha.sertifikat_merek_tahun',
        'badan_usaha.nomor_test_report_tahun',
        'badan_usaha.sni_tahun',
        'badan_usaha.jenis_usaha',
        'badan_usaha.cabang_industri',
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
    public function index($pages = "tabel")
    {
        if (Auth::check()) {
            $BadanUsaha = BadanUsaha::join('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
                ->paginate(100, $this->fields);


            return view(
                "pages.admin.{$pages}",
                [
                    'BadanUsaha' => $BadanUsaha,
                    'SlideShow' => SlideShow::all(),
                    'Survei' => Survei::all(),
                    'keyword' => "",
                    'pages' => $pages
                ]
            );
        } else {
            return redirect('/login');
        }
    }


    public function searchBadanUsaha(Request $request)
    {
        $keyword = $request->input('keyword');

        $BadanUsaha = BadanUsaha::join('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
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
        // dd($r->file('slide'));

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
    //
}
