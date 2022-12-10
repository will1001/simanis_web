@extends('layouts.member')
<style>
  .actionContainer {
    width: 1000px;
  }
</style>
<?php
$baseUrl = env('APP_URL') . '/';
?>
@section('content')
<div class="flex justify-between items-center actionContainer">
  @if($userDataProgress[0] < 100 || is_null($BadanUsaha[0]->nama))
    <div class="flex items-center p-3 rounded-xl bg-ditolakBgColor text-ditolakTextColor">
      <img class="mr-2" src="{{ asset('/Icon-svg/warning.svg') }}" alt="">
      <span>{{$userDataProgress[0] < 100?'Profil Badan Usaha Anda Belum Lengkap (100%)':'Data Produk Anda Masih Kosong'}}, <strong>
          @if($userDataProgress[0] < 100) <a class="" href="/member/dashboard/ProfilBadanUsaha/{{$BadanUsaha[0]->id}}">Klik Disini</a>
            @else
            <a class="" href="/member/produk">Klik Disini</a>
            @endif

        </strong> untuk melengkapi</span>
    </div>
    <div class="flex">
      <div onclick="" class="flex p-2 bg-blue-300 cursor-pointer text-white rounded-xl"><img class="mr-1" src="{{ asset('/Icon-svg/dana-white.svg') }}"> <span>Pembiayaan Usaha</span></div>
    </div>
    @else
    <div>

    </div>
    <div class="flex">
      <div onclick="lihatDetails()" class="flex p-2 bg-buttonColor-900 cursor-pointer text-white rounded-xl"><img class="mr-1" src="{{ asset('/Icon-svg/dana-white.svg') }}"> <span>Pembiayaan Usaha</span></div>
    </div>
    @endif


</div>
<div class="flex items-center actionContainer">
  <h5>Pembiayaan Usaha</h5>
</div>
<table class="actionContainer rounded-2xl">
  <tr class="bg-tableColor-900 text-center text-white p-2">
    <th class="text-center p-2 rounded-tl-xl">No</th>
    <th class="text-center p-2 ">Jumlah Dana</th>
    <th class="text-center p-2 ">Jangka Waktu</th>
    <th class="text-center p-2 ">Tanggal Pengajuan</th>
    <th class="text-center p-2 ">Tanggal Diterima/Ditolak</th>
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
  if($item->status == "Diterima" || $item->status == "Lunas"){
  $statusClass = 'bg-disetujuiBgColor text-disetujuiTextColor';
  }
  @endphp
  <tr>
    <td class="text-center p-4 ">{{++$key}}</td>
    <td class="text-center p-4 ">{{number_format($item->jumlah_dana)}}</td>
    <td class="text-center p-4 ">{{$item->waktu_pinjaman}}</td>
    <td class="text-center p-4 whitespace-nowrap">{{date('d-m-Y', strtotime($item->created_at))}}</td>
    <td class="text-center p-4 whitespace-nowrap">{{date('d-m-Y', strtotime($item->created_at)) == date('d-m-Y', strtotime($item->updated_at)) && $item->status == 'Menunggu' ?'':date('d-m-Y', strtotime($item->updated_at))}}</td>
    <td class="text-center p-4 ">{{$item->nama}}</td>
    <td class="text-center p-2"><span class="{{$statusClass}} p-2 rounded-xl">{{$item->status}}</span></td>
    <td class="text-center p-4 ">
      @if($item->instansi == "KOPERASI")
      {{$item->alasan}} <br>
      @if($item->status == "Diterima" || $item->status == "Lunas")
      <a class="underline text-blue-500" href="{{$baseUrl.$item->file_pinjaman}}"> Download di sini</a>
      @endif
      @else
      {{$item->alasan}} <br>
      @endif
      <!-- @if($item->alasan == "Pembiayaan Usaha Anda diterima Dinas Perindustrian")
      @if(empty($DataPendukung))
      {{$item->alasan}} <br>
      <span onclick="lihatDetailsDataTambahan()" class="text-disetujuiTextColor cursor-pointer">klik Disni</span><br><span> untuk melengkapi data tambahan</span>
      @else
      <span>Menunggu Persetujuan dari {{$item->nama}}</span>
      @endif
      @else
      {{$item->alasan}} <br>
      @endif -->
    </td>
  </tr>
  @endforeach

