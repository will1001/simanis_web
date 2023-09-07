<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repository\DataMaster\DataMasterRepository;
use Illuminate\Http\Request;

class DataMasterController extends Controller
{
    protected $dataMasterRepository;

    public function __construct(DataMasterRepository $dataMasterRepository)
    {
        $this->dataMasterRepository = $dataMasterRepository;
    }

    public function getKabupaten()
    {
        try {
            $data = $this->dataMasterRepository->getKabupaten();
            return response()->json(
                [
                    'data' => $data,
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

    public function getKecamatan(Request $request)
    {
        try {
            $condition = array();
            if ($request->kabupaten) {
                $condition['id_kabupaten'] = $request->kabupaten;
            }
            $data = $this->dataMasterRepository->getKecamatan($condition);
            return response()->json(
                [
                    'data' => $data,
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

    public function getKelurahan(Request $request)
    {
        try {
            $condition = array();
            if ($request->kecamatan) {
                $condition['id_kecamatan'] = $request->kecamatan;
            }
            $data = $this->dataMasterRepository->getKelurahan($condition);
            return response()->json(
                [
                    'data' => $data,
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

    public function getCabangIndustri(Request $request)
    {
        try {
            $data = $this->dataMasterRepository->getCabangIndustri();
            return response()->json(
                [
                    'data' => $data,
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

    public function getSubCabangIndustri(Request $request)
    {
        try {
            $condition = array();
            if ($request->cabang_industri) {
                $condition['id_cabang_industri'] = $request->cabang_industri;
            }
            $data = $this->dataMasterRepository->getSubCabangIndustri($condition);
            return response()->json(
                [
                    'data' => $data,
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
