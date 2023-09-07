<?php

namespace App\Repository\StatistikIkm;

use App\Models\BadanUsaha;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StatistikIkmRepository implements IStatistikIkmRepository
{
    public function getBadanUsaha($condition)
    {
        $data = BadanUsaha::leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
            ->leftJoin('cabang_industri', 'badan_usaha.cabang_industri', '=', 'cabang_industri.id')
            ->leftJoin('sub_cabang_industri', 'badan_usaha.sub_cabang_industri', '=', 'sub_cabang_industri.id')
            ->whereNotNull("nama_direktur")
            ->whereNotNull("alamat_lengkap")
            ->whereNotNull("nama_usaha")
            ->whereNotNull("jenis_usaha")
            ->where($condition);

        return $data;
    }

    public function getIndustriKecil($condition)
    {
        $industriKecil = BadanUsaha::leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
            ->leftJoin('cabang_industri', 'badan_usaha.cabang_industri', '=', 'cabang_industri.id')
            ->leftJoin('sub_cabang_industri', 'badan_usaha.sub_cabang_industri', '=', 'sub_cabang_industri.id')
            ->where('investasi_modal', '<=', 1000000000)
            ->whereNotNull("nama_direktur")
            ->whereNotNull("alamat_lengkap")
            ->whereNotNull("nama_usaha")
            ->whereNotNull("jenis_usaha")
            ->where($condition);

        return $industriKecil;
    }

    public function getIndustriMenengah($condition)
    {
        $industriMenengah = BadanUsaha::leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
            ->leftJoin('cabang_industri', 'badan_usaha.cabang_industri', '=', 'cabang_industri.id')
            ->leftJoin('sub_cabang_industri', 'badan_usaha.sub_cabang_industri', '=', 'sub_cabang_industri.id')
            ->whereBetween('investasi_modal', [1000000000 + 1, 15000000000 - 1])
            ->whereNotNull("nama_direktur")
            ->whereNotNull("alamat_lengkap")
            ->whereNotNull("nama_usaha")
            ->whereNotNull("jenis_usaha")
            ->where($condition);

        return $industriMenengah;
    }

    public function getIndustriBesar($condition)
    {
        $industriBesar = BadanUsaha::leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
            ->leftJoin('cabang_industri', 'badan_usaha.cabang_industri', '=', 'cabang_industri.id')
            ->leftJoin('sub_cabang_industri', 'badan_usaha.sub_cabang_industri', '=', 'sub_cabang_industri.id')
            ->where('investasi_modal', '>=', 15000000000)
            ->whereNotNull("nama_direktur")
            ->whereNotNull("alamat_lengkap")
            ->whereNotNull("nama_usaha")
            ->whereNotNull("jenis_usaha")
            ->where($condition);
        return $industriBesar;
    }

    public function getTotalTenagaKerja($condition)
    {
        $totalTenagaKerja = DB::table('badan_usaha')->leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
            ->leftJoin('cabang_industri', 'badan_usaha.cabang_industri', '=', 'cabang_industri.id')
            ->leftJoin('sub_cabang_industri', 'badan_usaha.sub_cabang_industri', '=', 'sub_cabang_industri.id')
            ->select(DB::raw('sum(jumlah_tenaga_kerja_pria)+sum(jumlah_tenaga_kerja_wanita) as total_tenaga_kerja'))
            ->whereNotNull("nama_direktur")
            ->whereNotNull("alamat_lengkap")
            ->whereNotNull("nama_usaha")
            ->whereNotNull("jenis_usaha")
            ->where($condition)
            ->first()->total_tenaga_kerja;
        return $totalTenagaKerja;
    }

    public function getListTenagaKerja($condition)
    {
        $tenagaKerja = DB::table('badan_usaha')->leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
            ->leftJoin('cabang_industri', 'badan_usaha.cabang_industri', '=', 'cabang_industri.id')
            ->leftJoin('sub_cabang_industri', 'badan_usaha.sub_cabang_industri', '=', 'sub_cabang_industri.id')
            ->whereNotNull("nama_direktur")
            ->whereNotNull("alamat_lengkap")
            ->whereNotNull("nama_usaha")
            ->whereNotNull("jenis_usaha")
            ->where($condition);
        return $tenagaKerja;
    }

    public function getTotalIkmBaru($condition)
    {
        $totalIKMBaru = DB::table('badan_usaha')
            ->leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
            ->leftJoin('cabang_industri', 'badan_usaha.cabang_industri', '=', 'cabang_industri.id')
            ->leftJoin('sub_cabang_industri', 'badan_usaha.sub_cabang_industri', '=', 'sub_cabang_industri.id')
            ->where('tahun_berdiri', date('Y'))
            ->whereNotNull("nama_direktur")
            ->whereNotNull("alamat_lengkap")
            ->whereNotNull("nama_usaha")
            ->whereNotNull("jenis_usaha")
            ->where($condition);
        return $totalIKMBaru;
    }

    public function getSertifikatHalal($condition)
    {
        $sertifikatHalal = BadanUsaha::leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
            ->leftJoin('cabang_industri', 'badan_usaha.cabang_industri', '=', 'cabang_industri.id')
            ->leftJoin('sub_cabang_industri', 'badan_usaha.sub_cabang_industri', '=', 'sub_cabang_industri.id')
            ->whereNotNull('nomor_sertifikat_halal_tahun')
            ->whereNotNull("nama_direktur")
            ->whereNotNull("alamat_lengkap")
            ->whereNotNull("nama_usaha")
            ->whereNotNull("jenis_usaha")
            ->where($condition);
        return $sertifikatHalal;
    }

    public function getSertifikatHaki($condition)
    {
        $sertifikatHaki = BadanUsaha::leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
            ->leftJoin('cabang_industri', 'badan_usaha.cabang_industri', '=', 'cabang_industri.id')
            ->leftJoin('sub_cabang_industri', 'badan_usaha.sub_cabang_industri', '=', 'sub_cabang_industri.id')
            ->whereNotNull('sertifikat_merek_tahun')
            ->whereNotNull("nama_direktur")
            ->whereNotNull("alamat_lengkap")
            ->whereNotNull("nama_usaha")
            ->whereNotNull("jenis_usaha")
            ->where($condition);
        return $sertifikatHaki;
    }

    public function getSertifikatSni($condition)
    {
        $sertifikatSNI = BadanUsaha::leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
            ->leftJoin('cabang_industri', 'badan_usaha.cabang_industri', '=', 'cabang_industri.id')
            ->leftJoin('sub_cabang_industri', 'badan_usaha.sub_cabang_industri', '=', 'sub_cabang_industri.id')
            ->whereNotNull('sni_tahun')
            ->whereNotNull("nama_direktur")
            ->whereNotNull("alamat_lengkap")
            ->whereNotNull("nama_usaha")
            ->whereNotNull("jenis_usaha")
            ->where($condition);
        return $sertifikatSNI;
    }

    public function getSertifikatTestReposrt($condition)
    {
        $sertifikatTestReport = BadanUsaha::leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
            ->leftJoin('cabang_industri', 'badan_usaha.cabang_industri', '=', 'cabang_industri.id')
            ->leftJoin('sub_cabang_industri', 'badan_usaha.sub_cabang_industri', '=', 'sub_cabang_industri.id')
            ->whereNotNull('nomor_test_report_tahun')
            ->whereNotNull("nama_direktur")
            ->whereNotNull("alamat_lengkap")
            ->whereNotNull("nama_usaha")
            ->whereNotNull("jenis_usaha")
            ->where($condition);
        return $sertifikatTestReport;
    }

    public function getFormal($condition)
    {
        $formal = BadanUsaha::leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
            ->leftJoin('cabang_industri', 'badan_usaha.cabang_industri', '=', 'cabang_industri.id')
            ->leftJoin('sub_cabang_industri', 'badan_usaha.sub_cabang_industri', '=', 'sub_cabang_industri.id')
            ->whereNotNull('nib_tahun')
            ->whereNotNull("nama_direktur")
            ->whereNotNull("alamat_lengkap")
            ->whereNotNull("nama_usaha")
            ->whereNotNull("jenis_usaha")
            ->where($condition);
        return $formal;
    }

    public function getInformal($condition)
    {
        $informal = BadanUsaha::leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
            ->leftJoin('cabang_industri', 'badan_usaha.cabang_industri', '=', 'cabang_industri.id')
            ->leftJoin('sub_cabang_industri', 'badan_usaha.sub_cabang_industri', '=', 'sub_cabang_industri.id')
            ->whereNull('nib_tahun')
            ->whereNotNull("nama_direktur")
            ->whereNotNull("alamat_lengkap")
            ->whereNotNull("nama_usaha")
            ->whereNotNull("jenis_usaha")
            ->where($condition);
        return $informal;
    }

    public function getGeoSpacial($geospacial)
    {
        $features = [];
        foreach ($geospacial as $row) {
            $features[] = [
                "type" => "Feature",
                "geometry" => [
                    'type' => 'Point',
                    'coordinates' => [$row?->lng, $row?->lat]
                ],
                "properties" => [
                    'id' => $row?->id,
                    'icon' => $row?->icon,
                    'alamat' => $row?->alamat_lengkap,
                    'nama' => $row?->name,
                    'nama_direktur' => $row?->nama_direktur,
                    'nama_usaha' => $row?->nama_usaha,
                    'kecamatan' => $row?->kecamatan,
                    'kelurahan' => $row?->kelurahan,
                    'jenis_usaha' => $row?->jenis_usaha,
                ]
            ];
        }

        return response()->json([
            'data' => [
                "type" => "FeatureCollection",
                "features" => $features,
            ]
        ], 200);
    }
}
