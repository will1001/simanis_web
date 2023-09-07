<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repository\StatistikIkm\StatistikIkmRepository;
use Illuminate\Http\Request;

class StatistikIkmController extends Controller
{
    protected $ikmRepository;

    public function __construct(StatistikIkmRepository $ikmRepository)
    {
        $this->ikmRepository = $ikmRepository;
    }

    public function index(Request $request)
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

            return response()->json(
                [
                    'data' => [
                        array('ids' => 'badan_usaha','name' => 'Badan usaha', 'value' => $badan_usaha),
                        array('ids' => 'usaha_kecil','name' => 'Usaha Kecil', 'value' => $usaha_kecil),
                        array('ids' => 'usaha_menengah','name' => 'Usaha menengah', 'value' => $usaha_menengah),
                        array('ids' => 'usaha_besar','name' => 'Usaha besar', 'value' => $usaha_besar),
                        array('ids' => 'total_tenaga_kerja','name' => 'Total tenaga kerja', 'value' => $total_tanaga_kerja),
                        array('ids' => 'total_ikm_baru','name' => 'Total IKM baru', 'value' => $total_ikm_baru),
                        array('ids' => 'sertifikat_halal','name' => 'Sertifikat halal', 'value' => $sertifikat_halal),
                        array('ids' => 'sertifikat_haki','name' => 'Sertifikat haki', 'value' => $sertifikat_haki),
                        array('ids' => 'sertifikat_sni','name' => 'Sertifikat SNI', 'value' => $sertifikat_sni),
                        array('ids' => 'sertifikat_test_report','name' => 'Sertifikat test report', 'value' => $sertifikat_test_report),
                        array('ids' => 'formal','name' => 'Formal', 'value' => $formal),
                        array('ids' => 'informal','name' => 'Informal', 'value' => $informal),
                    ],
                    'source' => 'Simanis'
                ]
            );
        } catch (\Exception $exception) {
            return response()->json([
                'messege' => 'Internal server error',
                'error' => $exception->getMessage()
            ], 500);
        }
    }

    public function detailChart(Request $request)
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
            $title = 'Detail';
            if ($request->q == 'badan_usaha') {
                $data = $this->ikmRepository->getBadanUsaha($condition)->get();
                $title = 'Total IKM';
            } elseif ($request->q == 'usaha_kecil') {
                $data = $this->ikmRepository->getIndustriKecil($condition)->get();
                $title = 'Industri Kecil';
            } elseif ($request->q == 'usaha_menengah') {
                $data = $this->ikmRepository->getIndustriMenengah($condition)->get();
                $title = 'Industri Menengah';
            } elseif ($request->q == 'usaha_besar') {
                $data = $this->ikmRepository->getIndustriBesar($condition)->get();
                $title = 'Industri Besar';
            } elseif ($request->q == 'total_tenaga_kerja') {
                $data = $this->ikmRepository->getListTenagaKerja($condition)->get();
                $title = 'Tenaga Kerja';
            } elseif ($request->q == 'total_ikm_baru') {
                $data = $this->ikmRepository->getTotalIkmBaru($condition)->get();
                $title = 'IKM Baru';
            } elseif ($request->q == 'sertifikat_halal') {
                $data = $this->ikmRepository->getSertifikatHalal($condition)->get();
                $title = 'Sertifikat Halal';
            } elseif ($request->q == 'sertifikat_haki') {
                $data = $this->ikmRepository->getSertifikatHaki($condition)->get();
                $title = 'Sertifikat HAKI';
            } elseif ($request->q == 'sertifikat_sni') {
                $data = $this->ikmRepository->getSertifikatSni($condition)->get();
                $title = 'Sertifikat SNI';
            } elseif ($request->q == 'sertifikat_test_report') {
                $data = $this->ikmRepository->getSertifikatTestReposrt($condition)->get();
                $title = 'Sertifikat Test Report';
            } elseif ($request->q == 'formal') {
                $data = $this->ikmRepository->getFormal($condition)->get();
                $title = 'Formal';
            } elseif ($request->q == 'informal') {
                $data = $this->ikmRepository->getInformal($condition)->get();
                $title = 'Informal';
            }

            return response()->json(
                [
                    'data' => $data,
                    'title' => $title,
                    'source' => 'Simanis'
                ]
            );
        } catch (\Exception $exception) {
            return response()->json([
                'messege' => 'Internal server error',
                'error' => $exception->getMessage()
            ], 500);
        }
    }
}
