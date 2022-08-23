@extends('layouts.member')
<style>
    .actionContainer{
        width: 800px;
    }
</style>
@section('content')
<div class="flex justify-between items-center actionContainer">
    <div class="flex items-center p-3 rounded-xl bg-ditolakBgColor text-ditolakTextColor">
        <img class="mr-2" src="{{ asset('/icon svg/warning.svg') }}" alt="">
        <span>Data nama badan usaha belum diisi, <strong>Klik Disini </strong> untuk melengkapi</span>
    </div>
    <div class="flex">
        <div class="p-2 bg-white mr-2 rounded-xl cursor-pointer"><img src="{{ asset('/icon svg/notif.svg') }}"></div>
        <div class="flex p-2 bg-buttonColor-900 cursor-pointer text-white rounded-xl"><img class="mr-1" src="{{ asset('/icon svg/dana.svg') }}"> <span>Pengajuan Dana</span></div>
    </div>
</div>
<div class="flex items-center actionContainer">
   <h5>Histori Pengajuan Dana</h5>
</div>
<table class="actionContainer rounded-2xl">
  <tr class="bg-tableColor-900 text-center text-white p-2">
    <th class="text-center p-2 rounded-tl-xl">No</th>
    <th class="text-center p-2 ">Badan Usaha</th>
    <th class="text-center p-2 ">Jumlah Dana</th>
    <th class="text-center p-2 ">Tanggal</th>
    <th class="text-center p-2 rounded-tr-xl">Status</th>
  </tr>
  <tr>
    <td class="text-center p-4 ">1</td>
    <td class="text-center p-4 ">Alam Jaya Permai, PT</td>
    <td class="text-center p-4 ">Rp 200.000.000</td>
    <td class="text-center p-4 ">14/08/2020</td>
    <td class="text-center p-2"><span class="bg-ditolakBgColor text-ditolakTextColor p-2 rounded-xl">Ditolak</span></td>
  </tr>
  <tr>
    <td class="text-center p-4 ">2</td>
    <td class="text-center p-4 ">Alam Jaya Permai, PT</td>
    <td class="text-center p-4 ">Rp 200.000.000</td>
    <td class="text-center p-4 ">14/08/2020</td>
    <td class="text-center p-4 "><span class="bg-menungguBgColor text-menungguTextColor p-2 rounded-xl">Menunggu</span></td>
  <tr>
    <td class="text-center p-4 ">3</td>
    <td class="text-center p-4 ">Alam Jaya Permai, PT</td>
    <td class="text-center p-4 ">Rp 200.000.000</td>
    <td class="text-center p-4 ">14/08/2020</td>
    <td class="text-center p-4 "><span class="bg-disetujuiBgColor text-disetujuiTextColor p-2 rounded-xl">Disetujui</span></td>
  </tr>
  <tr>
    <td class="text-center p-4 ">4</td>
    <td class="text-center p-4 ">Alam Jaya Permai, PT</td>
    <td class="text-center p-4 ">Rp 200.000.000</td>
    <td class="text-center p-4 ">14/08/2020</td>
    <td class="text-center p-2"><span class="bg-ditolakBgColor text-ditolakTextColor p-2 rounded-xl">Ditolak</span></td>
  </tr>
  <tr>
    <td class="text-center p-4 ">5</td>
    <td class="text-center p-4 ">Alam Jaya Permai, PT</td>
    <td class="text-center p-4 ">Rp 200.000.000</td>
    <td class="text-center p-4 ">14/08/2020</td>
    <td class="text-center p-4 "><span class="bg-menungguBgColor text-menungguTextColor p-2 rounded-xl">Menunggu</span></td>
  <tr>
    <td class="text-center p-4 ">6</td>
    <td class="text-center p-4 ">Alam Jaya Permai, PT</td>
    <td class="text-center p-4 ">Rp 200.000.000</td>
    <td class="text-center p-4 ">14/08/2020</td>
    <td class="text-center p-4 "><span class="bg-disetujuiBgColor text-disetujuiTextColor p-2 rounded-xl">Disetujui</span></td>
  </tr>
  <tr>
    <td class="text-center p-4 ">7</td>
    <td class="text-center p-4 ">Alam Jaya Permai, PT</td>
    <td class="text-center p-4 ">Rp 200.000.000</td>
    <td class="text-center p-4 ">14/08/2020</td>
    <td class="text-center p-2"><span class="bg-ditolakBgColor text-ditolakTextColor p-2 rounded-xl">Ditolak</span></td>
  </tr>
  <tr>
    <td class="text-center p-4 ">8</td>
    <td class="text-center p-4 ">Alam Jaya Permai, PT</td>
    <td class="text-center p-4 ">Rp 200.000.000</td>
    <td class="text-center p-4 ">14/08/2020</td>
    <td class="text-center p-4 "><span class="bg-menungguBgColor text-menungguTextColor p-2 rounded-xl">Menunggu</span></td>
  <tr>
    <td class="text-center p-4 ">9</td>
    <td class="text-center p-4 ">Alam Jaya Permai, PT</td>
    <td class="text-center p-4 ">Rp 200.000.000</td>
    <td class="text-center p-4 ">14/08/2020</td>
    <td class="text-center p-4 "><span class="bg-disetujuiBgColor text-disetujuiTextColor p-2 rounded-xl">Disetujui</span></td>
  </tr>
 
</table>

@endsection