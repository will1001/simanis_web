<?php

namespace App\Http\Controllers;

use App\Models\BadanUsaha;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\CabangIndustri;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class FormController extends Controller
{
    function badan_usaha(Request $r, $userType, $id = null)
    {
        if ($r->isMethod('get')) {
            $badan_usaha = BadanUsaha::find(null);
            if ($id != null) {
                $badan_usaha = BadanUsaha::find($id);
            }

            return view('pages.form.badan_usaha', [
                'userType' => $userType, 
                'badan_usaha' => $badan_usaha, 
                'pages' => 'tabel',
                'Kabupaten' => Kabupaten::all(),
                'Kecamatan' => Kecamatan::all(),
                'Kelurahan' => Kelurahan::all(),
                'CabangIndustri' => CabangIndustri::all(),
            ]);
        } else {

            $badan_usaha = null;

            if ($id != null) {
                $badan_usaha = BadanUsaha::find($id);
            } else {
                $badan_usaha = new BadanUsaha;
                $r->merge([
                    'id' => Str::uuid(36),
                ]);
            }

            $input = $r->all();
            $badan_usaha->fill($input)->save();

            return redirect('/admin/tabel');
        }
    }
}
