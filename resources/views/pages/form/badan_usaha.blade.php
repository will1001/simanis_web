@extends("layouts.{$userType}")

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
        "change" => "return changeKabupaten()",
    ),
    (object)array(
        "type" => "select",
        "placeholder" => "KECAMATAN",
        "prop" => "kecamatan",
        "options" => [],
        "change" => "return changeKecamatan()",
    ),
    (object)array(
        "type" => "select",
        "placeholder" => "KELURAHAN/DESA",
        "prop" => "kelurahan",
        "options" => [],
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
<style>
    .inputstyle {
        margin: 10px 0px;
        display: flex;
        width: 100%;
        justify-content: space-between;


    }

    .inputstyle>select {
        width: 50px;
    }

    .inputstyle>span {
        word-wrap: break-word;
        width: 50%
    }
</style>
@section('content')
<form method="POST" action="/form/{$userType}/{{!empty($BadanUsaha[0]) ? $BadanUsaha[0]->id : ''}}" enctype="multipart/form-data">
    @csrf
    @foreach($forms as $key=>$form)
    <div class="inputstyle">
        <div class="row">
            <div class="col-sm-12">
                <span>{{$form->placeholder}} : </span>
            </div>
            <div class="col-sm-12">
                @if($form->type == 'select')
                <select onchange="{{$form->change}}" class="selectpicker" data-live-search="true" name="{{$form->prop}}" id="{{$form->prop}}" value="{{strtolower(!empty($BadanUsaha[0]) ? $BadanUsaha[0]->{$form->prop} : '')}}">
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
@endsection

<script>
    const Kabupaten = @json($Kabupaten);
    const Kecamatan = @json($Kecamatan);
    const Kelurahan = @json($Kelurahan);
    const subCabangIndustri = @json($SubCabangIndustri);
    const cabangIndustri = @json($CabangIndustri);
    const Kbli = @json($Kbli);
    const changeCabangIndustri = () => {
        const cabangIndustriFilter = document.getElementById('cabang_industri');
        const nameCabangIndsutri = cabangIndustriFilter.options[cabangIndustriFilter.selectedIndex].value;
        const textCabangIndsutri = cabangIndustriFilter.options[cabangIndustriFilter.selectedIndex].text;
        renderSubCabangIndustriSelectFilter(nameCabangIndsutri)
    }

    const renderSubCabangIndustriSelectFilter = (nameCabangIndsutri) => {
        var str = `<option value=''>Semua</option>`
        const idCabangIndustri = cabangIndustri.filter(e => e.name == nameCabangIndsutri)[0].id;
        const subCabangIndustriList = subCabangIndustri.filter(e => e.id_cabang_industri == idCabangIndustri);

        for (let item of subCabangIndustriList) {
            str += `<option value='${item.id}'>` + item.name + "</option>"
        }
        document.getElementById("sub_cabang_industri").innerHTML = str;
    }

    const changeKabupaten = () => {
        const kabupatenFilter = document.getElementById('id_kabupaten');
        const idKabupaten = kabupatenFilter.options[kabupatenFilter.selectedIndex].value;
        renderKecamatan(idKabupaten)
    }

    const renderKecamatan = (idKabupaten) => {
        var str = `<option value=''>Semua</option>`
        const kecamatanList = Kecamatan.filter(e => e.id_kabupaten == idKabupaten);

        for (let item of kecamatanList) {
            str += `<option value='${item.id}'>` + item.name + "</option>"
        }
        document.getElementById("kecamatan").innerHTML = str;
    }

    const changeKecamatan = () => {
        const KecamatanFilter = document.getElementById('kecamatan');
        const idKecamatan = KecamatanFilter.options[KecamatanFilter.selectedIndex].value;
        renderKelurahan(idKecamatan)
    }

    const renderKelurahan = (idKecamatan) => {
        var str = `<option value=''>Semua</option>`
        const kelurahanList = Kelurahan.filter(e => e.id_kecamatan == idKecamatan);

        for (let item of kelurahanList) {
            str += `<option value='${item.id}'>` + item.name + "</option>"
        }
        document.getElementById("kelurahan").innerHTML = str;
    }

    // const changeSubCabangIndustri = () => {
    //     const subCabangIndustriFilter = document.getElementById('sub_cabang_industri');
    //     const nameSubCabangIndsutri = subCabangIndustriFilter.options[subCabangIndustriFilter.selectedIndex].value;
    //     const textSubCabangIndsutri = subCabangIndustriFilter.options[subCabangIndustriFilter.selectedIndex].text;
    //     renderKBLISelectFilter(nameSubCabangIndsutri)
    // }
    // const renderKBLISelectFilter = (nameSubCabangIndsutri) => {
    //     var str = `<option value=''>Semua</option>`
    //     const idSubCabangIndustri = subCabangIndustri.filter(e => e.name == nameSubCabangIndsutri)[0].id;
    //     const KBLIList = Kbli.filter(e => e.id_cabang_industri == idCabangIndustri);

    //     for (let item of subCabangIndustriList) {
    //         str += `<option value='${item.id}'>` + item.name + "</option>"
    //     }
    //     document.getElementById("sub_cabang_industri").innerHTML = str;
    // }
</script>