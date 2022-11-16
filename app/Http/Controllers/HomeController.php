<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BadanUsaha;
use App\Models\SurveyChart;
use App\Models\CabangIndustri;
use App\Models\SubCabangIndustri;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Models\SlideShow;
use App\Models\User;
use App\Models\PengajuanDana;
use App\Models\Surat;


class HomeController extends Controller
{
    private $fields = [
        'badan_usaha.nama_direktur',
        'badan_usaha.alamat_lengkap',
        'badan_usaha.nama_usaha',
        'badan_usaha.jenis_usaha',
    ];
    private $orWhere = [
        'badan_usaha.alamat_lengkap',
        'badan_usaha.nama_usaha',
    ];

    private function filterGrafikindustri($title, $data, $chartId, $kabupaten, $cabangIndustri)
    {

        if (str_contains($title, 'Legalitas Usaha (Formal)')) {
            $data = $data->whereNotNull('nib_tahun');
        } else  if (str_contains($title, 'Legalitas Usaha (Informal)')) {
            $data = $data->whereNull('nib_tahun');
        } else  if ($chartId >= 6 && $chartId <= 8) {
            foreach ($kabupaten as $field) {
                if (str_contains(strtolower($field['name']), strtolower($title))) {
                    $data = $data->where('id_kabupaten', '=', $field['id']);
                }
            }
        } else  if ($chartId >= 9 && $chartId <= 11) {
            foreach ($cabangIndustri as $field) {
                if (str_contains(strtolower($field['name']), strtolower($title))) {
                    $data = $data->where('cabang_industri', '=', $field['name']);
                }
            }
        } else  if ($title == 'Memiliki Sertifikasi Halal') {
            $data = $data->whereNotNull('nomor_sertifikat_halal_tahun');
        } else  if ($title == 'Tidak Memiliki Sertifikasi Halal') {
            $data = $data->whereNull('nomor_sertifikat_halal_tahun');
        } else  if ($title == 'Memiliki Sertifikasi Merek') {
            $data = $data->whereNotNull('sertifikat_merek_tahun');
        } else  if ($title == 'Tidak Memiliki Sertifikasi Merek') {
            $data = $data->whereNull('sertifikat_merek_tahun');
        }
    }

