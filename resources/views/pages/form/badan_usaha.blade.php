@extends("layouts.{$userType}")

<?php
$bentukUsaha = [
    (object)array(
        "id" => "PT",
        "name" => "PT"
    ),
    (object)array(
        "id" => "CV",
        "name" => "CV"
    ),
    (object)array(
        "id" => "UD",
        "name" => "UD"
    ),
    (object)array(
        "id" => "Perorangan",
        "name" => "Perorangan"
    ),
    (object)array(
        "id" => "Lainnya",
        "name" => "Lainnya"
    ),
    (object)array(
        "id" => "Belum Ada",
        "name" => "Belum Ada"
    )
];
$pendidikan_tenaga_kerja = [
    (object)array(
        "id" => "SD",
        "name" => "SD"
    ),
    (object)array(
        "id" => "SMP",
        "name" => "SMP"
    ),
    (object)array(
        "id" => "SMA",
        "name" => "SMA"
    ),
    (object)array(
        "id" => "S1",
        "name" => "S1"
    ),
    (object)array(
        "id" => "S2",
        "name" => "S2"
    ),
    (object)array(
        "id" => "S3",
        "name" => "S3"
    )
];

$forms = array(
    (object)array(
        "type" => "text",
        "placeholder" => "NOMOR INDUK KEPENDUDUKAN (NIK)",
        "prop" => "nik",
        "required" => "true"
    ),
    (object)array(
        "type" => "text",
        "placeholder" => "NAMA",
        "prop" => "nama_direktur",
        "required" => "true"

    ),
    (object)array(
        "type" => "select",
        "placeholder" => "KABUPATEN",
        "prop" => "kabupaten",
        "name" => "id_kabupaten",
        "options" => $Kabupaten,
        "change" => "return changeKabupaten()",
        "required" => "true"
    ),
    (object)array(
        "type" => "select",
        "placeholder" => "KECAMATAN",
        "prop" => "kecamatan",
        "name" => "kecamatan",
        "options" => [],
        "change" => "return changeKecamatan()",
        "required" => "true"

    ),
    (object)array(
        "type" => "select",
        "placeholder" => "KELURAHAN/DESA",
        "prop" => "kelurahan",
        "name" => "kelurahan",
        "options" => [],
        "change" => "",
        "required" => "true"

    ),
    (object)array(
        "type" => "text",
        "placeholder" => "ALAMAT LENGKAP",
        "prop" => "alamat_lengkap",
        "required" => "true"

    ),
    (object)array(
        "type" => "number",
        "placeholder" => "NO. HP",
        "prop" => "no_hp",
        "required" => "true"
    ),
    (object)array(
        "type" => "text",
        "placeholder" => "NAMA USAHA",
        "prop" => "nama_usaha",
        "required" => "true"
    ),
    (object)array(
        "type" => "select",
        "placeholder" => "BENTUK USAHA",
        "options" => $bentukUsaha,
        "prop" => "bentuk_usaha",
        "name" => "bentuk_usaha",
        "change" => "",
        "required" => "true"
    ),
    (object)array(
        "type" => "file",
        "placeholder" => "FILE DOKUMEN BENTUK USAHA",
        "prop" => "bentuk_usaha_file",
        "required" => "false"
    ),
    (object)array(
        "type" => "number",
        "placeholder" => "TAHUN BERDIRI",
        "prop" => "tahun_berdiri",
        "required" => "true"
    ),
    (object)array(
        "type" => "text",
        "placeholder" => "NIB/TAHUN",
        "prop" => "nib_tahun",
        "required" => "false"
    ),
    (object)array(
        "type" => "file",
        "placeholder" => "FILE DOKUMEN NIB",
        "prop" => "nib_file",
        "required" => "false"
    ),
    (object)array(
        "type" => "text",
        "placeholder" => "NOMOR SERTIFIKAT HALAL/ TAHUN",
        "prop" => "nomor_sertifikat_halal_tahun",
        "required" => "false"
    ),
    (object)array(
        "type" => "file",
        "placeholder" => "FILE SERTIFIKAT HALAL",
        "prop" => "sertifikat_halal_file",
        "required" => "false"
    ),
    (object)array(
        "type" => "text",
        "placeholder" => "SERTIFIKAT MEREK/TAHUN",
        "prop" => "sertifikat_merek_tahun",
        "required" => "false"
    ),
    (object)array(
        "type" => "file",
        "placeholder" => "FILE SERTIFIKAT MEREK",
        "prop" => "sertifikat_merek_file",
        "required" => "false"
    ),
    (object)array(
        "type" => "text",
        "placeholder" => "NOMOR TEST REPORT/TAHUN",
        "prop" => "nomor_test_report_tahun",
        "required" => "false"
    ),
    (object)array(
        "type" => "text",
        "placeholder" => "SNI/TAHUN",
        "prop" => "sni_tahun",
        "required" => "false"
    ),
    (object)array(
        "type" => "file",
        "placeholder" => "FILE SERTIFIKAT SNI",
        "prop" => "sertifikat_sni_file",
        "required" => "false"
    ),
    (object)array(
        "type" => "text",
        "placeholder" => "JENIS USAHA",
        "prop" => "jenis_usaha",
        "required" => "true"
    ),
    (object)array(
        "type" => "text",
        "placeholder" => "MEREK USAHA",
        "prop" => "merek_usaha",
        "required" => "true"
    ),
    (object)array(
        "type" => "select",
        "placeholder" => "CABANG INDUSTRI",
        "prop" => "cabang_industri",
        "name" => "cabang_industri",
        "options" => $CabangIndustri,
        "change" => "return changeCabangIndustri()",
        "required" => "true"
    ),
    (object)array(
        "type" => "select",
        "placeholder" => "SUB CABANG INDUSTRI",
        "prop" => "sub_cabang_industri",
        "name" => "sub_cabang_industri",
        "options" => [],
        "change" => "",
        "required" => "true"
    ),
    (object)array(
        "type" => "select",
        "placeholder" => "KBLI",
        "prop" => "id_kbli",
        "name" => "id_kbli",
        "options" => $Kbli,
        "change" => "",
        "required" => "true"
    ),
    (object)array(
        "type" => "numberText",
        "placeholder" => "INVESTASI/ MODAL",
        "prop" => "investasi_modal",
        "maxLength" => 20,
        "required" => "true"
    ),
    (object)array(
        "type" => "numberText",
        "placeholder" => "JUMLAH TENAGA KERJA PRIA",
        "prop" => "jumlah_tenaga_kerja_pria",
        "maxLength" => 3,
        "required" => "true"
    ),
    (object)array(
        "type" => "numberText",
        "placeholder" => "JUMLAH TENAGA KERJA WANITA",
        "prop" => "jumlah_tenaga_kerja_wanita",
        "maxLength" => 3,
        "required" => "true"
    ),
    (object)array(
        "type" => "select",
        "placeholder" => "RATA-RATA PENDIDIKAN TENAGA KERJA",
        "prop" => "rata_rata_pendidikan_tenaga_kerja",
        "name" => "rata_rata_pendidikan_tenaga_kerja",
        "options" => $pendidikan_tenaga_kerja,
        "change" => "",
        "required" => "true"
    ),
    (object)array(
        "type" => "numberText",
        "placeholder" => "KAPASITAS PRODUKSI / Tahun",
        "prop" => "kapasitas_produksi_perbulan",
        "maxLength" => 20,
        "required" => "true"
    ),
    (object)array(
        "type" => "text",
        "placeholder" => "SATUAN PRODUKSI",
        "prop" => "satuan_produksi",
        "required" => "true"
    ),
    (object)array(
        "type" => "numberText",
        "placeholder" => "NILAI PRODUKSI ",
        "prop" => "nilai_produksi_perbulan",
        "maxLength" => 20,
        "required" => "true"
    ),
    (object)array(
        "type" => "numberText",
        "placeholder" => "NILAI BAHAN BAKU ",
        "prop" => "nilai_bahan_baku_perbulan",
        "maxLength" => 20,
        "required" => "true"
    ),
    (object)array(
        "type" => "numberText",
        "placeholder" => "OMSET ",
        "prop" => "omset",
        "maxLength" => 20,
        "required" => "true"
    ),
    (object)array(
        "type" => "text",
        "placeholder" => "Latitude",
        "prop" => "lat",
        "required" => "false"
    ),
    (object)array(
        "type" => "text",
        "placeholder" => "Longitude",
        "prop" => "lng",
        "required" => "false"
    ),
    (object)array(
        "type" => "label",
        "placeholder" => "Contoh Data Latitude dan Longitude",
        "prop" => ""

    ),
    (object)array(
        "type" => "text",
        "placeholder" => "Media sosial",
        "prop" => "media_sosial",
        "required" => "false"
    ),
    (object)array(
        "id" => "foto_alat_produksi_file",
        "type" => "image",
        "placeholder" => "Foto Alat Produksi",
        "prop" => "foto_alat_produksi",
        "required" => "true"
    ),
    (object)array(
        "id" => "foto_ruang_produksi_file",
        "type" => "image",
        "placeholder" => "Foto Ruang Produksi",
        "prop" => "foto_ruang_produksi",
        "required" => "true"
    ),
    (object)array(
        "id" => "ktp",
        "type" => "image",
        "placeholder" => "KTP",
        "prop" => "ktp",
        "required" => "true"
    ),
    (object)array(
        "id" => "kk",
        "type" => "image",
        "placeholder" => "KK",
        "prop" => "kk",
        "required" => "true"
    ),
    (object)array(
        "id" => "ktp_pasangan",
        "type" => "image",
        "placeholder" => "ktp_pasangan",
        "prop" => "ktp_pasangan",
        "required" => "false"
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

    .inputstyle > select {
        width: 50px;
    }

    .inputstyle > span {
        word-wrap: break-word;
        width: 50%
    }
</style>
<?php
$baseUrl = env('APP_URL');

?>
@section('content')
    <form method="POST" action="/form/{{$userType}}/{{!empty($BadanUsaha[0]) ? $BadanUsaha[0]->id : ''}}"
          enctype="multipart/form-data">
        @csrf
        <h3 class="text-gray-400">Detail badan usaha</h3>
        @foreach($forms as $key=>$form)
            <div class="w-[1000px]">
                <div class="flex justify-between items-center">
                    <div class="w-[300px] text-gray-700">
                        <span>{{$form->placeholder}} </span>
                    </div>

                    <div class="w-[500px]">

                        @if($form->type == 'select')

                            <select onchange="{{$form->change}}"
                                    class="border-1 border-gray-400 pl-2 py-2 mb-2 w-[340px]" data-live-search="true"
                                    name="{{$form->name}}" id="{{$form->prop}}"
                                    value="{{strtolower(!empty($BadanUsaha[0]) ? $BadanUsaha[0]->{$form->prop} : '')}}">
                                <option value="" disabled selected>pilih</option>
                                @foreach($form->options as $key=>$option)
                                    <option
                                        value="{{$form->prop == 'kabupaten'||$form->prop == 'id_kbli'||$form->prop == 'cabang_industri'?$option->id:$option->name}}" {{!empty($BadanUsaha[0]) ? strtolower($BadanUsaha[0]->{$form->prop})==strtolower(($form->prop == 'kabupaten'||$form->prop == 'kecamatan'||$form->prop == 'id_kbli'||$form->prop == 'cabang_industri'?$option->id:$option->name))?'selected' : '' : ''}}>{{$option->name}}</option>
                                @endforeach
                            </select>
                        @elseif($form->type == 'file')
                        <!-- <input type="file" enctype="multipart/form-data" name="{{$form->prop}}_file" id="{{$form->prop}}"> -->
                            <label for="{{$form->prop}}"
                                   class="flex flex-col justify-center items-center w-[340px] h-[150px] bg-gray-50 rounded-lg border-2 border-gray-300 border-dashed cursor-pointer dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                <div class="flex flex-col justify-center items-center pt-5 pb-6 h-[150px]">
                                    <img src="{{ asset('/Icon-svg/file.svg') }}"/>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                            class="font-semibold">Click to upload</span> or drag and drop</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 font-bold">UPLOAD FILE (MAX :
                                        5MB)</p>
                                </div>
                                <input onchange="uploadFile('{{$form->prop}}_info',event)" id="{{$form->prop}}"
                                       accept="application/pdf" name="{{$form->prop}}" type="file" class="hidden"
                                       id="{{$form->prop}}"/>
                            </label>
                            <h5 id="{{$form->prop}}_info"></h5>
                            @if(!empty($BadanUsaha[0]->{$form->prop}))
                                <a href="{{!empty($BadanUsaha[0]) ? $baseUrl . $BadanUsaha[0]->{$form->prop} : ''}}">Lihat
                                    File</a>
                            @endif
                        @elseif($form->type == 'image')
                        <!-- <input type="file" enctype="multipart/form-data" name="{{$form->prop}}_file" id="{{$form->prop}}"> -->
                            <label for="{{$form->id}}"
                                   class="flex flex-col justify-center items-center w-[340px] h-[150px] bg-gray-50 rounded-lg border-2 border-gray-300 border-dashed cursor-pointer dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                <div class="flex flex-col justify-center items-center pt-5 pb-6 h-[150px]">
                                    <img src="{{ asset('/Icon-svg/file.svg') }}"/>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                            class="font-semibold">Click to upload</span> or drag and drop</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, or JPG (Ukuran : 400px
                                        x 400px) (Max : 5MB)</p>
                                </div>
                                <input oninvalid="invalid('{{$form->prop}}','Wajib di Isi')"
                                       onchange="uploadFile('{{$form->prop}}_info',event)" id="{{$form->id}}"
                                       accept="image/x-png,image/gif,image/jpeg" name="{{$form->id}}" type="file"
                                       class="hidden" id="{{$form->prop}}" enctype="multipart/form-data"
                                       value="{{!empty($BadanUsaha[0]) ? $BadanUsaha[0]->{$form->prop} : ''}}"/>
                            </label>
                            <h5 id="{{$form->prop}}_info"></h5>
                            @if(!empty($BadanUsaha[0]->{$form->prop}))
                                <a href="{{!empty($BadanUsaha[0]) ? $baseUrl . $BadanUsaha[0]->{$form->prop} : ''}}">Lihat
                                    Gambar</a>
                            @endif
                            <p id="{{$form->prop}}_label" class="text-red-600" style="display: none;">Wajib di Isi *</p>
                        @elseif($form->type == 'label')
                            <a class="text-blue font-blue" target="_blank"
                               href="https://www.youtube.com/watch?v=f3-B_xtKwU0&ab_channel=TensaitechAcademy">Klik
                                Disini</a>
                        @elseif($form->type == 'number')
                            <input id="{{$form->prop}}"
                                   class="border-1 border-gray-400 pl-2 py-2 text-black mb-2 w-[340px]" type="number"
                                   name="{{$form->prop}}"
                                   value="{{!empty($BadanUsaha[0]) ? $BadanUsaha[0]->{$form->prop} : ''}}"
                                   placeholder="{{$form->placeholder}}">
                        @elseif($form->type == 'numberText')
                            <input maxlength="{{$form->maxLength}}" id="{{$form->prop}}"
                                   class="border-1 border-gray-400 pl-2 py-2 text-black mb-2 w-[340px]"
                                   onkeyup="keyup('{{$form->prop}}',event)" type="text" name="{{$form->prop}}"
                                   value="{{!empty($BadanUsaha[0]) ? number_format($BadanUsaha[0]->{$form->prop}) : ''}}"
                                   placeholder="{{$form->placeholder}}">

                        @else
                            <input id="{{$form->prop}}"
                                   {{$form->required == 'true'?'required':''}} oninvalid="invalid('{{$form->prop}}','Wajib di Isi')"
                                   class="border-1 border-gray-400 pl-2 py-2 text-black mb-2 w-[340px]"
                                   type="{{$form->type}}" name="{{$form->prop}}"
                                   value="{{!empty($BadanUsaha[0]) ? $BadanUsaha[0]->{$form->prop} : ''}}"
                                   placeholder="{{$form->placeholder}}">
                            <p id="{{$form->prop}}_label" class="text-red-600" style="display: none;">Wajib di Isi *</p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
        <div class="flex justify-end">
            <button class="bg-buttonColor-900 text-white p-3 mr-[150px] mt-3 rounded-xl" type="submit">Simpan Akun IKM
            </button>
        </div>
    </form>
@endsection

<script>
    const Kabupaten = @json($Kabupaten);
    const Kecamatan = @json($Kecamatan);
    const Kelurahan = @json($Kelurahan);
    const subCabangIndustri = @json($SubCabangIndustri);
    const cabangIndustri = @json($CabangIndustri);
    const Kbli = @json($Kbli);
    const BadanUsaha = @json($BadanUsaha);
    const forms = @json($forms);


    const changeCabangIndustri = () => {
        const cabangIndustriFilter = document.getElementById('cabang_industri');
        const nameCabangIndsutri = cabangIndustriFilter.options[cabangIndustriFilter.selectedIndex].value;
        const textCabangIndsutri = cabangIndustriFilter.options[cabangIndustriFilter.selectedIndex].text;
        renderSubCabangIndustriSelectFilter(nameCabangIndsutri)
    }

    const renderSubCabangIndustriSelectFilter = (nameCabangIndsutri) => {
        var str = `<option value=''>Semua</option>`
        const idCabangIndustri = cabangIndustri.filter(e => e.id == nameCabangIndsutri);
        const subCabangIndustriList = subCabangIndustri.filter(e => e.id_cabang_industri == idCabangIndustri[0].id);

        for (let item of subCabangIndustriList) {
            str += `<option value='${item.id}'>` + item.name + "</option>"
        }
        document.getElementById("sub_cabang_industri").innerHTML = str;
    }

    const changeKabupaten = () => {
        const kabupatenFilter = document.getElementById('kabupaten');
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

    const uploadFile = (label, e) => {
        const FileLabel = document.getElementById(label);
        FileLabel.innerHTML = e.target.value.split("\\").pop();
    }
    const invalid = (id, msg) => {
        console.log(id);
        const inputEl = document.getElementById(id);
        const labelEl = document.getElementById(id + "_label");
        inputEl.style.borderColor = "red";
        labelEl.style.display = "block";

    }


    const updateTextView = (label, _obj) => {
        const val = _obj.target.value;
        const input = document.getElementById(label);
        input.value = val.toLocaleString('en-US', {
            maximumFractionDigits: 2
        });
        // console.log(val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
        // var num = getNumber(val);
        // if (num == 0) {
        //     _obj.val('');
        // } else {
        //     _obj.val(num.toLocaleString());
        // }
        // return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
    const keyup = (id, e) => {
        let val = e.target.value;
        if (val === null || val === "") {
            val = 0;
        }
        const a = new Intl.NumberFormat('en-US').format(parseFloat(val.replace(/,/g, '')));
        const input = document.getElementById(id);

        console.log(a);
        input.value = a;

    }

    function getNumber(_str) {
        var arr = _str.split('');
        var out = new Array();
        for (var cnt = 0; cnt < arr.length; cnt++) {
            if (isNaN(arr[cnt]) == false) {
                out.push(arr[cnt]);
            }
        }
        return Number(out.join(''));
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

    // console.log(BadanUsaha[0].cabang_industri);

    setTimeout(function () {
        if (BadanUsaha[0].kabupaten) {
            renderKecamatan(BadanUsaha[0].kabupaten);
            document.getElementById(forms[3].prop).value = BadanUsaha[0].kecamatan;

        }
        if (BadanUsaha[0].kecamatan) {
            renderKelurahan(BadanUsaha[0].kecamatan);
            document.getElementById(forms[4].prop).value = BadanUsaha[0].kelurahan;

        }
        if (BadanUsaha[0].cabang_industri) {
            console.log(BadanUsaha[0].cabang_industri);
            renderSubCabangIndustriSelectFilter(BadanUsaha[0].cabang_industri);
            document.getElementById(forms[23].prop).value = BadanUsaha[0].sub_cabang_industri;
        }
    }, 3000);
</script>
