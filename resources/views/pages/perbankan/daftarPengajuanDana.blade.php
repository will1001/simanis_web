@extends('layouts.perbankan')
<style>
    .badan_usaha_container {
        width: 990px;
        height: 80px;
    }

    p,
    .btn {
        margin: 20px 0;
    }

    .boxCari {
        width: 206px;
        height: 48px;
    }

    .boxKab {
        width: 192px;
        height: 48px;
    }

    .boxKal {
        width: 52px;
        height: 48px;
    }

    .boxStat {
        width: 160px;
        height: 48px;
    }

    .panjangInput {
        width: 146px;
        height: 18px;
    }

    .ml1 {
        margin-left: 145px;
    }

    .borderM {
        border-style: solid;
        border-color: red;
    }

    .iconSize {
        width: 11.67px;
        height: 5.83px;
    }
</style>
@section('content')
<h2 class="ml-4">Daftar Pembiayaan Usaha</h2>

<!-- <div class="flex flex-row badan_usaha_container ml-4 mt-4">
    <div class="flex gap-2 boxCari border rounded-md shadow-md bg-white">
        <img src="{{ asset('/Icon-svg/medium.svg') }}" alt="icon" class="flex h-8 w-8 ml-2 my-auto">
        <input type="text" placeholder="Cari Badan Usaha" class="my-auto panjangInput ml-1 placeholder:text-sm">
    </div>
    <div class="flex boxStat border rounded-md shadow-md ml-3 cursor-pointer whitespace-nowrap bg-white">
        <label for="role" class="flex text-slate-800 text-sm font-bold my-auto ml-3 h-[17px]  ">Semua Status</label>
        <input type="radio" id="role" name="role" class="hidden">
        <img src="{{ asset('/Icon-svg/icon.svg') }}" alt="role" class="flex mx-3 my-auto ">
    </div>
    <div class="flex border rounded-md shadow-md ml-3 cursor-pointer boxKab whitespace-nowrap bg-white ">
        <label for="role" class=" text-slate-800 text-sm font-bold my-auto ml-5 h-[17px] ">Semua Kab/Kota</label>
        <input type="radio" id="role" name="role" class="hidden">
        <img src="{{ asset('/Icon-svg/icon.svg') }}" alt="role" class="flex mx-auto my-auto">
    </div>   
    <div class="flex border rounded-md shadow-md ml-3 cursor-pointer boxKal bg-white">
        <img src="{{ asset('/Icon-svg/iconDate.svg') }}" alt="icon" class="flex my-auto mx-auto">
    </div>
    <div class="flex border borderM boxKab rounded-lg cursor-pointer ml1">       
            <input type="button" value="Hapus Pengajuan" class="text-ditolakTextColor text-sm font-bold my-auto mx-auto">
            <img src="{{ asset('/Icon-svg/sampahMerah.svg') }}" alt="role" class="flex my-auto mx-auto">       
    </div>
</div> -->



<div class="flex justify-end mr-[70px]">
    <form action="/export/dana/perbankan" method="GET">
        <button class="flex items-center bg-menungguTextColor rounded-xl text-white px-3 py-2" type="submit" id="button-addon2"><img src="{{ asset('/Icon-svg/ekspor.svg') }}" class="mr-2"> <span>Export</span></button>
    </form>
</div>

