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
        
        <div onclick="lihatDetails()" class="flex p-2 {{is_null($BadanUsaha->nama_usaha)?'bg-blue-300':'bg-buttonColor-900'}} cursor-pointer text-white rounded-xl"><img class="mr-1" src="{{ asset('/icon svg/dana.svg') }}"> <span>Pengajuan Dana</span></div>
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
    <td class="text-center p-2"><span 
      class="{{$statusClass}} p-2 rounded-xl">{{$item->status}}</span></td>
    <td class="text-center p-4 ">{{$item->alasan}}</td>
  </tr>
  @endforeach

</table>
<div onclick="closeDetails()" style="visibility: collapse;" id="detailPopUpBlackbg" class="bg-black opacity-40 w-full h-full absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 opacity-30">
</div>
<div style="visibility: collapse;" id="detailPopUp" class="bg-white rounded-xl popUpContainer absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 p-4">
<h4>Ajukan Dana</h4>
<br/>
<form action="{{url('ajukan_dana')}}" method="post">
@csrf
    <span>Jumlah dana</span>
    <input class="border-1 border-black" type="number" name="jumlah_dana">
    <br>
    <span>Instansi</span>
    <br>
    <select name="instansi">
      <option value="BANK">BANK</option>
      <option value="KOPERASI">KOPERASI</option>
    </select>
    <br>
    <span>Akad</span>
    <br>
    <select name="jenis_pengajuan">
      <option value="Murobhahah">Murobhahah</option>
      <option value="Mudharobah">Mudharobah</option>
      <option value="Musyarakah">Musyarakah</option>
    </select>
    <br>

    <button>submit</button>
</form>
    
</div>

@endsection

<script>
  const badanUsaha = @json($BadanUsaha);

  const lihatDetails = ()=>{
    if(badanUsaha.nama_usaha === null){
      alert("Isi nama Badan Usaha terlebih Dahulu");
    }else{
      const blackBg = document.getElementById('detailPopUpBlackbg');
      const detailPopUp = document.getElementById('detailPopUp');
      blackBg.style.visibility = "visible";
      detailPopUp.style.visibility = "visible";
    }
    
  }
  const closeDetails = ()=>{
    const blackBg = document.getElementById('detailPopUpBlackbg');
    const detailPopUp = document.getElementById('detailPopUp');
    blackBg.style.visibility = "collapse";
    detailPopUp.style.visibility = "collapse";
  }
</script>