@extends('layouts.perdagangan')
<style>
    .badan_usaha_container {
        width: 990px;
    },
    p,
    .btn {
        margin: 20px 0;
    }
    .boxIcon {
        width: 52px;
        height: 48px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.08);
    }
    .boxStat {
        width: 160px;
        height: 48px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.08);
    }
    .boxProduk {
        width: 206px;
        height: 48px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.08);
    }
    .boxInput {
        width: 146px;
        height: 18px;
    }
    .boxNotif {
        width: 357px;
        height: 438px;
        margin-left:570px;
        filter: drop-shadow(0px 100px 80px rgba(0, 0, 0, 0.09)) drop-shadow(0px 41.7776px 33.4221px rgba(0, 0, 0, 0.0646969)) drop-shadow(0px 22.3363px 17.869px rgba(0, 0, 0, 0.0536497)) drop-shadow(0px 12.5216px 10.0172px rgba(0, 0, 0, 0.045)) drop-shadow(0px 6.6501px 5.32008px rgba(0, 0, 0, 0.0363503)) drop-shadow(0px 2.76726px 2.21381px rgba(0, 0, 0, 0.0253031));
    }
    .boxIsiNotif {
        width: 357px;
        height: 105px;
    }
    .warningColor {
        background-color: #F59E0B;
    }
    .bgTabel {
        background-color: #F3F4F6;
    }
    .hTabel {
        height: 72px;
    }
    .imgSize {
        width: 62px;
        height: 62px;
    }
    .bg {
      width: 1440px;
      height: 1183px;
      background: rgba(17, 24, 39, 0.25);
    }
    .hFooter {
        height: 100px;
    }
    .iconSize {
        width: 20px;
        height: 20px;
    }
    .popUpImgSize {
        width: 300px;
        height: 250px;
    }
    .boxPopUp {
        position: absolute;
        width: 676px;
        height: 591px;
        left: 382px;
        top: 105px;
        background: #FFFFFF;
        box-shadow: 0px 138px 109px rgba(0, 0, 0, 0.05), 0px 41.603px 32.8603px rgba(0, 0, 0, 0.04), 0px 17.2797px 13.6485px rgba(0, 0, 0, 0.03), 0px 6.24974px 4.93639px rgba(0, 0, 0, 0.02);
        border-radius: 18px;
    }
    .boxHalal {
        width: 61px;
        height: 30px;
    }
    .boxOk {
        width: 151px;
        height: 41px;
        padding: 9px 14px;
    }

</style>
@section('content')

<div style="visibility: collapse;" id="PopUp" class="bg absolute">
    <div class="boxPopUp flex items-center">
        <div class="flex p-4 gap-4">
            <div class="flex flex-col gap-2">
                <div class="popUpImgSize flex">
                    <img class="" src="{{ asset('/img/produk1.png') }}" alt="produk1">
                </div>
                <div class="flex justify-center gap-2">
                    <img class="cursor-pointer" src="{{ asset('/icon svg/Ellipse 3.svg') }}" alt="Ellipse 3">
                    <img class="cursor-pointer" src="{{ asset('/icon svg/Ellipse 4.svg') }}" alt="Ellipse 4">
                    <img class="cursor-pointer" src="{{ asset('/icon svg/Ellipse 4.svg') }}" alt="Ellipse 4">
                </div>
            </div>
            <div class="flex flex-col gap-2 text-slate-800">
                <h3>Sepatu Kain Tenun</h3>
                <div class="flex gap-5 text-sm"><span class="my-auto">Sertifikat Halal</span><div class="boxHalal rounded-lg bg-halalBgColor text-halalTextColor justify-center flex"><span class="my-auto">Halal</span></div></div>
                <div class="flex gap-5 text-sm"><span class="my-auto">Sertifikat SNI</span><div class="boxHalal rounded-lg bg-disetujuiBgColor text-disetujuiTextColor justify-center flex"><span class="my-auto">SNI</span></div></div>
                <div class="flex gap-5 text-sm"><span class="">Sertifikat HAKI</span><p><span class="font-bold">135135138413035</span><br>Tahun 2022</p></div>
                
                <h6>Deskripsi Produk</h6>
                <p class="text-xs">
                    Sepatu etnik kain tenun bali
                    Tampil gaya, trendy dengan produk yang dibuat dengan bahan yg nyaman dipakai. <br>
                    Sepatu kain tenun bali tersedia berbagai motif dan warna,<br>
                    bahan kain tenun jepara dilapis spon 2 mm + merymesh <br>
                    Outsole : PPC   <br>
                    uk 37 s/d 40    <br>
                    keterangan ukuran : <br>
                    uk 37 = 24 cm   <br>
                    uk 38 = 24.5 cm <br>
                    uk 39 = 25 cm <br>
                    uk 40 = 26 cm <br>

                    sebelum pesan mohon di tanyakan dulu motif dan warna di karenakan motif selalu berubah
                </p>
                <div id="closePopUp" onclick="closeDetails()" class="flex justify-end"><span class="boxOk flex justify-center bg-disetujuiTextColor text-white my-auto font-bold rounded-lg cursor-pointer">OK</span></div>
            </div>
        </div>
    </div>
