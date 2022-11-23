@extends('layouts.member')
<style>
  .actionContainer {
    width: 1000px;
  }

  .popUpContainer {
    width: 900px;
    height: 600px
  }

  .imgSize {
    width: 80px;
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

@if($userDataProgress[0] >= 100)

<div>
  <div class="flex justify-end items-center actionContainer">
    <!-- <div class="p-2 bg-white mr-2 rounded-xl cursor-pointer"><img src="{{ asset('/Icon-svg/notif.svg') }}"></div> -->
    <div onclick="openForm()" class="flex p-2 bg-buttonColor-900 cursor-pointer text-white rounded-xl"><img class="mr-1" src="{{ asset('/Icon-svg/dana-white.svg') }}"> <span>Tambah Produk</span></div>
  </div>
  <div class="flex items-center actionContainer">
    <h5>Produk</h5>
  </div>
  <table class="actionContainer rounded-2xl">
    <tr class="bg-tableColor-900 text-center text-white p-2">
      <th class="text-center p-2 rounded-tl-xl">No</th>
      <th class="text-center p-2 ">Foto Poduk</th>
      <th class="text-center p-2 ">Nama</th>
      <th class="text-center p-2 ">Harga</th>
      <!-- <th class="text-center p-2 ">Halal</th> -->
      <!-- <th class="text-center p-2 ">SNI</th> -->
      <!-- <th class="text-center p-2 ">Haki</th> -->
      <th class="text-center p-2 rounded-tr-xl">Aksi</th>
    </tr>
    @php
    $index = 0;
    @endphp
    @foreach($Produk as $key=>$item)


    <tr>
      <td class="text-center p-4 ">{{++$key}}</td>
      <td class="text-center p-1 imgSize"><img src="{{ asset($item->foto) }}" alt=""></td>
      <td class="text-center p-4 ">{{$item->nama}}</td>
      <td class="text-center p-4 ">{{$item->harga}}</td>
      <!-- <td class="text-center p-4 "><span class="bg-halalBgColor text-halalTextColor p-2 rounded-xl">{{is_null($item->sertifikat_halal)?"Tidak Ada":"Ada"}}</span></td> -->
      <!-- <td class="text-center p-2"><span class="bg-menungguBgColor text-menungguTextColor p-2 rounded-xl">{{is_null($item->sertifikat_haki)?"Tidak Ada":"Ada"}}</span></td> -->
      <!-- <td class="text-center p-2"><span class="bg-disetujuiBgColor text-disetujuiTextColor p-2 rounded-xl">{{is_null($item->sertifikat_sni)?"Tidak Ada":"Ada"}}</span></td> -->
      <td class=" flex items-center justify-center text-center p-4 text-disetujuiTextColor cursor-pointer">
        <form onclick="lihatDetails({{$index++}})" action="#" class="mr-3">Lihat Detail</form>
        <form method="GET" action="/user/hapus_produk/{{$item->id}}" class="p-2 bg-buttonDelete rounded-md">
          <button>
            <img class="h-[21px]" src="{{ asset('/Icon-svg/delete.svg') }}" alt="icon">
          </button>
        </form>
      </td>
      <!-- <td class="text-center p-4 flex items-end justify-center">
        <form onclick="lihatDetails({{$index++}})" action="#" class="mr-2">
          <button  type="button">
            <img class="h-[32px]" src="{{ asset('/Icon-svg/mata.svg') }}" alt="icon">
          </button>
        </form>
        <form method="GET" action="/form/admin/{{$item->id}}">
            <button class="bg-buttonColor-900 px-[30px] py-[10px] rounded-xl text-white mr-2" type="submit" id="button-addon2">Edit</button>

          </form>
        <form method="GET" action="/form/badan_usaha/delete/{{$item->id}}" class="p-2 bg-buttonDelete rounded-md">
          <button>
            <img class="h-[21px]" src="{{ asset('/Icon-svg/delete.svg') }}" alt="icon">
          </button>
        </form>
      </td> -->
    </tr>
    @endforeach



  </table>
  <div onclick="closeDetails()" style="visibility: collapse;" id="PopUpBlackbg" class="bg-black opacity-40 w-full h-full absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 opacity-30">
  </div>

  <div style="visibility: collapse;" id="detailPopUp" class="bg-white rounded-xl popUpContainer absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 flex overflow-scroll p-3">
    <img id="fotoProduk" class="h-[400px] w-[400px] object-fill" src="{{ asset('/images/placeholder-image.png') }}" alt="">
    <div class="p-4">
      <h3 id="nama">Sepatu Kain Tenun</h3>
      <!-- <div class="mt-3 mb-3 flex justify-between items-center mr-7 w-[400px]"><span>Sertifikat Halal</span> <span id="sertifikat_halal" class="bg-halalBgColor text-halalTextColor p-2 rounded-xl">Ada</span></div> -->
      <!-- <div class="mt-3 mb-3 flex justify-between items-center mr-7 w-[400px]"><span>Sertifikat HAKI</span> <span id="sertifikat_sni" class="bg-menungguBgColor text-menungguTextColor p-2 rounded-xl">Ada</span></div> -->
      <!-- <div class="mt-3 mb-3 flex justify-between items-center mr-7 w-[400px]"><span>Sertifikat SNI</span> <span id="sertifikat_haki" class="bg-disetujuiBgColor text-disetujuiTextColor p-2 rounded-xl">Ada</span></div> -->
      <h5>Deskripsi Produk</h5>
      <p id="deskripsi"></p>
      <div onclick="closeDetails()" class="flex justify-end items-center mt-5 cursor-pointer">
        <div class="flex pl-16 pr-16 pt-2 pb-2 bg-buttonColor-900 cursor-pointer text-white rounded-xl font-bold text-xl"><span>Ok</span></div>
      </div>
    </div>
  </div>

  <div style="visibility: collapse;" id="formPopUp" class="bg-white text-textColor2 rounded-xl popUpContainer absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 p-3 overflow-scroll">
    <h1>Ajukan Produk</h1>
    <br>
    <form action="{{url('ajukan_produk')}}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="flex justify-between items-center">
        <span>Nama Produk</span>
        <input class="border-2 border-gray-300 w-[73%] p-1 rounded-md" type="text" name="nama">
      </div>
      <br>

      <div class="flex justify-between items-center">
        <span>Harga Produk</span>
        <input class="border-2 border-gray-300 w-[73%] p-1 rounded-md" type="number" name="harga">
      </div>
      <br>
      <!-- <div class="flex justify-between items-center">
        <span>No Sertifikat Halal</span>
        <input class="border-2 border-gray-300 p-1 ml-[77px] w-[40%] rounded-md" type="number" name="sertifikat_halal_no">
        <span>Tahun</span>
        <input class="border-2 border-gray-300 p-1 rounded-md" type="number" name="sertifikat_halal_thn">
      </div>
      <br>
      <div class="flex justify-between items-center">
        <span>No Sertifikat HAKI</span>
        <input class="border-2 border-gray-300 p-1 ml-[79px] w-[40%] rounded-md" type="number" name="sertifikat_haki_no">
        <span>Tahun</span>
        <input class="border-2 border-gray-300 p-1 rounded-md" type="number" name="sertifikat_haki_thn">
      </div>
      <br>
      <div class="flex justify-between items-center">
        <span>No Sertifikat SNI</span>
        <input class="border-2 border-gray-300 p-1 ml-[90px] w-[40%] rounded-md" type="number" name="sertifikat_sni_no">
        <span>Tahun</span>
        <input class="border-2 border-gray-300 p-1 rounded-md" type="number" name="sertifikat_sni_thn">
      </div>
      <br> -->
      <div class="flex items-center justify-between">
        <span>Deskripsi Produk</span>
        <textarea class="border-2 border-gray-300 w-[73%] rounded-md" name="deskripsi" rows="7"></textarea>
      </div>
      <br>
      <div class="flex items-center justify-between">
        <span class="mr-[20px] whitespace-nowrap">Upload Foto</span>
        <div class="flex justify-center items-center w-full ml-[120px]">
          <label for="dropzone-file" class="flex flex-col justify-center items-center w-[600px] h-64 bg-gray-50 rounded-lg border-2 border-gray-300 border-dashed cursor-pointer dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
            <div class="flex flex-col justify-center items-center pt-5 pb-6">
              <img src="{{ asset('/Icon-svg/file.svg') }}" />
              <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
              <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, or JPG (Ukuran : 400px x 400px)</p>
            </div>
            <input onchange="uploadFile('foto_produk',event)" id="dropzone-file" accept="image/x-png,image/gif,image/jpeg" name="foto" type="file" class="hidden" />

          </label>


        </div>

        <input />
      </div>
      <h5 class="ml-[230px]" id="foto_produk"></h5>
      <br>
      <div class="flex items-center justify-start">
        <div onclick="closeDetails()" class=" cursor-pointer border-1 border-gray-400 rounded-xl px-4 py-2 mr-3">Cancel</div>
        <button class="rounded-xl px-4 py-2 bg-blue-500 text-white">Ajukan Sekarang</button>
      </div>
    </form>
  </div>
</div>
@else
<div>
  <h3>Lengkapi Profil Badan Usaha Untuk Mengakses Fitur ini</h3>
</div>
@endif
@endsection
<script>
  const produk = @json($Produk);
  const baseUrl = "http://127.0.0.1:8000";

  const lihatDetails = (index) => {
    const blackBg = document.getElementById('PopUpBlackbg');
    const detailPopUp = document.getElementById('detailPopUp');
    const foto = document.getElementById('fotoProduk');
    const nama = document.getElementById('nama');
    // const sertifikat_halal = document.getElementById('sertifikat_halal');
    // const sertifikat_sni = document.getElementById('sertifikat_sni');
    // const sertifikat_haki = document.getElementById('sertifikat_haki');
    const deskripsi = document.getElementById('deskripsi');
    foto.src = baseUrl + produk[index].foto;
    nama.innerHTML = produk[index].nama;
    // sertifikat_halal.innerHTML = produk[index].sertifikat_halal ? "Ada" : "Tidak Ada";
    // sertifikat_sni.innerHTML = produk[index].sertifikat_sni ? "Ada" : "Tidak Ada";
    // sertifikat_haki.innerHTML = produk[index].sertifikat_haki ? "Ada" : "Tidak Ada";
    deskripsi.innerHTML = produk[index].deskripsi;



    blackBg.style.visibility = "visible";
    detailPopUp.style.visibility = "visible";
  }
  const closeDetails = () => {
    const blackBg = document.getElementById('PopUpBlackbg');
    const detailPopUp = document.getElementById('detailPopUp');
    const formPopUp = document.getElementById('formPopUp');

    blackBg.style.visibility = "collapse";
    detailPopUp.style.visibility = "collapse";
    formPopUp.style.visibility = "collapse";

  }

  const openForm = () => {
    const blackBg = document.getElementById('PopUpBlackbg');
    const formPopUp = document.getElementById('formPopUp');
    blackBg.style.visibility = "visible";
    formPopUp.style.visibility = "visible";

  }

  const uploadFile = (label, e) => {
    const FileLabel = document.getElementById(label);
    FileLabel.innerHTML = e.target.value.split("\\").pop();
  }
</script>