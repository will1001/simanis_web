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
}
