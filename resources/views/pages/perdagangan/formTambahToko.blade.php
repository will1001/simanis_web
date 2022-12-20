@extends("layouts.perdagangan")

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
    )
];
$legalitasUsaha = [
    (object)array(
        "id" => "FORMAL",
        "name" => "FORMAL"
    ),
    (object)array(
        "id" => "INFORMAL",
        "name" => "INFORMAL"
    )
];
$forms = array(
    (object)array(
        "type" => "text",
        "placeholder" => "Nama Toko",
        "prop" => "name"
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
    (object)array(
        "type" => "text",
        "placeholder" => "ID Provinsi",
        "prop" => "province_id"
    ),
    (object)array(
        "type" => "select",
        "placeholder" => "Provinsi",
        "prop" => "province_val",
        "options" => $Kabupaten["return"],
        "change" => "return changeKabupaten()",
    ),
    (object)array(
        "type" => "text",
        "placeholder" => "ID Kota",
        "prop" => "city_id"
    ),
    (object)array(
        "type" => "select",
        "placeholder" => "Kabupaten / Kota",
        "prop" => "city_val",
        "options" => $Kabupaten["return"],
        "change" => "return changeKabupaten()",
    ),
    (object)array(
        "type" => "text",
        "placeholder" => "ID Kecamatan",
        "prop" => "district_id"
    ),
    (object)array(
        "type" => "select",
        "placeholder" => "Kecamatan",
        "prop" => "district_val",
        "options" => $Kabupaten["return"],
        "change" => "return changeKabupaten()",
    ),
    (object)array(
        "type" => "text",
        "placeholder" => "ID Desa",
        "prop" => "district_id"
    ),
    (object)array(
        "type" => "select",
        "placeholder" => "Desa",
        "prop" => "village_id",
        "options" => $Kabupaten["return"],
        "change" => "return changeKabupaten()",
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
        "type" => "select",
        "placeholder" => "Kurir",
        "prop" => "courier",
        "options" => $Kabupaten["return"],
        "change" => "return changeKabupaten()",
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
<form method="POST" action="/" enctype="multipart/form-data">
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
    // const Kabupaten = @json($Kabupaten["return"]);

    // $.ajax({
    //     url: "https://absensinow.id/api/city",
    //     headers: {
    //         "signature": "mns-1275151",
    //         'Access-Control-Allow-Origin': '*',
    //         'Access-Control-Allow-Headers': '*',
    //         'Content-Type': 'application/json'
    //     },
    //     contentType: 'application/json',
    //     type: 'GET',
    //     crossDomain: true,
    //     dataType: 'json', // added data type
    //     success: function(res) {
    //         console.log(res);
    //         // alert(res);
    //     }
    // });

    // window.axios = require('axios');
    // const axios = require('axios');
    // console.log(babik);
    // window.axios.get('https://jsonplaceholder.typicode.com/todos')
    //     .then(res => console.log(res.data))
    //     .catch(err => console.log(err));  


    // const xmlHttp = new XMLHttpRequest();
    // xmlHttp.open( "GET", "https://dev.lallo.id/v0/fast_boat/locationPorts?type=departure", false ); // false for synchronous request
    // // xmlHttp.setRequestHeader("signature", "mns-1275151");
    // // xmlHttp.setRequestHeader("Content-Type", "application/json");
    // xmlHttp.send( null );
    // console.log(xmlHttp.responseText);

    const changeKabupaten = () => {
        const kabupatenFilter = document.getElementById('province_val');
        const idKabupaten = kabupatenFilter.options[kabupatenFilter.selectedIndex].value;
        console.log(idKabupaten);
        const xmlHttp = new XMLHttpRequest();
        xmlHttp.open("GET", "https://absensinow.id/api/district/" + idKabupaten, true); // false for synchronous request
        xmlHttp.setRequestHeader("signature", "mns-1275151");
        // xmlHttp.setRequestHeader("Content-Type", "application/json");
        xmlHttp.send(null);
        console.log(xmlHttp.responseText);

    }
</script>