<?php

namespace App\Repository\DataMaster;

interface IDataMasterRepository
{
    public function getKabupaten();

    public function getKecamatan($condition);

    public function getKelurahan($condition);

    public function getCabangIndustri();

    public function getSubCabangIndustri($condition);
}
