<?php

namespace App\Http\Controllers;

use App\Models\BadanUsaha;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\CabangIndustri;
use App\Models\SubCabangIndustri;
use App\Models\Kbli;
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
                'SubCabangIndustri' => SubCabangIndustri::all(),
                'Kbli' => Kbli::all(),
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

            $ext = $r->file('foto_alat_produksi')->getClientOriginalExtension();
            $name1 = 'foto_alat_produksi' . $id . '.' . $ext;

            $r->file('foto_alat_produksi')->storeAs('public/foto_alat_produksi', $name1);

            $ext2 = $r->file('foto_ruang_produksi')->getClientOriginalExtension();
            $name2 = 'foto_ruang_produksi' . $id . '.' . $ext2;


            $r->file('foto_ruang_produksi')->storeAs('public/foto_ruang_produksi', $name2);

            $badan_usaha->foto_alat_produksi = '/storage/foto_alat_produksi/' . $name1;
            $badan_usaha->foto_ruang_produksi = '/storage/foto_ruang_produksi/' . $name2;

            $badan_usaha->fill($input)->save();


            return redirect('/admin/tabel');
        }
    }

    function deleteBadanUsahaById($id = null)
    {
        $badan_usaha = BadanUsaha::find($id);

        $badan_usaha->delete();
        return redirect('/admin/tabel');
    }
}
