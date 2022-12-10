@extends('layouts.admin')
<style>
  .actionContainer {
    width: 1170px;
  }
</style>
@section('content')

<?php
$baseUrl = env('APP_URL');
$fieldTitles = [
  // 'id',
  'NOMOR INDUK KEPENDUDUKAN (NIK)',
  'NAMA',
  'KAB/KOTA',
  'KECAMATAN',
  'KELURAHAN/DESA',
  'ALAMAT LENGKAP',
  'NO. HP',
  'NAMA USAHA',
  'BENTUK USAHA',
  'FILE DOKUMEN BENTUK USAHA',
  'TAHUN BERDIRI',
  // 'LEGALITAS USAHA',
  'NIB/TAHUN',
  'FILE DOKUMEN NIB',
  'NOMOR SERTIFIKAT HALAL/ TAHUN',
  'FILE SERTIFIKAT HALAL',
  'SERTIFIKAT MEREK/TAHUN',
  'FILE SERTIFIKAT MEREK',
  'NOMOR TEST REPORT/TAHUN',
  'SNI/TAHUN',
  'FILE SERTIFIKAT SNI',
  'JENIS USAHA',
  'MEREK USAHA',
  'CABANG INDUSTRI',
  'SUB CABANG INDUSTRI',
  'KBLI',
  'INVESTASI/ MODAL ',
  'JUMLAH TENAGA KERJA PRIA',
  'JUMLAH TENAGA KERJA WANITA',
  'RATA RATA PENDIDIKAN TENAGA KERJA',
  'KAPASITAS PRODUKSI ',
  'SATUAN PRODUKSI',
  'NILAI PRODUKSI ',
  'NILAI BAHAN BAKU ',
  'OMSET',
  'LATITUDE',
  'LONGITUDE',
  'MEDIA SOSIAL',
  'FOTO ALAT PRODUKSI',
  'FOTO RUANG PRODUKSI',
  'PRODUK',
  'KTP',
  'KK',
  'KTP PASANGAN',
];
?>

<!-- <div class="actionContainer">
  <div class="row">
    <div class="col-sm">
      <form name="cariForm" action="{{route('admin_search')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="input-group mb-3">
          <input style="width:200px" type="text" name="keyword" id="keyword" class="form-control" placeholder="Cari . . ." aria-label="Nama Badan Usaha" aria-describedby="button-addon2">
          <button class="btn btn-primary" type="submit" id="button-addon2">Cari</button>
        </div>
      </form>

      @if($keyword != "")
      <h5>Hasil Pencarian dari : {{$keyword}}</h5>
      @endif
    </div>
    <div class="col-sm"></div>
  </div> -->
<div class="flex justify-between">
  <form name="cariForm" action="{{route('admin_search')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="flex">
      <div class="flex items-center shadow-md py-1 px-2 rounded-xl mr-2">
        <i class="fa fa-search mr-3"></i>
        <input style="width:200px" type="text" name="keyword" id="keyword" class="form-control" placeholder="Cari . . ." aria-label="Nama Badan Usaha" aria-describedby="button-addon2">
      </div>
      <button class="bg-buttonColor-900 px-[30px] py-[10px] rounded-xl text-white" type="submit" id="button-addon2">Cari</button>
    </div>
  </form>
  <div class="flex">
    <a onclick="openHapusBadanUsahaPopUp()" href="#" class="flex items-center bg-buttonDelete px-[10px] py-[5px] rounded-xl text-white h-[50px] mr-[10px]">Hapus Per Kabupaten</a>
    <a href="{{ url('/form/admin/')}}" class="flex items-center bg-buttonColor-900 px-[10px] py-[5px] rounded-xl text-white h-[50px]">Tambah Data</a>
  </div>
  <!-- <div class="col-sm">
      <form name="importForm" action="/admin/data/import" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
        @csrf
        <div class="input-group mb-3">
          <input require type="file" name="file" id="file" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
          <button onclick="import()" class="btn btn-primary" type="submit" id="button-addon2">Import</button>
        </div>
      </form>

      @if(!$BadanUsaha->isEmpty())
      <button class="btn btn-primary" type="submit" id="button-addon2"><a href="{{ url('/admin/data/export')}}" style="text-decoration:none;color:white">Export</a></button>
      <form action="{{ route('admin_delete_all')}}" method="GET">
        <button onclick="return confirm_delete()" class="btn btn-primary float-right" type="submit" id="button-addon2">Hapus Semua Data</button>
      </form> 
      <button class="btn btn-primary" type="submit" id="button-addon2"><a href="{{ url('/form/admin/')}}" style="text-decoration:none;color:white">Tambah Data</a></button>
      @endif
    </div> -->

