<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BadanUsaha;
use App\Models\CabangIndustri;
use App\Models\SubCabangIndustri;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;

class HomeController extends Controller
{
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

    public function chartDetail(Request $r)
    {
        $data = json_decode($r->chartDetailData);
        $title = $r->title;
        // $data = array_filter($data,function($k) {
        //     return $k->nama_direktur == "ARIS MUNANDAR";
        // });

        return view('pages.chartDetails', ['data' => $data, 'title' => $title, 'keyword' => '']);
    }

    public function chartDetailSearch(Request $r)
    {
        $keyword = $r->keyword;
        $data = json_decode($r->data);
        $data = array_filter($data, function ($k) use ($keyword) {
            return $k->nama_direktur == $keyword;
        });

        return view('pages.chartDetails', ['data' => $data, 'title' => '', 'keyword' => $keyword]);
    }
}
