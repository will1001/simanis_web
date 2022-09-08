@extends('layouts.member')
<style>
    .actionContainer{
        width: 800px;
    }
</style>
@section('content')
<div class="flex justify-between items-center actionContainer">
  @if(is_null($BadanUsaha->nama_usaha))
    <div class="flex items-center p-3 rounded-xl bg-ditolakBgColor text-ditolakTextColor">
        <img class="mr-2" src="{{ asset('/icon svg/warning.svg') }}" alt="">
        <span>Data nama badan usaha belum diisi, <strong>Klik Disini </strong> untuk melengkapi</span>
    </div>
  @else
  <div>
    
  </div>
  @endif
    
    <div class="flex">
        
        <div onclick="lihatDetails()" class="flex p-2 {{is_null($BadanUsaha->nama_usaha)?'bg-blue-300':'bg-buttonColor-900'}} cursor-pointer text-white rounded-xl"><img class="mr-1" src="{{ asset('/icon svg/dana-white.svg') }}"> <span>Pengajuan Dana</span></div>
    </div>
</div>
<div class="flex items-center actionContainer">
   <h5>Histori Pengajuan Dana</h5>
</div>
<table class="actionContainer rounded-2xl">
  <tr class="bg-tableColor-900 text-center text-white p-2">
    <th class="text-center p-2 rounded-tl-xl">No</th>
    <th class="text-center p-2 ">Jumlah Dana</th>
    <th class="text-center p-2 ">Tanggal</th>
    <th class="text-center p-2 ">Instansi</th>
    <th class="text-center p-2 ">Status</th>
    <th class="text-center p-2 rounded-tr-xl">Keterangan</th>
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
  <tr>
    <td class="text-center p-4 ">{{++$key}}</td>
    <td class="text-center p-4 ">{{$item->jumlah_dana}}</td>
    <td class="text-center p-4 ">{{date('d-m-Y', strtotime($item->created_at))}}</td>
    <td class="text-center p-4 ">{{$item->instansi}}</td>
    <td class="text-center p-2"><span 
      class="{{$statusClass}} p-2 rounded-xl">{{$item->status}}</span></td>
    <td class="text-center p-4 ">{{$item->alasan}}</td>
  </tr>
  @endforeach

</table>
<div onclick="closeDetails()" style="visibility: collapse;" id="detailPopUpBlackbg" class="bg-black opacity-40 w-full h-full absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 opacity-30">
</div>
<div style="visibility: collapse;" id="detailPopUp" class="bg-white rounded-xl popUpContainer absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 p-4 w-80">
<h4>Ajukan Dana</h4>
<br/>
<form action="{{url('ajukan_dana')}}" method="post">
@csrf
    
    <div class="flex justify-between items-center">
      <span>Instansi Tujuan</span>
      <select onchange="instansiChange()" id="instansiSelect" class="border-1 border-gray-500 w-[70%] p-2" name="instansi">
        <option value="" disabled  selected>Pilih Instansi</option>
        <option value="96a49730f0f641fe9e770b38f78d3252">BANK</option>
        <option value="3cda5236c97943a79f1e2a62fd7e1ee1">KOPERASI</option>
      </select>
    </div>
    <br>
    <div class="flex justify-between items-center" id="jmlPinjaman"  style="visibility: collapse;">
      <span>Jumlah Pinjaman</span>
      <input class="border-1 border-gray-500 w-[70%] p-2" type="number" name="jumlah_dana">
    </div>
    <div class="flex justify-between items-center" id="jmlDanaSelect"  style="visibility: collapse;">
      <span>Jumlah Pinjaman</span>
      <select onchange="" id="jmlDanaSelectChild"  class="border-1 border-gray-500 w-[70%] p-2" name="jumlah_dana_bank">
        <option value="" disabled  selected>Pilih Jumlah Pinjaman</option>
        <option value="5000000">5.000.000</option>
        <option value="10000000">10.000.000</option>
        <option value="15000000">15.000.000</option>
        <option value="20000000">20.000.000</option>
        <option value="25000000">25.000.000</option>
        <option value="30000000">30.000.000</option>
        <option value="35000000">35.000.000</option>
        <option value="40000000">40.000.000</option>
        <option value="45000000">45.000.000</option>
        <option value="50000000">50.000.000</option>
      </select>
    </div>
    <div class="flex justify-between items-center" id="waktuPinjaman"  style="visibility: collapse;">
      <span>Waktu Pinjaman (/ Bulan)</span>
      <input class="border-1 border-gray-500 w-[70%] p-2" type="number" name="waktu_pinjaman">
    </div>
    <div class="flex justify-between items-center"  style="visibility: collapse;" id="waktuPinjamanSelect">
      <span>Waktu Pinjaman</span>
      <select onchange="jangkaWaktuChange()" id="waktuPinjamanSelectChild"  class="border-1 border-gray-500 w-[70%] p-2" name="jumlah_dana_bank">
        <option value="" disabled  selected>Pilih Jumlah Pinjaman</option>
        <option value="12">12</option>
        <option value="24">24</option>
        <option value="36">36</option>
        <option value="48">48</option>
        <option value="60">60</option>
      </select>
    </div>
    <br>
    <div id="angsuranDiv" style="visibility: collapse;">
      <span>Angsuran Perbulan : </span><span id="angsuranValue"></span>
    </div>
    <div id="detailKoperasi" style="visibility: collapse;">
      <h4>Detail Koperasi</h4>
      <br/>
      <div class="flex justify-between items-center">
        <span>Jenis Akad</span>
        <select class="border-1 border-gray-500 w-[70%] p-2" name="jenis_pengajuan">
          <option value="" disabled  selected>Pilih Jenis Akad</option>
          <option value="Murobhahah">Murobhahah</option>
          <option value="Mudharobah">Mudharobah</option>
          <option value="Musyarakah">Musyarakah</option>
        </select>
      </div>
    </div>
    <br>
    <div class="flex items-center justify-end">
      <div onclick="closeDetails()" class=" cursor-pointer border-1 border-gray-400 rounded-xl px-4 py-2 mr-3">Batalkan</div>
      <button class="rounded-xl px-4 py-2 bg-blue-500 text-white">Ajukan Sekarang</button>
    </div>