</table>
<div onclick="closeDetails()" style="visibility: collapse;" id="detailPopUpBlackbg" class="bg-black opacity-40 w-full h-full absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 opacity-30">
</div>
<div style="visibility: collapse;" id="detailPopUpDataTambahan" class="bg-white rounded-xl popUpContainer absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 p-4 w-80">
  <h4>Upload KTP & KK</h4>
  <div class="flex w-full">
    <div>
      <p>Upload Dokumen Pendukung</p>
      <div class="bg-boxColor1 p-4">
        <div>1. Kartu Tanda Penduduk (KTP)</div>
        <div>2. Kartu keluarga (KK)</div>
      </div>
    </div>
    <div class="flex justify-around items-end w-[500px]">
      <form action="/member/data/pendukung" method="post" enctype="multipart/form-data">
        @csrf
        <div class="flex">
          <span class="mr-[100px]">KTP : </span>
          <label for="dropzone-filektp" class="flex flex-col justify-center items-center h-32 bg-gray-50 rounded-lg border-2 border-gray-300 border-dashed cursor-pointer dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600 p-3">
            <div class="flex flex-col justify-center items-center pt-5 pb-6">
              <img src="{{ asset('/Icon-svg/file.svg') }}" />
              <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
              <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, or JPG (Ukuran : 400px x 400px)</p>
            </div>
            <input onchange="uploadKtp(event)" id="dropzone-filektp" accept="image/x-png,image/gif,image/jpeg" name="ktp" type="file" class="hidden" />
          </label>
        </div>
        <h5 id="ktpLabel"></h5>
        <div class="flex">
          <span class="mr-[110px]">KK : </span>
          <label for="dropzone-filekk" class="flex flex-col justify-center items-center h-32 bg-gray-50 rounded-lg border-2 border-gray-300 border-dashed cursor-pointer dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600 p-3">
            <div class="flex flex-col justify-center items-center pt-5 pb-6">
              <img src="{{ asset('/Icon-svg/file.svg') }}" />
              <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
              <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, or JPG (Ukuran : 400px x 400px)</p>
            </div>
            <input onchange="uploadKK(event)" id="dropzone-filekk" accept="image/x-png,image/gif,image/jpeg" name="kk" type="file" class="hidden" />
          </label>
        </div>
        <h5 id="kkLabel"></h5>

        <br>
        <div class="flex justify-end">
          <button class="rounded-xl px-4 py-2 bg-blue-500 text-white">Submit Pengajuan</button>
        </div>

      </form>
    </div>
  </div>