</div>
@php
$index = 0;
@endphp

<div class="Container-Table">
  <div class="table-responsive m-2 " style="max-height:500px;">
    <table class="actionContainer rounded-2xl whitespace-nowrap">
      <tr class="bg-tableColor-900 text-center text-white p-2">
        <!-- <th class="text-center p-2 rounded-tl-xl">#</th> -->
        <th class="text-center p-2 rounded-tl-xl">No</th>
        <th class="text-center p-2 ">Nama Pemilik</th>
        <th class="text-center p-2 ">Nama Usaha</th>
        <th class="text-center p-2 ">NIK</th>
        <th class="text-center p-2 ">Kab/Kota</th>
        <th class="text-center p-2 rounded-tr-xl">Aksi</th>
      </tr>
      @foreach($BadanUsaha as $key=>$item)

      <tr>

        <td class="text-center p-4 ">{{ (++$key + (100* ((int)$BadanUsaha->currentPage() -1) ) ) }}</td>
        <td class="text-center p-4 ">{{$item->nama_direktur}}</td>
        <td class="text-center p-4 ">{{$item->nama_usaha}}</td>
        <td class="text-center p-4 ">{{$item->nik}}</td>
        <td class="text-center p-4 ">{{$item->kabupaten}}</td>
        <td class="text-center p-4 flex items-center">
          <form method="GET" action="/admin/daftarPengajuanDana/ProfilBadanUsaha/{{$item->id}}" class="mr-2">
            <button type="submit">
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
        </td>

      </tr>
      @endforeach
    </table>

  </div>
  {{ $BadanUsaha->links() }}
</div>
</div>


<div onclick="closeDetails(event)" style="visibility: collapse;" id="PopUpBlackbg" class="bg-black opacity-40 w-full h-full absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 opacity-30">
</div>

<div style="visibility: collapse;" id="detailPopUp" class="bg-white rounded-xl popUpContainer absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 flex overflow-scroll p-3  ">
  <div>
    <h3>Detail Badan Usaha</h3>
    <div id="listDataBadanUsaha" class="w-[780px] h-[300px] px-3 pb-[100px] overflow-auto"></div>
    <div class="flex justify-center">
      <button onclick="closeDetails(event)" class="bg-buttonColor-900 px-4 py-2 text-white">OK</button>
    </div>
  </div>
</div>
<div style="visibility: collapse;" id="detailPopUpHapusBadanUsaha" class="bg-white rounded-xl popUpContainer absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 flex overflow-scroll p-3">
  <div>
    <h3>Hapus Data Per Kabupaten/Kota</h3>
    <form action="{{route('admin_delete_per_kabupaten')}}" method="post">
      @csrf
      @foreach($Kabupaten as $key=>$item)
      <input type="checkbox" name="{{$item->name}}" value="{{$item->id}}"><span class="ml-2">{{$item->name}}</span>
      <br>
      @endforeach
      <div class="flex justify-center">
        <div class="flex justify-center mr-3">
          <button onclick="closeDetails(event)" class="bg-transparent px-4 py-2 text-textColor2 border-1 border-gray-300 rounded-md">Batalkan</button>
        </div>
        <div class="flex justify-center">
          <button class="bg-buttonDelete px-4 py-2 text-white rounded-md">Hapus Data Kab/Kota</button>
        </div>
      </div>
    </form>

  </div>
</div>
@endsection