</div>

<div class="flex badan_usaha_container justify-between">
    <h2 class="ml-4">Produk NTB Mall</h2>
    <div class="flex gap-2">
        <div class="flex boxStat gap-2 text-slate-50 rounded-lg bg-white justify-center cursor-pointer">
            <span class="my-auto">Semua Status</span>
            <img class="iconSize my-auto" src="{{ asset('/icon svg/panahBawah.svg') }}" alt="panahBawah">
        </div>
        <div class="flex boxProduk gap-2 rounded-lg bg-white justify-center cursor-pointer">           
            <img class="iconSize my-auto" src="{{ asset('/icon svg/Medium.svg') }}" alt="Medium">
            <input class="boxInput my-auto" type="text" placeholder="Cari Produk">
        </div>
        <div class="flex boxIcon justify-center bg-white rounded-lg cursor-pointer">
            <img class="iconSize my-auto" src="{{ asset('/icon svg/iconDate.svg') }}" alt="iconDate">
        </div>
    </div>
</div>

<table class="badan_usaha_container ml-4 bg-white mt-3"> 
<tr class="bg-tableColor-900 text-white text-center hTabel  gap-3">
            <th class="cursor-pointer text-center pl-2"><span class="py-auto px-1 border-2 rounded-md"><input type="checkbox" name="all" id="all" class=" invisible "></span></th>
            <th class="text-center p-2 ">No</th>
            <th class="text-center p-2 ">Foto Poduk</th>
            <th class="text-center p-2 ">Nama</th>
            <th class="text-center p-2 ">NIB</th>
            <th class="text-center p-2 ">Kapasitas Produksi</th>
            <th class="text-center p-2 ">Harga</th>
        </tr>
        <tr class=" hTabel bg-white">
            <td class="cursor-pointer text-center pl-2"><span class="py-auto px-1 border-2 rounded-md"><input type="checkbox" name="all" id="all" class=" invisible "></span></td>
            <td class="text-center p-4 text-slate-800">1</td>
            <td onclick="openForm()" id="detailProduk" class="text-center p-1 imgSize cursor-pointer"><img class="mx-auto" src="{{ asset('/img/produk1.png') }}" alt=""></td>
            <td class="text-center p-4 text-slate-800">Sepatu Kain Tenun</td>
            <td class="text-center p-4 text-slate-800">1035138021384</td>
            <td class="text-center p-4 text-slate-800">200/bulan</td>
            <td class="text-center p-4 text-disetujuiTextColor ">Rp 300.000</td>    
        </tr>
        <tr class=" hTabel bgTabel">
            <td class="cursor-pointer text-center pl-2"><span class="py-auto px-1 border-2 rounded-md"><input type="checkbox" name="all" id="all" class=" invisible "></span></td>
            <td class="text-center p-4 text-slate-800">2</td>
            <td class="text-center p-1 imgSize cursor-pointer"><img class="mx-auto" src="{{ asset('/img/produk2.png') }}" alt=""></td>
            <td class="text-center p-4 text-slate-800">Syal Bima Cowok</td>
            <td class="text-center p-4 text-slate-800">1035138021384</td>
            <td class="text-center p-4 text-slate-800">200/bulan</td>
            <td class="text-center p-4 text-disetujuiTextColor ">Rp 300.000</td>    
        </tr>
        <tr class=" hTabel bg-white">
            <td class="cursor-pointer text-center pl-2"><span class="py-auto px-1 border-2 rounded-md"><input type="checkbox" name="all" id="all" class=" invisible "></span></td>
            <td class="text-center p-4 text-slate-800">3</td>
            <td class="text-center p-1 imgSize "><img class="mx-auto" src="{{ asset('/img/produk3.png') }}" alt=""></td>
            <td class="text-center p-4 text-slate-800">Kopi Bubuk Gunung Tambora</td>
            <td class="text-center p-4 text-slate-800">1035138021384</td>
            <td class="text-center p-4 text-slate-800">200/bulan</td>
            <td class="text-center p-4 text-disetujuiTextColor ">Rp 300.000</td>    
        </tr>
        <tr class=" hTabel bgTabel">
            <td class="cursor-pointer text-center pl-2"><span class="py-auto px-1 border-2 rounded-md"><input type="checkbox" name="all" id="all" class=" invisible "></span></td>
            <td class="text-center p-4 text-slate-800">4</td>
            <td class="text-center p-1 imgSize"><img class="mx-auto" src="{{ asset('/img/produk4.png') }}" alt=""></td>
            <td class="text-center p-4 text-slate-800">Kopi Rumput Laut</td>
            <td class="text-center p-4 text-slate-800">1035138021384</td>
            <td class="text-center p-4 text-slate-800">200/bulan</td>
            <td class="text-center p-4 text-disetujuiTextColor ">Rp 300.000</td>    
        </tr>
        <tr class=" hTabel bg-white">
            <td class="cursor-pointer text-center pl-2"><span class="py-auto px-1 border-2 rounded-md"><input type="checkbox" name="all" id="all" class=" invisible "></span></td>
            <td class="text-center p-4 text-slate-800">5</td>
            <td class="text-center p-1 imgSize"><img class="mx-auto" src="{{ asset('/img/produk3.png') }}" alt=""></td>
            <td class="text-center p-4 text-slate-800">Kopi Bubuk Gunung Tambora</td>
            <td class="text-center p-4 text-slate-800">1035138021384</td>
            <td class="text-center p-4 text-slate-800">200/bulan</td>
            <td class="text-center p-4 text-disetujuiTextColor ">Rp 300.000</td>    
        </tr>
 
