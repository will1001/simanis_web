<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BadanUsaha;
use App\Models\CabangIndustri;
use App\Models\SubCabangIndustri;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    private $fields = [
        'badan_usaha.nama_direktur',
        'badan_usaha.alamat_lengkap',
        'badan_usaha.nama_usaha',
    ];
    private $orWhere = [
        'badan_usaha.alamat_lengkap',
        'badan_usaha.nama_usaha',
    ];

    private function filterGrafikindustri($title, $data, $chartId, $kabupaten, $cabangIndustri)
    {

        if (str_contains($title, 'Legalitas Usaha (Formal)')) {
            $data = $data->where('formal_informal', '=', 'FORMAL');
        } else  if (str_contains($title, 'Legalitas Usaha (Informal)')) {
            $data = $data->where('formal_informal', '=', 'INFORMAL');
        } else  if (str_contains($title, 'Legalitas Usaha (Informal)')) {
            $data = $data->where('formal_informal', '=', 'INFORMAL');
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

        $BadanUsaha = BadanUsaha::join('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
            ->get();

        return view('Home', [
            'BadanUsaha' => $BadanUsaha,
            'kabupaten' => Kabupaten::all(),
            'Kecamatan' => Kecamatan::all(),
            'Kelurahan' => Kelurahan::all(),
            'cabangIndustri' => CabangIndustri::all(),
            'subCabangIndustri' => SubCabangIndustri::all(),
        ]);
    }

    public function chartDetail($filter, $chartId, $title)
    {
        $filter = json_decode($filter);
        $kabupaten = Kabupaten::all()->toArray();
        $cabangIndustri = CabangIndustri::all()->toArray();

        $title = explode(":", $title)[0];
        $title = substr($title, 0, strlen($title) - 1);

        $data = BadanUsaha::join('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id');
        if (str_contains($title, 'Industri Kecil')) {
            $data = $data->where('investasi_modal', '<=', 1000000);
        } else if (str_contains($title, 'Industri Menengah')) {
            $data = $data->whereBetween('investasi_modal', [1000000 + 1, 15000000 - 1]);
        } else if (str_contains($title, 'Industri Besar')) {
            $data = $data->where('investasi_modal', '>=', 15000000);
        } else if ($chartId == 4 || $chartId == 7 || $chartId == 10 || $chartId == 13 || $chartId == 16) {

            $data = $data->where('investasi_modal', '<=', 1000000);
            $this->filterGrafikindustri(
                $title,
                $data,
                $chartId,
                $kabupaten,
                $cabangIndustri
            );
        } else if ($chartId == 5 || $chartId == 8 || $chartId == 11 || $chartId == 14 || $chartId == 17) {
            $data = $data->whereBetween('investasi_modal', [1000000 + 1, 15000000 - 1]);

            $this->filterGrafikindustri(
                $title,
                $data,
                $chartId,
                $kabupaten,
                $cabangIndustri
            );
        } else if ($chartId == 6 || $chartId == 9 || $chartId == 12 || $chartId == 15 || $chartId == 18) {
            $data = $data->where('investasi_modal', '>=', 15000000);
            $this->filterGrafikindustri(
                $title,
                $data,
                $chartId,
                $kabupaten,
                $cabangIndustri
            );
        }

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
        $title = explode(":", $title)[0];
        $keyword = $r->keyword;

        $data = BadanUsaha::join('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id');
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
}