<table class="badan_usaha_container  bg-white mt-3 h-20 w-[940px]">
    <tr class="bg-tableColor-900 text-white text-center h-16 gap-3">
        <!-- <th class="cursor-pointer text-center pl-2 rounded-tl-xl"><span class="py-auto px-1 border-2 rounded-md"><input type="checkbox" name="all" id="all" class=" invisible "></span></th> -->
        <th class="text-center p-2 rounded-tl-xl">No</th>
        <th class="text-left p-2 ">Badan Usaha</th>
        <!-- <th class="text-left p-2 ">Nama Pemilik</th> -->
        <th class="text-left p-2 ">NIK</th>
        <th class="text-left ">
            <div class="flex text-left gap-1 my-auto ml-5  "><img src="{{ asset('/Icon-svg/iconBawahAtas.svg') }}" alt="" class="flex"> Kabupaten</div>
        </th>
        <th class="text-left">
            <div class="flex justify-center gap-1 my-auto "><img src="{{ asset('/Icon-svg/iconBawahAtas.svg') }}" alt="" class="flex"> Jumlah Dana</div>
        </th>
        <th class="text-left p-2 "><span class="flex justify-center my-auto">Jangka Waktu</span></th>
        <th class="text-left p-2 "><span class="flex justify-center my-auto mx-6">Tanggal</span></th>
        <th class="text-left p-2 "><span class="">Status</span></th>
        <th class="rounded-tr-xl">Aksi</span></th>
    </tr>
    @foreach($PengajuanDana as $key=>$item)
    @php
    $statusClass = '';
    if($item->status == "Menunggu"){
    $statusClass = 'bg-menungguBgColor text-menungguTextColor';
    }
    if($item->status == "Ditolak"){
    $statusClass = 'bg-ditolakBgColor text-ditolakTextColor';
    }
    if($item->status == "Diterima"){
    $statusClass = 'bg-disetujuiBgColor text-disetujuiTextColor';
    }
    @endphp
    <tr class="bg-white h-14 gap-2">
        <!-- <td class="cursor-pointer text-center pl-2"><span class="py-auto px-1 border-2 rounded-md"><input type="checkbox" name="all" id="all" class=" invisible "></span></th> -->
        <td class="text-center text-slate-700 ">{{++$key}}</td>
        <td class="text-left text-slate-700 font-bold p-2 ">{{$item->nama_usaha}}</td>
        <!-- <td class="text-left text-slate-700 font-bold p-2 ">{{$item->nama_direktur}}</td> -->
        <td class="text-left text-slate-700 font-bold p-2 ">{{$item->nik}}</td>
        <td class="text-left "><span class="flex text-left my-auto ml-5 w-[120px]">{{$item->kabupaten}}</span></td>
        <td class="text-left text-slate-700 font-bold"><span class="flex justify-center gap-1 my-auto ">{{number_format($item->jumlah_dana)}}</span></td>
        <td class="text-left text-slate-700 font-bold"><span class="flex justify-center gap-1 my-auto ">{{$item->waktu_pinjaman}}</span></td>
        <td class="text-center p-2">{{date('d-m-Y', strtotime($item->dana_updated_at))}}</td>
        <td class="text-left p-2"><span class="{{$statusClass}} p-2 rounded-xl">{{$item->status}}</span></td>
        <td class="text-center p-2 w-[200px] cursor-pointer">
            <div class="flex ml-2 gap-1 justify-start items-center ">
                <form method="GET" action="/perbankan/dashboard/ProfilBadanUsaha/{{$item->id}}">
                    <button>
                        <img class="w-[60px]" src="{{ asset('/Icon-svg/mata.svg') }}" alt="icon">
                    </button>
                </form>
                <form action="#">
                    <button onclick="openPopUpProses('{{$item->dana_id}}')" class="bg-orange-400 text-white p-[5px] rounded-lg"><img class="w-[90px] h-[25px]" src="{{ asset('/Icon-svg/sand-clock.svg') }}" alt="icon"></button>
                </form>
                <form class="bg-disetujuiTextColor text-white p-1 rounded-lg flex" action="/bank/dana/{{$item->dana_id}}/status/Diterima" method="post">
                    @csrf
                    <input type="text" value="{{$item->nik}}" name="nik" style="display:none;">
                    <button><img class="w-[40px]" src="{{ asset('/Icon-svg/ceklist.svg') }}" alt="icon"></button>
                </form>
                <form action="#">
                    <button onclick="openPopUp('{{$item->dana_id}}')" class="bg-ditolakTextColor text-white p-1 rounded-lg"><img class="w-[65px]" src="{{ asset('/Icon-svg/dilarang.svg') }}" alt="icon"></button>
                </form>
            </div>
        </td>
    </tr>
    @endforeach

</table>