    public function index()
    {

        // $data = BadanUsaha::join('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
        //     ->join('cabang_industri', 'badan_usaha.cabang_industri', '=', 'cabang_industri.id')
        //     ->join('sub_cabang_industri', 'badan_usaha.sub_cabang_industri', '=', 'sub_cabang_industri.id');

        // $BadanUsaha = BadanUsaha::join('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
        //     ->join('cabang_industri', 'badan_usaha.cabang_industri', '=', 'cabang_industri.id')
        //     ->join('sub_cabang_industri', 'badan_usaha.sub_cabang_industri', '=', 'sub_cabang_industri.id');

        // $BadanUsaha = BadanUsaha::join('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id');

        $BadanUsaha2 = BadanUsaha::leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
            ->leftJoin('cabang_industri', 'badan_usaha.cabang_industri', '=', 'cabang_industri.id')
            ->leftJoin('sub_cabang_industri', 'badan_usaha.sub_cabang_industri', '=', 'sub_cabang_industri.id')
            ->get();

        $industriKecil = BadanUsaha::leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
            ->leftJoin('cabang_industri', 'badan_usaha.cabang_industri', '=', 'cabang_industri.id')
            ->leftJoin('sub_cabang_industri', 'badan_usaha.sub_cabang_industri', '=', 'sub_cabang_industri.id')
            ->where('investasi_modal', '<=', 1000000)->get();
        $industriMenengah = BadanUsaha::leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
            ->leftJoin('cabang_industri', 'badan_usaha.cabang_industri', '=', 'cabang_industri.id')
            ->leftJoin('sub_cabang_industri', 'badan_usaha.sub_cabang_industri', '=', 'sub_cabang_industri.id')
            ->whereBetween('investasi_modal', [1000000 + 1, 15000000 - 1])->get();
        $industriBesar = BadanUsaha::leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
            ->leftJoin('cabang_industri', 'badan_usaha.cabang_industri', '=', 'cabang_industri.id')
            ->leftJoin('sub_cabang_industri', 'badan_usaha.sub_cabang_industri', '=', 'sub_cabang_industri.id')
            ->where('investasi_modal', '>=', 15000000)->get();
        $totalTenagaKerja = DB::table('badan_usaha')->leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
            ->leftJoin('cabang_industri', 'badan_usaha.cabang_industri', '=', 'cabang_industri.id')
            ->leftJoin('sub_cabang_industri', 'badan_usaha.sub_cabang_industri', '=', 'sub_cabang_industri.id')
            ->select(DB::raw('sum(jumlah_tenaga_kerja_pria)+sum(jumlah_tenaga_kerja_wanita) as total_tenaga_kerja'))->get();
        $totalIKMBaru = DB::table('badan_usaha')->leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
            ->leftJoin('cabang_industri', 'badan_usaha.cabang_industri', '=', 'cabang_industri.id')
            ->leftJoin('sub_cabang_industri', 'badan_usaha.sub_cabang_industri', '=', 'sub_cabang_industri.id')
            ->select(DB::raw('count(case when tahun_berdiri = YEAR(NOW()) then 1 end) as total_ikm_baru'))->get();
        $sertifikatHalal = BadanUsaha::leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
            ->leftJoin('cabang_industri', 'badan_usaha.cabang_industri', '=', 'cabang_industri.id')
            ->leftJoin('sub_cabang_industri', 'badan_usaha.sub_cabang_industri', '=', 'sub_cabang_industri.id')
            ->whereNotNull('nomor_sertifikat_halal_tahun')->get();
        $sertifikatHaki = BadanUsaha::leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
            ->leftJoin('cabang_industri', 'badan_usaha.cabang_industri', '=', 'cabang_industri.id')
            ->leftJoin('sub_cabang_industri', 'badan_usaha.sub_cabang_industri', '=', 'sub_cabang_industri.id')
            ->whereNotNull('sertifikat_merek_tahun')->get();
        $sertifikatSNI = BadanUsaha::leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
            ->leftJoin('cabang_industri', 'badan_usaha.cabang_industri', '=', 'cabang_industri.id')
            ->leftJoin('sub_cabang_industri', 'badan_usaha.sub_cabang_industri', '=', 'sub_cabang_industri.id')
            ->whereNotNull('sni_tahun')->get();
        $sertifikatTestReport = BadanUsaha::leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
            ->leftJoin('cabang_industri', 'badan_usaha.cabang_industri', '=', 'cabang_industri.id')
            ->leftJoin('sub_cabang_industri', 'badan_usaha.sub_cabang_industri', '=', 'sub_cabang_industri.id')
            ->whereNotNull('nomor_test_report_tahun')->get();
        $formal = BadanUsaha::leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
            ->leftJoin('cabang_industri', 'badan_usaha.cabang_industri', '=', 'cabang_industri.id')
            ->leftJoin('sub_cabang_industri', 'badan_usaha.sub_cabang_industri', '=', 'sub_cabang_industri.id')
            ->whereNotNull('nib_tahun')->get();
        $informal = BadanUsaha::leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
            ->leftJoin('cabang_industri', 'badan_usaha.cabang_industri', '=', 'cabang_industri.id')
            ->leftJoin('sub_cabang_industri', 'badan_usaha.sub_cabang_industri', '=', 'sub_cabang_industri.id')
            ->whereNull('nib_tahun')->get();

        //chartsurvei
        $surveyChartData =
            DB::table('survey_chart')
            ->select(DB::raw('
            count(case when deskripsi = "Sangat Puas" then 1 end) as sp,
            count(case when deskripsi = "Puas" then 1 end) as p,
            count(case when deskripsi = "Tidak Puas" then 1 end) as tp,
            count(case when deskripsi = "Sangat Tidak Puas" then 1 end) as stp
            '))
            ->get();

        // dd($informal);

        return view('Home', [
            'BadanUsaha' => $BadanUsaha2,
            'industriKecil' => $industriKecil,
            'industriMenengah' => $industriMenengah,
            'industriBesar' => $industriBesar,
            'totalTenagaKerja' => $totalTenagaKerja,
            'totalIKMBaru' => $totalIKMBaru,
            'sertifikatHalal' => $sertifikatHalal,
            'sertifikatHaki' => $sertifikatHaki,
            'sertifikatSNI' => $sertifikatSNI,
            'sertifikatTestReport' => $sertifikatTestReport,
            'formal' => $formal,
            'informal' => $informal,
            'surveyChartData' => $surveyChartData,
            'kabupaten' => Kabupaten::all(),
            'Kecamatan' => Kecamatan::all(),
            'Kelurahan' => Kelurahan::all(),
            'cabangIndustri' => CabangIndustri::all(),
            'subCabangIndustri' => SubCabangIndustri::all(),
            'SlideShow' => SlideShow::where("type", "website")->get(),
        ]);
    }

    public function chartDetail($chartId, $title, $filter_chart)
    {
        $filter = json_decode($filter_chart);
        $kabupaten = Kabupaten::all()->toArray();
        $cabangIndustri = CabangIndustri::all()->toArray();
        $yearNow = Carbon::now()->year;
        // $title = explode(":", $title)[0];
        // $title = substr($title, 0, strlen($title) - 1);

        $data = BadanUsaha::leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
            ->leftJoin('cabang_industri', 'badan_usaha.cabang_industri', '=', 'cabang_industri.id')
            ->leftJoin('sub_cabang_industri', 'badan_usaha.sub_cabang_industri', '=', 'sub_cabang_industri.id');

        if ($chartId == 2) {
            $data = $data->where('tahun_berdiri', $yearNow);
        } else if ($chartId == 3) {
            $data = $data->where('investasi_modal', '<=', 1000000);
        } else if ($chartId == 4) {
            $data = $data->whereBetween('investasi_modal', [1000000 + 1, 15000000 - 1]);
        } else if ($chartId == 5) {
            $data = $data->where('investasi_modal', '>=', 15000000);
        } else if ($chartId == 6) {
            $data = $data->whereNotNull('nomor_sertifikat_halal_tahun');
        } else if ($chartId == 7) {
            $data = $data->whereNotNull('sertifikat_merek_tahun');
        } else if ($chartId == 8) {
            $data = $data->whereNotNull('sni_tahun');
        } else if ($chartId == 9) {
            $data = $data->whereNotNull('nomor_test_report_tahun');
        } else if ($chartId == 10) {
            $data = $data->whereNotNull('nib_tahun');
        } else if ($chartId == 11) {
            $data = $data->whereNull('nib_tahun');
        }

        // if (str_contains($title, 'Industri Kecil')) {
        //     $data = $data->where('investasi_modal', '<=', 1000000);
        // } else if (str_contains($title, 'Industri Menengah')) {
        //     $data = $data->whereBetween('investasi_modal', [1000000 + 1, 15000000 - 1]);
        // } else if (str_contains($title, 'Industri Besar')) {
        //     $data = $data->where('investasi_modal', '>=', 15000000);
        // } else if ($chartId == 4 || $chartId == 7 || $chartId == 10 || $chartId == 13 || $chartId == 16) {

        //     $data = $data->where('investasi_modal', '<=', 1000000);
        //     $this->filterGrafikindustri(
        //         $title,
        //         $data,
        //         $chartId,
        //         $kabupaten,
        //         $cabangIndustri
        //     );
        // } else if ($chartId == 5 || $chartId == 8 || $chartId == 11 || $chartId == 14 || $chartId == 17) {
        //     $data = $data->whereBetween('investasi_modal', [1000000 + 1, 15000000 - 1]);

        //     $this->filterGrafikindustri(
        //         $title,
        //         $data,
        //         $chartId,
        //         $kabupaten,
        //         $cabangIndustri
        //     );
        // } else if ($chartId == 6 || $chartId == 9 || $chartId == 12 || $chartId == 15 || $chartId == 18) {
        //     $data = $data->where('investasi_modal', '>=', 15000000);
        //     $this->filterGrafikindustri(
        //         $title,
        //         $data,
        //         $chartId,
        //         $kabupaten,
        //         $cabangIndustri
        //     );
        // }

        foreach ($filter as &$field) {

            $data = $data->Where($field->prop, '=', "{$field->value}");
        }

        $data = $data->paginate(50, $this->fields);
        return view('pages.chartDetails', ['data' => $data, 'title' => $title, 'keyword' => '', 'filter' => $filter]);
    }

    public function chartDetailSearch(Request $r)
    {
        $filter = json_decode($r->filter);

        $title = $r->title;
        // $title = explode(":", $title)[0];
        $keyword = $r->keyword;

        $data = BadanUsaha::leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
            ->leftJoin('cabang_industri', 'badan_usaha.cabang_industri', '=', 'cabang_industri.id')
            ->leftJoin('sub_cabang_industri', 'badan_usaha.sub_cabang_industri', '=', 'sub_cabang_industri.id');
        if (str_contains($title, 'Industri Kecil')) {
            $data = $data->where('investasi_modal', '<', 1000000);
        } else if (str_contains($title, 'Industri Menengah')) {
            $data = $data->whereBetween('investasi_modal', [1000000, 15000000]);
        } else if (str_contains($title, 'Industri Besar')) {
            $data = $data->where('investasi_modal', '>', 15000000);
        }

        foreach ($filter as &$field) {
            $data = $data->where($field->prop, '=', "{$field->value}");
        }
        $data = $data->where('badan_usaha.nama_direktur', 'LIKE', "%{$keyword}%");
        foreach ($this->orWhere as &$field) {
            $data = $data->where($field, 'LIKE', "%{$keyword}%");
        }

        $data = $data->paginate(50, $this->fields);


        return view('pages.chartDetails', ['data' => $data, 'title' => $title, 'keyword' => $keyword, 'filter' => $filter]);
    }
    public function surveyChart(Request $r, $id = null)
    {


        $input = $r->Input('surveiChart');

        $surveyChart = SurveyChart::where('nik', $id)->first();
        // dd($surveyChart);
        // $surveyChart->fill($input)->save();
        if ($surveyChart == null) {
            $surveyChart = new SurveyChart;
            $surveyChart->id = (string) Str::uuid();
            $surveyChart->nik = $id;
        }
        $surveyChart->deskripsi = $input;

        $surveyChart->save();



        return back();
    }
    public function download_surat($user_id = null)
    {

        $User = User::find($user_id);
        $BadanUsaha = BadanUsaha::where('nik', $User->nik)->get();
        $PengajuanDana = PengajuanDana::where('user_id', $User->id)->orderBy('created_at', 'desc')->first();
        // dd($PengajuanDana);
        $surat = Surat::find(1);
        $params = [
            'BadanUsaha' => $BadanUsaha,
            'PengajuanDana' => $PengajuanDana,
            'Surat' => $surat,
        ];

        return view("pages.member.downloadSurat", $params);
    }
}
