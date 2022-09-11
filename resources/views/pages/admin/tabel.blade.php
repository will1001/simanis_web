@extends('layouts.admin')
<style>
    <style>
    .actionContainer{
        width: 100px;
    }
</style>
@section('content')

<div class="actionContainer">
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
  </div>
  <div class="row">
    <div class="col-sm">
      <form name="importForm" action="/admin/data/import" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
        @csrf
        <div class="input-group mb-3">
          <input require type="file" name="file" id="file" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
          <button onclick="import()" class="btn btn-primary" type="submit" id="button-addon2">Import</button>
        </div>
      </form>

      @if(!$BadanUsaha->isEmpty())
      <button class="btn btn-primary" type="submit" id="button-addon2"><a href="{{ url('/admin/data/export')}}" style="text-decoration:none;color:white">Export</a></button>
      <!-- <form action="{{ route('admin_delete_all')}}" method="GET">
        <button onclick="return confirm_delete()" class="btn btn-primary float-right" type="submit" id="button-addon2">Hapus Semua Data</button>
      </form> -->
      <button class="btn btn-primary" type="submit" id="button-addon2"><a href="{{ url('/form/admin/')}}" style="text-decoration:none;color:white">Tambah Data</a></button>
      @endif
    </div>

  </div>

  <div class="Container-Table">
    <div class="table-responsive m-2" style="max-height:500px;">
    <table class="actionContainer rounded-2xl whitespace-nowrap">
    <tr class="bg-tableColor-900 text-center text-white p-2">
      <th class="text-center p-2 rounded-tl-xl">#</th>
      <th class="text-center p-2 ">No</th>
      <th class="text-center p-2 ">NOMOR INDUK KEPENDUDUKAN (NIK)</th>
      <th class="text-center p-2 ">NAMA</th>
      <th class="text-center p-2 ">KAB/KOTA</th>
      <th class="text-center p-2 ">KECAMATAN</th>
      <th class="text-center p-2 ">KELURAHAN/DESA</th>
      <th class="text-center p-2 ">ALAMAT LENGKAP</th>
      <th class="text-center p-2 ">NO. HP</th>
      <th class="text-center p-2 ">NAMA USAHA</th>
      <th class="text-center p-2 ">BENTUK USAHA</th>
      <th class="text-center p-2 ">TAHUN BERDIRI</th>
      <th class="text-center p-2 ">LEGALITAS USAHA</th>
      <th class="text-center p-2 ">NIB/TAHUN</th>
      <th class="text-center p-2 ">NOMOR SERTIFIKAT HALAL/ TAHUN</th>
      <th class="text-center p-2 ">SERTIFIKAT MEREK/TAHUN</th>
      <th class="text-center p-2 ">NOMOR TEST REPORT/TAHUN</th>
      <th class="text-center p-2 ">SNI/TAHUN</th>
      <th class="text-center p-2 ">JENIS USAHA</th>
      <th class="text-center p-2 ">CABANG INDUSTRI</th>
      <th class="text-center p-2 ">SUB CABANG INDUSTRI</th>
      <th class="text-center p-2 ">INVESTASI/ MODAL (RP. 000)</th>
      <th class="text-center p-2 ">JUMLAH TENAGA KERJA PRIA</th>
      <th class="text-center p-2 ">JUMLAH TENAGA KERJA WANITA</th>
      <th class="text-center p-2 ">KAPASITAS PRODUKSI (RP. 000)</th>
      <th class="text-center p-2 ">SATUAN PRODUKSI</th>
      <th class="text-center p-2 ">NILAI PRODUKSI (RP.000)</th>
      <th class="text-center p-2 rounded-tr-xl">NILAI BAHAN BAKU (RP.000)</th>
    </tr>
    @foreach($BadanUsaha as $key=>$item)
    <tr>
    <td style="display: flex;">
      <form method="GET" action="/form/admin/{{$item->id}}" style="margin-right:10px">
        <button type="submit" class="btn btn-primary btn-sm">Edit</button>
      </form>

      <form method="GET" action="/form/badan_usaha/delete/{{$item->id}}">
        <button type="submit" id="deleteButton" class="btn btn-primary btn-sm" onclick="return confirm_delete_1()">Hapus</button>
      </form>
      
    </td>
    <td class="text-center p-4 ">{{ (++$key + (100* ((int)$BadanUsaha->currentPage() -1) ) ) }}</td>
    <td class="text-center p-4 ">{{$item->nik}}</td>
    <td class="text-center p-4 ">{{$item->nama_direktur}}</td>
    <td class="text-center p-4 ">{{$item->kabupaten}}</td>
    <td class="text-center p-4 ">{{$item->kecamatan}}</td>
    <td class="text-center p-4 ">{{$item->kelurahan}}</td>
    <td class="text-center p-4 ">{{$item->alamat_lengkap}}</td>
    <td class="text-center p-4 ">{{$item->no_hp}}</td>
    <td class="text-center p-4 ">{{$item->nama_usaha}}</td>
    <td class="text-center p-4 ">{{$item->bentuk_usaha}}</td>
    <td class="text-center p-4 ">{{$item->tahun_berdiri}}</td>
    <td class="text-center p-4 ">{{$item->formal_informal}}</td>
    <td class="text-center p-4 ">{{$item->nib_tahun}}</td>
    <td class="text-center p-4 ">{{$item->nomor_sertifikat_halal_tahun}}</td>
    <td class="text-center p-4 ">{{$item->sertifikat_merek_tahun}}</td>
    <td class="text-center p-4 ">{{$item->nomor_test_report_tahun}}</td>
    <td class="text-center p-4 ">{{$item->sni_tahun}}</td>
    <td class="text-center p-4 ">{{$item->jenis_usaha}}</td>
    <td class="text-center p-4 ">{{$item->cabang_industri}}</td>
    <td class="text-center p-4 ">{{$item->sub_cabang_industri}}</td>
    <td class="text-center p-4 ">{{$item->investasi_modal}}</td>
    <td class="text-center p-4 ">{{$item->jumlah_tenaga_kerja_pria}}</td>
    <td class="text-center p-4 ">{{$item->jumlah_tenaga_kerja_wanita}}</td>
    <td class="text-center p-4 ">{{$item->kapasitas_produksi_perbulan}}</td>
    <td class="text-center p-4 ">{{$item->satuan_produksi}}</td>
    <td class="text-center p-4 ">{{$item->nilai_produksi_perbulan}}</td>
    <td class="text-center p-4 ">{{$item->nilai_bahan_baku_perbulan}}</td>
    </tr>
    @endforeach
    </table>

    </div>
    {{ $BadanUsaha->links() }}
  </div>
</div>
@endsection

<script>
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
</script>