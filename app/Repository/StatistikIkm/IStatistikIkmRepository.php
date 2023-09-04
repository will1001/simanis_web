<?php

namespace App\Repository\StatistikIkm;

interface IStatistikIkmRepository
{
    public function getBadanUsaha($condition);

    public function getIndustriKecil($condition);

    public function getIndustriMenengah($condition);

    public function getIndustriBesar($condition);

    public function getTotalTenagaKerja($condition);

    public function getListTenagaKerja($condition);

    public function getTotalIkmBaru($condition);

    public function getSertifikatHalal($condition);

    public function getSertifikatHaki($condition);

    public function getSertifikatSni($condition);

    public function getSertifikatTestReposrt($condition);

    public function getFormal($condition);

    public function getInformal($condition);
}