<script>
  const BadanUsaha = @json($BadanUsaha);
  const fields = @json($fields);
  const fieldTitles = @json($fieldTitles);
  const baseUrl = @json($baseUrl);

  const lihatDetails = (id, e) => {
    // alert(index);
    e.preventDefault();
    const blackBg = document.getElementById('PopUpBlackbg');
    const detailPopUp = document.getElementById('detailPopUp');
    const listDataBadanUsaha = document.getElementById('listDataBadanUsaha');

    blackBg.style.visibility = "visible";
    detailPopUp.style.visibility = "visible";
    listDataBadanUsaha.style.visibility = "visible";

    let i = 0;
    const badan_usaha_by_id = BadanUsaha.data.filter(e => e.id === id);
    // console.log(BadanUsaha.data);
    // console.log(badan_usaha_by_id);
    listDataBadanUsaha.innerHTML = ``;
    for (const field of fields) {
      console.log(field);


      if (field === 'id') {
        let span = document.createElement('span');

        listDataBadanUsaha.appendChild(span);
      } else if (
        field == 'foto_alat_produksi' ||
        field == 'foto_ruang_produksi' ||
        field == 'produk' ||
        field == 'kk' ||
        field == 'ktp' ||
        field == 'ktp_pasangan'
      ) {
        let div = document.createElement('div');
        let h5 = document.createElement('h5');
        let img = document.createElement('img');
        h5.innerHTML = fieldTitles[i];
        img.src = baseUrl + badan_usaha_by_id[0][field];
        img.style.height = '100px';
        div.appendChild(h5);
        div.appendChild(img);
        listDataBadanUsaha.appendChild(div);



      } else if (
        field == 'nib_file' ||
        field == 'bentuk_usaha_file' ||
        field == 'sertifikat_halal_file' ||
        field == 'sertifikat_sni_file' ||
        field == 'sertifikat_merek_file'
      ) {
        let div = document.createElement('div');
        let p = document.createElement('p');
        let a = document.createElement('a');
        p.innerHTML = fieldTitles[i];
        a.innerHTML = "Lihat dokumen";
        a.href = baseUrl + badan_usaha_by_id[0][field];
        div.appendChild(p);
        div.appendChild(a);
        listDataBadanUsaha.appendChild(div);



      } else {
        let p = document.createElement('div');
        let span = document.createElement('span');
        let strong = document.createElement('strong');

        p.className = "flex items-center justify-between";

        span.innerHTML = fieldTitles[i] + " : ";
        console.log(badan_usaha_by_id[0][field])
        strong.innerHTML = badan_usaha_by_id[0][field] === undefined ? '' : badan_usaha_by_id[0][field];

        p.appendChild(span);
        p.appendChild(strong);

        listDataBadanUsaha.appendChild(p);


      }
      i++;
    }



  }

  const closeDetails = (e) => {
    e.preventDefault();
    const blackBg = document.getElementById('PopUpBlackbg');
    const detailPopUp = document.getElementById('detailPopUp');
    const listDataBadanUsaha = document.getElementById('listDataBadanUsaha');
    const detailPopUpHapusBadanUsaha = document.getElementById('detailPopUpHapusBadanUsaha');

    blackBg.style.visibility = "collapse";
    detailPopUp.style.visibility = "collapse";
    listDataBadanUsaha.style.visibility = "collapse";
    detailPopUpHapusBadanUsaha.style.visibility = "collapse";

  }

  function validateForm() {
    let x = document.forms["importForm"]["file"].value;
    if (x == "") {
      alert("Pilih file yang ingin di import");
      return false;
    }
  }

  function confirm_delete() {
    return confirm('Hapus Semua Data ?');
  }

  function confirm_delete_1() {
    return confirm('Hapus Data ?');
  }


  const openHapusBadanUsahaPopUp = () => {
    const blackBg = document.getElementById('PopUpBlackbg');
    const detailPopUpHapusBadanUsaha = document.getElementById('detailPopUpHapusBadanUsaha');

    blackBg.style.visibility = "visible";
    detailPopUpHapusBadanUsaha.style.visibility = "visible";
  }
</script>