</div>
<div style="visibility: collapse;" id="detailPopUp" class="bg-white rounded-xl popUpContainer absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 p-4 w-80">
  <h4>Ajukan Dana</h4>
  <br />
  <form action="{{url('ajukan_dana')}}" method="post">
    @csrf

    <div class="flex justify-between items-center">
      <span>Instansi Tujuan</span>
      <select onchange="instansiChange()" id="instansiSelect" class="border-1 border-gray-500 w-[70%] p-2" name="instansi">
        <option value="" disabled selected>Pilih Instansi</option>
        @foreach($Instansi as $key=>$item)
        <option value="{{$item->user_id}}">{{$item->nama}}</option>
        @endforeach
      </select>
    </div>
    <br>
    <div class="flex justify-between items-center" id="jmlPinjaman" style="visibility: collapse;">
      <span>Jumlah Pembiayaan</span>
      <input class="border-1 border-gray-500 w-[70%] p-2" type="number" name="jumlah_dana">
    </div>
    <div class="flex justify-between items-center" id="jmlDanaSelect" style="visibility: collapse;">
      <span>Jumlah Pembiayaan</span>
      <select onchange="pinjamanChange()" id="jmlDanaSelectChild" class="border-1 border-gray-500 w-[70%] p-2" name="jumlah_dana_bank">
        <option value="" disabled selected>Pilih Jumlah Pinjaman</option>
      </select>
    </div>
    <div class="flex justify-between items-center" id="waktuPinjaman" style="visibility: collapse;">
      <span>Jangka Waktu (/ Bulan)</span>
      <input class="border-1 border-gray-500 w-[70%] p-2" type="number" name="waktu_pinjaman">
    </div>
    <div class="flex justify-between items-center" style="visibility: collapse;" id="waktuPinjamanSelect">
      <span>Jangka Waktu</span>
      <select onchange="jangkaWaktuChange()" id="waktuPinjamanSelectChild" class="border-1 border-gray-500 w-[70%] p-2" name="jangka_waktu_bank">
        <option value="" disabled selected>Pilih Jangka Waktu</option>
      </select>
    </div>
    <br>
    <div class="flex justify-between items-center" id="angsuranDiv" style="visibility: collapse;">
      <span>Angsuran Perbulan : </span><span id="angsuranValue"></span>
    </div>
    <div id="detailKoperasi" style="visibility: collapse;">
      <h4>Detail Koperasi</h4>
      <br />
      <div class="flex justify-between items-center">
        <span>Jenis Akad</span>
        <select class="border-1 border-gray-500 w-[70%] p-2" name="jenis_pengajuan">
          <option value="" disabled selected>Pilih Jenis Akad</option>
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
  const badanUsaha = @json($BadanUsaha[0]);
  const JumlahPinjaman = @json($JumlahPinjaman);
  const JangkaWaktu = @json($JangkaWaktu);
  const SimulasiAngsuran = @json($SimulasiAngsuran);
  const Instansi = @json($Instansi);
  const PengajuanDana = @json($PengajuanDana);




  const lihatDetails = () => {
    if (PengajuanDana.length !== 0) {
      var result = new Date(PengajuanDana[0].created_at);
      result.setDate(result.getDate() + 14);
      // var a = PengajuanDana[0].created_at;
      var createDate = PengajuanDana[0].created_at;
      var limitDate = result.toISOString()
      // console.log(result.toISOString());
      // console.log(PengajuanDana[0].alasan);
      // console.log(PengajuanDana[0].alasan.includes("Dinas Perindustrian"));
      if (PengajuanDana[0].status === 'Menunggu' || PengajuanDana[0].status === 'Diterima') {
        if (PengajuanDana[0].status === 'Diterima') {
          alert("Anda Memiliki Pinjaman yang Sedang Aktif");
        } else {
          if (createDate < limitDate) {
            alert("Anda Harus Menunggu 14 Hari Untuk Mengajukan Pembiayaan Lagi");
          }
        }


      } else {
        const blackBg = document.getElementById('detailPopUpBlackbg');
        const detailPopUp = document.getElementById('detailPopUp');
        if (badanUsaha.nama_usaha === null) {
          alert("Isi nama Badan Usaha terlebih Dahulu");
        } else {

          blackBg.style.visibility = "visible";
          detailPopUp.style.visibility = "visible";
        }
      }
    } else {
      const blackBg = document.getElementById('detailPopUpBlackbg');
      const detailPopUp = document.getElementById('detailPopUp');
      if (badanUsaha.nama_usaha === null) {
        alert("Isi nama Badan Usaha terlebih Dahulu");
      } else {

        blackBg.style.visibility = "visible";
        detailPopUp.style.visibility = "visible";
      }
    }




  }

  const lihatDetailsDataTambahan = () => {
    const blackBg = document.getElementById('detailPopUpBlackbg');
    const detailPopUpDataTambahan = document.getElementById('detailPopUpDataTambahan');


    blackBg.style.visibility = "visible";
    detailPopUpDataTambahan.style.visibility = "visible";

  }
  const closeDetails = () => {
    const blackBg = document.getElementById('detailPopUpBlackbg');
    const detailPopUp = document.getElementById('detailPopUp');
    const instansiSelect = document.getElementById("instansiSelect");
    const detailKoperasi = document.getElementById("detailKoperasi");
    const jmlPinjaman = document.getElementById("jmlPinjaman");
    const waktuPinjaman = document.getElementById("waktuPinjaman");
    const jmlDanaSelect = document.getElementById("jmlDanaSelect");
    const waktuPinjamanSelect = document.getElementById("waktuPinjamanSelect");
    const angsuranDiv = document.getElementById("angsuranDiv");
    const detailPopUpDataTambahan = document.getElementById('detailPopUpDataTambahan');

    blackBg.style.visibility = "collapse";
    detailPopUp.style.visibility = "collapse";
    detailKoperasi.style.visibility = "collapse";
    jmlPinjaman.style.visibility = "collapse";
    waktuPinjaman.style.visibility = "collapse";
    jmlDanaSelect.style.visibility = "collapse";
    waktuPinjamanSelect.style.visibility = "collapse";
    angsuranDiv.style.visibility = "collapse";
    detailPopUpDataTambahan.style.visibility = "collapse";
  }

  const instansiChange = () => {
    const instansiSelect = document.getElementById("instansiSelect");
    const detailKoperasi = document.getElementById("detailKoperasi");
    const jmlPinjaman = document.getElementById("jmlPinjaman");
    const waktuPinjaman = document.getElementById("waktuPinjaman");
    const jmlDanaSelect = document.getElementById("jmlDanaSelect");
    const waktuPinjamanSelect = document.getElementById("waktuPinjamanSelect");
    const angsuranDiv = document.getElementById("angsuranDiv");
    const jmlDanaSelectChild = document.getElementById('jmlDanaSelectChild');
    const waktuPinjamanSelectChild = document.getElementById('waktuPinjamanSelectChild');
    const instansi_user_id = Instansi.filter(e => e.user_id === instansiSelect.value);

    if (instansiSelect.value === "3cda5236c97943a79f1e2a62fd7e1ee1") {
      detailKoperasi.style.visibility = "visible";
      jmlPinjaman.style.visibility = "visible";
      waktuPinjaman.style.visibility = "visible";
      jmlDanaSelect.style.visibility = "collapse";
      waktuPinjamanSelect.style.visibility = "collapse";
      angsuranDiv.style.visibility = "collapse";

      jmlDanaSelectChild.innerHTML = `<option value="" disabled  selected>Pilih Jumlah Pinjaman</option>`;
      waktuPinjamanSelectChild.innerHTML = `<option value="" disabled  selected>Pilih Jangka Waktu</option>`;



    } else {

      detailKoperasi.style.visibility = "collapse";
      jmlPinjaman.style.visibility = "collapse";
      waktuPinjaman.style.visibility = "collapse";
      jmlDanaSelect.style.visibility = "visible";
      waktuPinjamanSelect.style.visibility = "visible";
      angsuranDiv.style.visibility = "visible";
      const numberFormatter = Intl.NumberFormat('en-US');
      console.log(instansi_user_id[0].id);
      for (const item of JumlahPinjaman.filter(e => e.id_instansi === instansi_user_id[0].id).sort((a, b) => a.jumlah - b.jumlah)) {
        let opt = document.createElement('option');
        opt.value = item.id;
        opt.innerHTML = numberFormatter.format(item.jumlah);
        jmlDanaSelectChild.appendChild(opt);
      }
      for (const item of JangkaWaktu.filter(e => e.id_instansi === instansi_user_id[0].id).sort((a, b) => a.waktu - b.waktu)) {
        let opt = document.createElement('option');
        opt.value = item.id;
        opt.innerHTML = item.waktu;
        waktuPinjamanSelectChild.appendChild(opt);
      }

      // 
    }
  }

  const pinjamanChange = () => {

    const angsuranValue = document.getElementById('angsuranValue');

    const waktuPinjamanSelectChild = document.getElementById('waktuPinjamanSelectChild');

    waktuPinjamanSelectChild.value = "";
    angsuranValue.innerHTML = "";

  }
  const jangkaWaktuChange = () => {

    const angsuranValue = document.getElementById('angsuranValue');

    const jmlDanaSelectChild = document.getElementById('jmlDanaSelectChild');
    const waktuPinjamanSelectChild = document.getElementById('waktuPinjamanSelectChild');

    const instansi_user_id = Instansi.filter(e => e.user_id === instansiSelect.value);

    const simulasi = SimulasiAngsuran.filter(e => e.id_instansi === instansi_user_id[0].id && e.id_jml_pinjaman === jmlDanaSelectChild.value && e.id_jangka_waktu === waktuPinjamanSelectChild.value)
    console.log(simulasi);
    angsuranValue.className = "border-1 border-gray-500 w-[70%] p-2";
    const numberFormatter = Intl.NumberFormat('en-US');

    angsuranValue.innerHTML = numberFormatter.format(Number(simulasi[0].angsuran)).toString();
  }

  const uploadKtp = (e) => {
    const ktpLabel = document.getElementById('ktpLabel');
    ktpLabel.innerHTML = e.target.value.split("\\").pop();
  }
  const uploadKK = (e) => {
    const kkLabel = document.getElementById('kkLabel');
    kkLabel.innerHTML = e.target.value.split("\\").pop();
  }
</script>