@extends("layouts.perdagangan")

<?php


$forms = array(
    (object)array(
        "type" => "text",
        "placeholder" => "Nama Toko",
        "prop" => "name"
    ),
    (object)array(
        "type" => "text",
        "placeholder" => "Email",
        "prop" => "email"
    ),
    (object)array(
        "type" => "text",
        "placeholder" => "Nomor HP",
        "prop" => "phone"
    ),
    (object)array(
        "type" => "text",
        "placeholder" => "NIK",
        "prop" => "nik"
    ),
    (object)array(
        "type" => "text",
        "placeholder" => "NPWP",
        "prop" => "npwp"
    ),
    (object)array(
        "type" => "text",
        "placeholder" => "Store Information",
        "prop" => "store_information"
    ),
    // (object)array(
    //     "type" => "text",
    //     "placeholder" => "ID Provinsi",
    //     "prop" => "province_id"
    // ),
    // (object)array(
    //     "type" => "select",
    //     "placeholder" => "Provinsi",
    //     "prop" => "province_val",
    //     "options" => $Provinsi,
    //     "change" => "",
    // ),
    // (object)array(
    //     "type" => "text",
    //     "placeholder" => "ID Kota",
    //     "prop" => "city_id"
    // ),
    (object)array(
        "type" => "select",
        "placeholder" => "Kabupaten / Kota",
        "prop" => "city_val",
        "options" => $Kabupaten,
        "change" => "return changeKabupaten()",
    ),
    // (object)array(
    //     "type" => "text",
    //     "placeholder" => "ID Kecamatan",
    //     "prop" => "district_id"
    // ),
    (object)array(
        "type" => "select",
        "placeholder" => "Kecamatan",
        "prop" => "district_val",
        "options" => [],
        "change" => "return changeKecamatan()",
    ),
    // (object)array(
    //     "type" => "text",
    //     "placeholder" => "ID Desa",
    //     "prop" => "district_id"
    // ),
    (object)array(
        "type" => "select",
        "placeholder" => "Desa",
        "prop" => "village_val",
        "options" => [],
        "change" => "",
    ),
    (object)array(
        "type" => "text",
        "placeholder" => "Kode Pos",
        "prop" => "postalcode"
    ),
    (object)array(
        "type" => "text",
        "placeholder" => "Alamat",
        "prop" => "address"
    ),
    (object)array(
        "type" => "checkbox",
        "placeholder" => "Kurir",
        "prop" => "courier",
        "options" => $Courier,
        "change" => "",
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

    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>
@section('content')
<form method="POST" action="/ntbmall/buatToko" enctype="multipart/form-data">
    @csrf
    <h3 class="text-gray-400">Tambah Toko</h3>
    @foreach($forms as $key=>$form)
    <div class="w-[1000px]">
        <div class="flex justify-between items-center">
            <div class="w-[300px] text-gray-700">
                <span>{{$form->placeholder}} </span>
            </div>

            <div class="w-[500px]">
                @if($form->type == 'select')
                <select onchange="{{$form->change}}" class="border-1 border-gray-400 pl-2 pr-[150px] py-2 mb-2 w-[340px]" data-live-search="true" name="{{$form->prop}}" id="{{$form->prop}}">
                    <option value="" disabled selected>pilih</option>
                    @foreach($form->options as $key=>$option)
                    <option value="{{$option['id']}}">{{$option["name"]}}</option>
                    @endforeach
                </select>
                @elseif($form->type == 'file')
                <label for="dropzone-file" class="flex flex-col justify-center items-center w-[340px] h-32 bg-gray-50 rounded-lg border-2 border-gray-300 border-dashed cursor-pointer dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                    <div class="flex flex-col justify-center items-center pt-5 pb-6">
                        <img src="{{ asset('/Icon-svg/file.svg') }}" />
                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, or JPG (Ukuran : 400px x 400px)</p>
                    </div>
                    <input id="dropzone-file" accept="image/x-png,image/gif,image/jpeg" name="{{$form->prop}}_file" type="file" class="hidden" id="{{$form->prop}}" />
                </label>
                @elseif($form->type == 'checkbox')
                <div class="grid grid-flow-row-dense grid-cols-2">
                    @foreach($form->options as $key=>$option)
                    <div class="flex justify-between items-center w-[170px]">
                        <label class="switch">
                            <input type="checkbox" name="{{$option->id}}">
                            <span class="slider round"></span>
                        </label>
                        <span class="mr-[10px]">{{$option->name}}</span>
                    </div>
                    @endforeach
                </div>
                @else
                <input class="border-1 border-gray-400 pl-2 pr-[150px] py-2 text-black mb-2" type="{{$form->type}}" name="{{$form->prop}}">
                @endif
            </div>
        </div>
    </div>
    @endforeach
    <div class="flex justify-end">
        <button class="bg-buttonColor-900 text-white p-3 mr-[150px] mt-3 rounded-xl" type="submit">Simpan Perubahan</button>
    </div>
</form>

@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<script>
    const Kabupaten = @json($Kabupaten);
    const Kecamatan = @json($Kecamatan);
    const Kelurahan = @json($Kelurahan);

    const changeKabupaten = () => {
        const kabupatenFilter = document.getElementById('city_val');
        const idKabupaten = kabupatenFilter.options[kabupatenFilter.selectedIndex].value;
        renderKecamatan(idKabupaten)
    }

    const renderKecamatan = (idKabupaten) => {
        var str = `<option value=''>Semua</option>`
        const kecamatanList = Kecamatan.filter(e => e.id_kabupaten == idKabupaten);
        for (let item of kecamatanList) {
            str += `<option value='${item.id}'>` + item.name + "</option>"
        }

        document.getElementById("district_val").innerHTML = str;
    }

    const changeKecamatan = () => {
        const KecamatanFilter = document.getElementById('district_val');
        const idKecamatan = KecamatanFilter.options[KecamatanFilter.selectedIndex].value;
        renderKelurahan(idKecamatan)
    }

    const renderKelurahan = (idKecamatan) => {
        var str = `<option value=''>Semua</option>`
        const kelurahanList = Kelurahan.filter(e => e.id_kecamatan == idKecamatan);

        for (let item of kelurahanList) {
            str += `<option value='${item.id}'>` + item.name + "</option>"
        }
        document.getElementById("village_val").innerHTML = str;
    }
</script>