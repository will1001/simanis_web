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
    private $fields = [
        'badan_usaha.nama_direktur',
        'badan_usaha.alamat_lengkap',
        'badan_usaha.nama_usaha',
    ];
    private $orWhere = [
        'badan_usaha.alamat_lengkap',
        'badan_usaha.nama_usaha',
    ];

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
        $filter = json_decode($r->chartDetailData);
        $title = $r->title;
        $title = explode(":", $title)[0];

        $data = BadanUsaha::join('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id');
        if (str_contains($title, 'Industri Kecil')) {
            $data = $data->where('investasi_modal', '<', 1000000);
        } else if (str_contains($title, 'Industri Menengah')) {
            $data = $data->whereBetween('investasi_modal', [1000000+1, 15000000-1]);
        } else if (str_contains($title, 'Industri Besar')) {
            $data = $data->where('investasi_modal', '>', 15000000);
        }

        foreach ($filter as &$field) {
            
            $data = $data->Where($field->prop, '=', "{$field->value}");
        }

        // $data = $data->paginate(50, $this->fields);
        $data = $data->get();


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
