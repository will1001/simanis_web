<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Models\BadanUsaha;
use App\Models\Kabupaten;
use App\Models\Notifikasi;
use App\Models\Produk;
use App\Models\KabupatenNTBMall;
use App\Models\KecamatanNTBMall;
use App\Models\KelurahanNTBMall;
use App\Models\KategoriNTBMall;
use App\Models\SubKategoriNTBMall;
use App\Models\TokoNTBMall;
use App\Models\UserNTBMall;
use Illuminate\Support\Str;



class PerdaganganController extends Controller
{
    function index($pages = "dashboard", $subPages = "", $id = "")
    {
        $Notifikasi = Notifikasi::where("user_role", "PERDAGANGAN")->where("nik", Auth::user()->nik)->where("status", "not read")->get();

        if (Auth::check()) {
            if (Auth::user()->role === "ADMIN") {
                return redirect('/admin/tabel');
            } else if (Auth::user()->role === "BANK") {
                return redirect('/perbankan/dashboard');
            } else if (Auth::user()->role === "KOPERASI") {
                return redirect('/koperasi/daftarPengajuanDana');
            } else if (Auth::user()->role === "IKM") {
                return redirect('/member/dashboard');
            } else if (Auth::user()->role === "OJK") {
                return redirect('/ojk/dashboard');
            } else {
                if ($id != "") {
                    $BadanUsaha = BadanUsaha::find($id);
                }
                if ($subPages != "") {
                    $params = [
                        'pages' => $pages,
                        'Notifikasi' => $Notifikasi,
                        'User' => Auth::user()
                    ];



                    if ($subPages == "formTambahToko") {
                        $Kabupaten = KabupatenNTBMall::all();
                        $Kecamatan = KecamatanNTBMall::all();
                        $Kelurahan = KelurahanNTBMall::all();
                        $Provinsi = [];
                        $ProvinsiTemp = [
                            (object)array(
                                'id' => '22',
                                'name' => 'Nusa Tenggara Barat'
                            ),
                        ];
                        $Courier = [
                            (object)array(
                                'id' => 'gojek',
                                'name' => 'Gojek'
                            ),
                            (object)array(
                                'id' => 'grab',
                                'name' => 'Grab'
                            ),
                            (object)array(
                                'id' => 'jne',
                                'name' => 'JNE'
                            ),
                            (object)array(
                                'id' => 'jnt',
                                'name' => 'JNT'
                            ),
                            (object)array(
                                'id' => 'lion',
                                'name' => 'Lion Parcel'
                            ),
                            (object)array(
                                'id' => 'sicepat',
                                'name' => 'SiCepat'
                            ),

                        ];

                        foreach ($ProvinsiTemp as $key => $item) {
                            $Provinsi[$key]['id'] = $item->id;
                            $Provinsi[$key]['name'] = $item->name;
                        }




                        // $Provinsi[0]['id'] = "22";
                        // $Provinsi[0]['name'] = "Nusa Tenggara Barat";
                        // dd($Provinsi);
                        $params['Provinsi'] = $Provinsi;
                        $params['Courier'] = $Courier;
                        $params['Kabupaten'] = $Kabupaten;
                        $params['Kecamatan'] = $Kecamatan;
                        $params['Kelurahan'] = $Kelurahan;
                    }

                    return view("pages.perdagangan.{$subPages}", $params);
                } else {

                    // dd($BadanUsaha);
                    $params = [];

                    if ($pages == "dashboard") {
                        $Produk = Produk::leftJoin('badan_usaha', 'produk.id_badan_usaha', '=', 'badan_usaha.id')->get();
                        $params = ['Produk' => $Produk];
                        // dd($Produk);
                    }

                    if ($pages == "produkNTBMall") {
                    }
                    if ($pages == "daftarToko") {
                        $ListToko = [];
                        $params = ['ListToko' => $ListToko];
                    }

                    $params['User'] = Auth::user();

                    $params['Notifikasi'] = $Notifikasi;
                    $params['pages'] = $pages;
                    return view("pages.perdagangan.{$pages}", $params);
                }
            }
        } else {
            return redirect('/login');
        }
    }
    function updateDataLokasi()
    {

        $KabupatenNtbMall = Http::withHeaders([
            'signature' => 'mns-1275151',
        ])->get('https://absensinow.id/api/city');

        foreach ($KabupatenNtbMall['return'] as $key => $city) {
            $Kabupaten = new KabupatenNTBMall([
                'id' => $city['id'],
                "name" => $city['name'],
            ]);


            $Kabupaten->save();

            $KecamatanNtbMall = Http::withHeaders([
                'signature' => 'mns-1275151',
            ])->get('https://absensinow.id/api/district/' . $city['id']);
            foreach ($KecamatanNtbMall['return'] as $key => $district) {
                $Kecamatan = new KecamatanNTBMall([
                    'id' => $district['id'],
                    'id_kabupaten' => $city['id'],
                    "name" => $district['name'],
                ]);


                $Kecamatan->save();

                $KelurahanNtbMall = Http::withHeaders([
                    'signature' => 'mns-1275151',
                ])->get('https://absensinow.id/api/village/' . $district['id']);
                foreach ($KelurahanNtbMall['return'] as $key => $village) {
                    $Kelurahan = new KelurahanNTBMall([
                        'id' => $village['id'],
                        'id_kecamatan' => $district['id'],
                        "name" => $village['name'],
                        "postcode" => $village['postcode'],
                    ]);


                    $Kelurahan->save();
                }
            }
        }

        return "success";
    }
    function updateDataKategori()
    {

        $KategoriNtbMall = Http::withHeaders([
            'signature' => 'mns-1275151',
        ])->post('https://absensinow.id/api/product/getcategory', [
            'search' => ''
        ]);

        // dd($KategoriNtbMall['data']);

        foreach ($KategoriNtbMall['data'] as $key => $category) {
            $newKategoriNTBMall = new KategoriNTBMall([
                'id' => $category['id'],
                "text" => $category['text'],
            ]);


            $newKategoriNTBMall->save();

            $subKategoriNTBMall = Http::withHeaders([
                'signature' => 'mns-1275151',
            ])->post('https://absensinow.id/api/product/getsubcategory', [
                'parent_category' => $category['id'],
                'search' => '',
            ]);
            foreach ($subKategoriNTBMall['data'] as $key => $subCategory) {
                $newSubKategoriNTBMall = new SubKategoriNTBMall([
                    'id' => $subCategory['id'],
                    'id_kategori' => $category['id'],
                    "text" => $subCategory['text'],
                ]);


                $newSubKategoriNTBMall->save();
            }
        }

        return "success";
    }
    function buatToko(Request $request)
    {
        $kurir = [];
        if ($request->input('gojek')) {
            array_push($kurir, 'gojek');
        }
        if ($request->input('grab')) {
            array_push($kurir, 'grab');
        }
        if ($request->input('jne')) {
            array_push($kurir, 'jne');
        }
        if ($request->input('jnt')) {
            array_push($kurir, 'jnt');
        }
        if ($request->input('lion')) {
            array_push($kurir, 'lion');
        }
        if ($request->input('sicepat')) {
            array_push($kurir, 'sicepat');
        }
        $umkm_id = (string) Str::uuid();


        $city = KabupatenNTBMall::find($request->input('city_val'));
        $district = KecamatanNTBMall::find($request->input('district_val'));
        $village = KelurahanNTBMall::find($request->input('village_val'));


        $buatTokoNtbMall = Http::withHeaders([
            'signature' => 'mns-1275151',
        ])->post('https://absensinow.id/api/product/getcategory', [
            'umkm_id' => $umkm_id,
            'name' => $request->input('name'),
            'nik' => $request->input('nik'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'npwp' => $request->input('npwp'),
            'store_information' => $request->input('store_information'),
            'province_val' => 'Nusa Tenggara Barat',
            'province_id' => '22',
            'city_val' => $request->input('city_val'),
            'city_id' => $city->id,
            'district_val' => $request->input('district_val'),
            'district_id' => $district->id,
            'village_val' => $request->input('village_val'),
            'village_id' => $village->id,
            'postalcode' => $request->input('postalcode'),
            'address' => $request->input('address'),
            'courier' => $kurir,
        ]);
        // dd($buatTokoNtbMall['data'])
        // $user = $buatTokoNtbMall['data']['user'];
        // $store = $buatTokoNtbMall['data']['store'];

        // $user = new UserNTBMall([
        //     'id' => $user->id,
        //     'name' => $user->name,
        //     'username' => $user->username,
        //     'email' => $user->email,
        //     'phone' => $user->phone,
        //     'password' => $user->password,
        // ]);

        // $toko = new TokoNTBMall([
        //     'id' => $user->id,
        //     'user_id' => $user->user_id,
        //     'name' => $user->name,
        //     'description' => $user->description,
        //     'is_actived' => $user->is_actived,
        // ]);

        // $user->save();
        // $toko->save();



        // dd($kurir);
        // dd($request);
    }
}