</table>

<div class="flex badan_usaha_container bg-white ml-4 justify-between">
    <div class="flex ml-4 my-auto">
        <div class="flex bg-white rounded-lg shadow-md w-48 h-9 border-slate-200" >
          <div class="flex border px-3 rounded-md">
            <label for="role" class="text-slate-400 text-sm my-auto ">10</label>
            <button class=""></button>
            <img src="{{ asset('/icon svg/panahbawah.svg') }}" alt="role" class="my-auto ml-1 cursor-pointer">             
          </div>
            <span class="text-slate-400 text-sm my-auto ml-4">showing 1 - 10 of 85</span>                                    
        </div>
    </div>
     
    <div class="flex items-end my-auto mr-4 hFooter rounded-xl">  
        <div class="flex gap-3 mx-3 my-auto"> 
          <button><img src="{{ asset('/icon svg/previous.svg') }}" alt="icon"></button>
          <button><img src="{{ asset('/icon svg/back.svg') }}" alt="icon"></button>
        </div> 
        <div class="flex mx-3 my-auto">
          <button><span class="bg-blue-200 text-disetujuiTextColor py-1 px-3 rounded-md">1</span></button>        
          <button><span class="py-1 px-3 rounded-md">2</span></button>
          <button><span class="py-1 px-3 rounded-md">3</span></button>
          <button><span class="py-1 px-3 rounded-md">4</span></button>
        </div>
        <div class="flex gap-3 my-auto">
          <button><img src="{{ asset('/icon svg/next.svg') }}" alt="icon"></button>
          <button><img src="{{ asset('/icon svg/skip.svg') }}" alt="icon"></button>
        </div>
    </div>

@endsection

<script>

const openForm = ()=>{
    const blackBg = document.getElementById('PopUp');
    blackBg.style.visibility = "visible";

  }

const closeDetails = ()=>{
    const blackBg = document.getElementById('PopUp');
    blackBg.style.visibility = "collapse";

  }

</script>