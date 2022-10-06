<?php

namespace App\Http\Controllers;

use App\Models\BadanUsaha;
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


use Illuminate\Http\Request;

class FormController extends Controller
{
    function badan_usaha(Request $r, $userType, $id = null)
    {
        if ($r->isMethod('get')) {
            $badan_usaha = BadanUsaha::find(null);
            if ($id != null) {
                $badan_usaha = BadanUsaha::where("id",$id)->get();
            }
            // dd($badan_usaha);

        $Notifikasi = Notifikasi::where("user_role","MEMBER")->where("nik",Auth::user()->nik)->where("status","not read")->get();


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

            if ($id != null) {
                $badan_usaha = BadanUsaha::find($id);
            } else {
                $badan_usaha = new BadanUsaha;
                $r->merge([
                    'id' => Str::uuid(36),
                ]);
                $User=User::where('nik',$r->input('nik'))->first();
                if(empty($User)){
                    $users = new User([
                        'id' => (string) Str::uuid()->getHex(),
                        'nik' => $r->input('nik'),
                        'password' => Hash::make('12345678'),
                    ]);
                    $users->save();

                }
            }

            $input = $r->all();

            if ($r->file('foto_alat_produksi_file') != null && $r->file('foto_ruang_produksi_file') != null) {
                $ext = $r->file('foto_alat_produksi_file')->getClientOriginalExtension();
                $name1 = 'foto_alat_produksi' . $id . '.' . $ext;

                $r->file('foto_alat_produksi_file')->storeAs('public/foto_alat_produksi', $name1);

                $ext2 = $r->file('foto_ruang_produksi_file')->getClientOriginalExtension();
                $name2 = 'foto_ruang_produksi' . $id . '.' . $ext2;


                $r->file('foto_ruang_produksi_file')->storeAs('public/foto_ruang_produksi', $name2);

                
                $badan_usaha->foto_alat_produksi = '/storage/foto_alat_produksi/' . $name1;
                $badan_usaha->foto_ruang_produksi = '/storage/foto_ruang_produksi/' . $name2;
            };
            
            // dd($input);
            $badan_usaha->fill($input)->save();

            if($userType == 'admin'){
                return redirect('/admin/tabel');
            }else{
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
