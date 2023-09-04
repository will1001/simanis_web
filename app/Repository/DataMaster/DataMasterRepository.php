<?php

namespace App\Repository\DataMaster;

use App\Models\CabangIndustri;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\SubCabangIndustri;

class DataMasterRepository implements IDataMasterRepository
{
    public function getKabupaten()
    {
        return Kabupaten::all();
    }

    public function getKecamatan($condition)
    {
        return Kecamatan::where($condition)->get();
    }

    public function getKelurahan($condition)
    {
        return Kelurahan::where($condition)->get();
    }

    public function getCabangIndustri()
    {
        return CabangIndustri::all();
    }

    public function getSubCabangIndustri($condition)
    {
        return SubCabangIndustri::where($condition)->get();
    }
}