<div class="flex badan_usaha_container bg-white ml-4 justify-between">
    <div class="flex ml-4 my-auto">
        <div class="flex bg-white rounded-lg shadow-md w-48 h-9 border-slate-200">
            <div class="flex border px-3 rounded-md">
                <label for="role" class="text-slate-400 text-sm my-auto ">10</label>
                <button class=""></button>
                <img src="{{ asset('/Icon-svg/panahbawah.svg') }}" alt="role" class="my-auto ml-1 cursor-pointer">
            </div>
            <span class="text-slate-400 text-sm my-auto ml-4">showing 1 - 10 of 85</span>
        </div>
    </div>

    <div class="flex items-end my-auto mr-4">
        <div class="flex gap-3 mx-3 my-auto">
            <button><img src="{{ asset('/Icon-svg/previous.svg') }}" alt="icon"></button>
            <button><img src="{{ asset('/Icon-svg/back.svg') }}" alt="icon"></button>
        </div>
        <div class="flex mx-3">
            <button><span class="bg-blue-200 text-disetujuiTextColor py-1 px-3 rounded-md">1</span></button>
            <button><span class="py-1 px-3 rounded-md">2</span></button>
            <button><span class="py-1 px-3 rounded-md">3</span></button>
            <button><span class="py-1 px-3 rounded-md">4</span></button>
        </div>
        <div class="flex gap-3 my-auto">
            <button><img src="{{ asset('/Icon-svg/next.svg') }}" alt="icon"></button>
            <button><img src="{{ asset('/Icon-svg/skip.svg') }}" alt="icon"></button>
        </div>
    </div>
</div>

<div onclick="closeDetails()" style="visibility: collapse;" id="detailPopUpBlackbg" class="bg-black opacity-40 w-full h-full absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 opacity-30">
</div>
<div style="visibility: collapse;" id="detailPopUp" class="bg-white rounded-xl popUpContainer absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 p-4 w-80">
    <h4>Penolakan Pembiayaan</h4>
    <br />
    <form action="" method="post" id="formPenolakan">
        @csrf

        <div class="flex items-center justify-between">
            <span>Alasan Penolakan</span>
            <textarea class="border-2 border-gray-300 w-[70%]" name="alasan" rows="7" required></textarea>
        </div>

        <div class="flex items-center justify-end mt-[100px]">
            <div onclick="closeDetails()" class=" cursor-pointer border-1 border-gray-400 rounded-xl px-4 py-2 mr-3">Batalkan</div>
            <button class="rounded-xl px-4 py-2 bg-blue-500 text-white">Submit</button>
        </div>
    </form>

</div>
<div style="visibility: collapse;" id="detailPopUpProses" class="bg-white rounded-xl popUpContainer absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 p-4 w-80">
    <h4>Proses Pembiayaan</h4>
    <br />
    <form action="" method="post" id="formProses">
        @csrf

        <div class="flex items-center justify-between">
            <span>Keterangan Proses</span>
            <textarea class="border-2 border-gray-300 w-[70%]" name="alasan" rows="7" required></textarea>
        </div>

        <div class="flex items-center justify-end mt-[100px]">
            <div onclick="closeDetails()" class=" cursor-pointer border-1 border-gray-400 rounded-xl px-4 py-2 mr-3">Batalkan</div>
            <button class="rounded-xl px-4 py-2 bg-blue-500 text-white">Submit</button>
        </div>
    </form>

</div>

@endsection
<script>
    const openPopUp = (id_pengajuan_dana) => {

        const blackBg = document.getElementById('detailPopUpBlackbg');
        const detailPopUp = document.getElementById('detailPopUp');
        const formPenolakan = document.getElementById('formPenolakan');
        blackBg.style.visibility = "visible";
        detailPopUp.style.visibility = "visible";
        formPenolakan.action = `/bank/dana/${id_pengajuan_dana}/status/Ditolak`;

    }
    const openPopUpProses = (id_pengajuan_dana) => {

        const blackBg = document.getElementById('detailPopUpBlackbg');
        const detailPopUpProses = document.getElementById('detailPopUpProses');
        const formProses = document.getElementById('formProses');
        blackBg.style.visibility = "visible";
        detailPopUpProses.style.visibility = "visible";
        formProses.action = `/bank/dana/${id_pengajuan_dana}/status/Menunggu`;

    }
    const closeDetails = () => {
        const blackBg = document.getElementById('detailPopUpBlackbg');
        const detailPopUp = document.getElementById('detailPopUp');
        const detailPopUpProses = document.getElementById('detailPopUpProses');

        blackBg.style.visibility = "collapse";
        detailPopUp.style.visibility = "collapse";
        detailPopUpProses.style.visibility = "collapse";

    }
</script>