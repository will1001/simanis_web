@extends('layouts.member')
<?php
$forms = array(
    (object)array(
        "type" => "text",
        "placeholder" => "NOMOR INDUK KEPENDUDUKAN (NIK)",
        "prop" => "nik"
    ),
    (object)array(
        "type" => "text",
        "placeholder" => "NAMA",
        "prop" => "nama_direktur"
    ),
    (object)array(
        "type" => "select",
        "placeholder" => "KABUPATEN",
        "prop" => "id_kabupaten",
        "options" => $Kabupaten,
        "change" => "",
    ),
    (object)array(
        "type" => "select",
        "placeholder" => "KECAMATAN",
        "prop" => "kecamatan",
        "options" => $Kecamatan,
        "change" => "",
    ),
    (object)array(
        "type" => "select",
        "placeholder" => "KELURAHAN/DESA",
        "prop" => "kelurahan",
        "options" => $Kelurahan,
        "change" => "",
    ),
    (object)array(
        "type" => "text",
        "placeholder" => "ALAMAT LENGKAP",
        "prop" => "alamat_lengkap"
    ),
    (object)array(
        "type" => "number",
        "placeholder" => "NO. HP",
        "prop" => "no_hp"
    ),
    (object)array(
        "type" => "text",
        "placeholder" => "NAMA USAHA",
        "prop" => "nama_usaha"
    ),
    (object)array(
        "type" => "text",
        "placeholder" => "BENTUK USAHA",
        "prop" => "bentuk_usaha"
    ),
    (object)array(
        "type" => "number",
        "placeholder" => "TAHUN BERDIRI",
        "prop" => "tahun_berdiri"
    ),
    (object)array(
        "type" => "text",
        "placeholder" => "LEGALITAS USAHA",
        "prop" => "formal_informal"
    ),
    (object)array(
        "type" => "text",
        "placeholder" => "NIB/TAHUN",
        "prop" => "nib_tahun"
    ),
    (object)array(
        "type" => "text",
        "placeholder" => "NOMOR SERTIFIKAT HALAL/ TAHUN",
        "prop" => "nomor_sertifikat_halal_tahun"
    ),
    (object)array(
        "type" => "text",
        "placeholder" => "SERTIFIKAT MEREK/TAHUN",
        "prop" => "sertifikat_merek_tahun"
    ),
    (object)array(
        "type" => "text",
        "placeholder" => "NOMOR TEST REPORT/TAHUN",
        "prop" => "nomor_test_report_tahun"
    ),
    (object)array(
        "type" => "text",
        "placeholder" => "SNI/TAHUN",
        "prop" => "sni_tahun"
    ),
    (object)array(
        "type" => "text",
        "placeholder" => "JENIS USAHA",
        "prop" => "jenis_usaha"
    ),
    (object)array(
        "type" => "select",
        "placeholder" => "CABANG INDUSTRI",
        "prop" => "cabang_industri",
        "options" => $CabangIndustri,
        "change" => "return changeCabangIndustri()",
    ),
    (object)array(
        "type" => "select",
        "placeholder" => "SUB CABANG INDUSTRI",
        "prop" => "sub_cabang_industri",
        "options" => [],
        "change" => "",
    ),
    (object)array(
        "type" => "select",
        "placeholder" => "KBLI",
        "prop" => "id_kbli",
        "options" => $Kbli,
        "change" => "",
    ),
    (object)array(
        "type" => "number",
        "placeholder" => "INVESTASI/ MODAL (RP. 000)",
        "prop" => "investasi_modal"
    ),
    (object)array(
        "type" => "number",
        "placeholder" => "JUMLAH TENAGA KERJA PRIA",
        "prop" => "jumlah_tenaga_kerja_pria"
    ),
    (object)array(
        "type" => "number",
        "placeholder" => "JUMLAH TENAGA KERJA WANITA",
        "prop" => "jumlah_tenaga_kerja_wanita"
    ),
    (object)array(
        "type" => "number",
        "placeholder" => "KAPASITAS PRODUKSI (RP. 000)",
        "prop" => "kapasitas_produksi_perbulan"
    ),
    (object)array(
        "type" => "text",
        "placeholder" => "SATUAN PRODUKSI",
        "prop" => "satuan_produksi"
    ),
    (object)array(
        "type" => "number",
        "placeholder" => "NILAI PRODUKSI (RP.000)",
        "prop" => "nilai_produksi_perbulan"
    ),
    (object)array(
        "type" => "number",
        "placeholder" => "NILAI BAHAN BAKU (RP.000)",
        "prop" => "nilai_bahan_baku_perbulan"
    ),
    (object)array(
        "type" => "number",
        "placeholder" => "Latitude",
        "prop" => "lat"
    ),
    (object)array(
        "type" => "number",
        "placeholder" => "Longitude",
        "prop" => "lng"
    ),
    (object)array(
        "type" => "text",
        "placeholder" => "Media sosial",
        "prop" => "media_sosial"
    ),
    (object)array(
        "type" => "file",
        "placeholder" => "Foto Alat Produksi",
        "prop" => "foto_alat_produksi"
    ),
    (object)array(
        "type" => "file",
        "placeholder" => "Foto Ruang Produksi",
        "prop" => "foto_ruang_produksi"
    ),

)


?>

@section('content')
<div>
   <h2>Profil Member IKN</h2>
   <span class="mr-2"><a href="{{ url('/member/settingAkun') }}">1. Pengaturan Akun</a></span>
   <span><a href="{{ url('/member/settingBadanUsaha') }}" class="text-blue-700">2. Badan Usaha</a></span>
</div>
<br>
<br>
<div class="actionContainer p-5 bg-white rounded-xl">
   <h3 class="text-textColor1">PROFIL BADAN USAHA</h3>
   <form method="POST" action="/form/member/{{!empty($BadanUsaha[0]) ? $BadanUsaha[0]->id : ''}}" enctype="multipart/form-data">
    @csrf
    @foreach($forms as $key=>$form)
    <div class="inputstyle">
        <div class="row">
            <div class="col-sm-12">
                <span>{{$form->placeholder}} : </span>
            </div>
            <div class="col-sm-12">
                @if($form->type == 'select')
                <select onchange="{{$form->change}}" class="selectpicker" data-live-search="true" name="{{$form->prop}}" id="{{$form->prop}}" value="{{strtolower(!empty([$BadanUsaha[0]]) ? $BadanUsaha[0]->{$form->prop} : '')}}">
                    <option value="" disabled selected>pilih</option>
                    @foreach($form->options as $key=>$option)
                    <option value="{{$form->prop == 'id_kabupaten'||$form->prop == 'id_kbli'?$option->id:$option->name}}" {{!empty($BadanUsaha[0]) ? strtolower($BadanUsaha[0]->{$form->prop})==strtolower(($form->prop == 'id_kabupaten'||$form->prop == 'id_kbli'?$option->id:$option->name))?'selected' : '' : ''}}>{{$option->name}}</option>
                    @endforeach
                </select>
                @elseif($form->type == 'file')
                <input type="file" enctype="multipart/form-data" name="{{$form->prop}}_file" id="{{$form->prop}}">
                @else
                <input type="{{$form->type}}" name="{{$form->prop}}" value="{{!empty($BadanUsaha[0]) ? $BadanUsaha[0]->{$form->prop} : ''}}" placeholder="{{$form->placeholder}}">
                @endif
            </div>
        </div>
    </div>
    @endforeach
    <button type="submit">Submit</button>
</form>
</div>


@endsection