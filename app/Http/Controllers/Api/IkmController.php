<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repository\StatistikIkm\StatistikIkmRepository;
use Illuminate\Http\Request;

class IkmController extends Controller
{
    protected $ikmRepository;

    public function __construct(StatistikIkmRepository $ikmRepository)
    {
        $this->ikmRepository = $ikmRepository;
    }

    public function index(Request $request)
    {
        $condition = array();
        if ($request->kabupaten) {
            $condition['id_kabupaten'] = $request->kabupaten;
        }
        if ($request->kecamatan) {
            $condition['kecamatan'] = $request->kecamatan;
        }
        if ($request->kelurahan) {
            $condition['kelurahan'] = $request->kelurahan;
        }
        if ($request->cabang_industri) {
            $condition['cabang_industri'] = $request->cabang_industri;
        }
        if ($request->sub_cabang_industri) {
            $condition['sub_cabang_industri'] = $request->sub_cabang_industri;
        }
        if ($request->tahun_berdiri) {
            $condition['tahun_berdiri'] = $request->tahun_berdiri;
        }


        $badan_usaha = $this->ikmRepository->getBadanUsaha($condition)->count();
        $usaha_kecil = $this->ikmRepository->getIndustriKecil($condition)->count();
        $usaha_menengah = $this->ikmRepository->getIndustriMenengah($condition)->count();
        $usaha_besar = $this->ikmRepository->getIndustriBesar($condition)->count();
        $total_tanaga_kerja = $this->ikmRepository->getTotalTenagaKerja($condition);
        $total_ikm_baru = $this->ikmRepository->getTotalIkmBaru($condition)->count();
        $sertifikat_halal = $this->ikmRepository->getSertifikatHalal($condition)->count();
        $sertifikat_haki = $this->ikmRepository->getSertifikatHaki($condition)->count();
        $sertifikat_sni = $this->ikmRepository->getSertifikatSni($condition)->count();
        $sertifikat_test_report = $this->ikmRepository->getSertifikatTestReposrt($condition)->count();
        $formal = $this->ikmRepository->getFormal($condition)->count();
        $informal = $this->ikmRepository->getInformal($condition)->count();

        return response()->json(([
            'badan_usaha' => $badan_usaha,
            'usaha_kecil' => $usaha_kecil,
            'usaha_menengah' => $usaha_menengah,
            'usaha_besar' => $usaha_besar,
            'total_tenaga_kerja' => $total_tanaga_kerja,
            'total_ikm_baru' => $total_ikm_baru,
            'sertifikat_halal' => $sertifikat_halal,
            'sertifikat_haki' => $sertifikat_haki,
            'sertifikat_sni' => $sertifikat_sni,
            'sertifikat_test_report' => $sertifikat_test_report,
            'formal' => $formal,
            'informal' => $informal
        ]));
    }

    public function geoSpacial(Request $request)
    {
        try {
            $condition = array();
            if ($request->kabupaten) {
                $condition['id_kabupaten'] = $request->kabupaten;
            }
            if ($request->kecamatan) {
                $condition['kecamatan'] = $request->kecamatan;
            }
            if ($request->kelurahan) {
                $condition['kelurahan'] = $request->kelurahan;
            }
            if ($request->cabang_industri) {
                $condition['cabang_industri'] = $request->cabang_industri;
            }
            if ($request->sub_cabang_industri) {
                $condition['sub_cabang_industri'] = $request->sub_cabang_industri;
            }
            if ($request->tahun_berdiri) {
                $condition['tahun_berdiri'] = $request->tahun_berdiri;
            }

            $data = [];
            if ($request->q == 'badan_usaha') {
                $data = $this->ikmRepository->getBadanUsaha($condition)
                    ->whereNotNull('lat')
                    ->whereNotNull('lng')
                    ->where('lat', '!=', '0')
                    ->where('lng', '!=', '0')
                    ->get();
            } elseif ($request->q == 'usaha_kecil') {
                $data = $this->ikmRepository->getIndustriKecil($condition)
                    ->whereNotNull('lat')
                    ->whereNotNull('lng')
                    ->where('lat', '!=', '0')
                    ->where('lng', '!=', '0')
                    ->get();
            } elseif ($request->q == 'usaha_menengah') {
                $data = $this->ikmRepository->getIndustriMenengah($condition)
                    ->whereNotNull('lat')
                    ->whereNotNull('lng')
                    ->where('lat', '!=', '0')
                    ->where('lng', '!=', '0')
                    ->get();
            } elseif ($request->q == 'usaha_besar') {
                $data = $this->ikmRepository->getIndustriBesar($condition)
                    ->whereNotNull('lat')
                    ->whereNotNull('lng')
                    ->where('lat', '!=', '0')
                    ->where('lng', '!=', '0')
                    ->get();
            } elseif ($request->q == 'total_tenaga_kerja') {
                $data = $this->ikmRepository->getListTenagaKerja($condition)
                    ->whereNotNull('lat')
                    ->whereNotNull('lng')
                    ->where('lat', '!=', '0')
                    ->where('lng', '!=', '0')
                    ->get();
            } elseif ($request->q == 'total_ikm_baru') {
                $data = $this->ikmRepository->getTotalIkmBaru($condition)
                    ->whereNotNull('lat')
                    ->whereNotNull('lng')
                    ->where('lat', '!=', '0')
                    ->where('lng', '!=', '0')
                    ->get();
            } elseif ($request->q == 'sertifikat_halal') {
                $data = $this->ikmRepository->getSertifikatHalal($condition)
                    ->whereNotNull('lat')
                    ->whereNotNull('lng')
                    ->where('lat', '!=', '0')
                    ->where('lng', '!=', '0')
                    ->get();
            } elseif ($request->q == 'sertifikat_haki') {
                $data = $this->ikmRepository->getSertifikatHaki($condition)
                    ->whereNotNull('lat')
                    ->whereNotNull('lng')
                    ->where('lat', '!=', '0')
                    ->where('lng', '!=', '0')
                    ->get();
            } elseif ($request->q == 'sertifikat_sni') {
                $data = $this->ikmRepository->getSertifikatSni($condition)
                    ->whereNotNull('lat')
                    ->whereNotNull('lng')
                    ->where('lat', '!=', '0')
                    ->where('lng', '!=', '0')
                    ->get();
            } elseif ($request->q == 'sertifikat_test_report') {
                $data = $this->ikmRepository->getSertifikatTestReposrt($condition)
                    ->whereNotNull('lat')
                    ->whereNotNull('lng')
                    ->where('lat', '!=', '0')
                    ->where('lng', '!=', '0')
                    ->get();
            } elseif ($request->q == 'formal') {
                $data = $this->ikmRepository->getFormal($condition)
                    ->whereNotNull('lat')
                    ->whereNotNull('lng')
                    ->where('lat', '!=', '0')
                    ->where('lng', '!=', '0')
                    ->get();
            } elseif ($request->q == 'informal') {
                $data = $this->ikmRepository->getInformal($condition)
                    ->whereNotNull('lat')
                    ->whereNotNull('lng')
                    ->where('lat', '!=', '0')
                    ->where('lng', '!=', '0')
                    ->get();
            }

            return $this->ikmRepository->getGeoSpacial($data);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Error internal server!'
            ], 500);
        }
    }
}