</form>
    
</div>

@endsection

<script>
  const badanUsaha = @json($BadanUsaha);
 
  

  const lihatDetails = ()=>{
    const blackBg = document.getElementById('detailPopUpBlackbg');
    const detailPopUp = document.getElementById('detailPopUp');
    if(badanUsaha.nama_usaha === null){
      alert("Isi nama Badan Usaha terlebih Dahulu");
    }else{

      blackBg.style.visibility = "visible";
      detailPopUp.style.visibility = "visible";
    }
    
  }
  const closeDetails = ()=>{
    const blackBg = document.getElementById('detailPopUpBlackbg');
    const detailPopUp = document.getElementById('detailPopUp');
    const instansiSelect = document.getElementById("instansiSelect");
    const detailKoperasi = document.getElementById("detailKoperasi");
    const jmlPinjaman = document.getElementById("jmlPinjaman");
    const waktuPinjaman = document.getElementById("waktuPinjaman");
    const jmlDanaSelect = document.getElementById("jmlDanaSelect");
    const waktuPinjamanSelect = document.getElementById("waktuPinjamanSelect");
    const angsuranDiv = document.getElementById("angsuranDiv");
    blackBg.style.visibility = "collapse";
    detailPopUp.style.visibility = "collapse";
    detailKoperasi.style.visibility = "collapse";
      jmlPinjaman.style.visibility = "collapse";
      waktuPinjaman.style.visibility = "collapse";
      jmlDanaSelect.style.visibility = "collapse";
      waktuPinjamanSelect.style.visibility = "collapse";
      angsuranDiv.style.visibility = "collapse";
  }

  const instansiChange = ()=>{
    const instansiSelect = document.getElementById("instansiSelect");
    const detailKoperasi = document.getElementById("detailKoperasi");
    const jmlPinjaman = document.getElementById("jmlPinjaman");
    const waktuPinjaman = document.getElementById("waktuPinjaman");
    const jmlDanaSelect = document.getElementById("jmlDanaSelect");
    const waktuPinjamanSelect = document.getElementById("waktuPinjamanSelect");
    const angsuranDiv = document.getElementById("angsuranDiv");
    if(instansiSelect.value === "3cda5236c97943a79f1e2a62fd7e1ee1"){
      detailKoperasi.style.visibility = "visible";
      jmlPinjaman.style.visibility = "visible";
      waktuPinjaman.style.visibility = "visible";
      jmlDanaSelect.style.visibility = "collapse";
      waktuPinjamanSelect.style.visibility = "collapse";
      angsuranDiv.style.visibility = "collapse";
    }else{

      detailKoperasi.style.visibility = "collapse";
      jmlPinjaman.style.visibility = "collapse";
      waktuPinjaman.style.visibility = "collapse";
      jmlDanaSelect.style.visibility = "visible";
      waktuPinjamanSelect.style.visibility = "visible";
      angsuranDiv.style.visibility = "visible";
    }
  }

  const jangkaWaktuChange = ()=>{
     
    const angsuranValue = document.getElementById('angsuranValue');
    const jmlDanaSelectChild = document.getElementById('jmlDanaSelectChild');
    const waktuPinjamanSelectChild = document.getElementById('waktuPinjamanSelectChild');
    let angsuran = 0;
    if(waktuPinjamanSelectChild.value === 12){
      angsuran = 451292;
    }
    switch (Number(waktuPinjamanSelectChild.value)) {
      case 12:
      angsuran = 451292;
        break;
      case 24:
      angsuran = 242433;
        break;
      case 36:
      angsuran = 173327;
        break;
      case 48:
      angsuran = 139154;
        break;
      case 60:
      angsuran = 118950;
        break;
    
      default:
      angsuran = 10;
        break;
    }
    angsuranValue.innerHTML = (Number((jmlDanaSelectChild.value)/5000000) * angsuran).toString();
    console.log(waktuPinjamanSelectChild.value);
  }
</script>