@extends('layouts.admin')
@section('content')
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
    <form action="{{ route('admin_delete_all')}}" method="GET">
      <button onclick="return confirm_delete()" class="btn btn-primary float-right" type="submit" id="button-addon2">Hapus Semua Data</button>
    </form>
    <button class="btn btn-primary" type="submit" id="button-addon2"><a href="{{ url('/admin/export')}}" style="text-decoration:none;color:white">Tambah Data</a></button>
    @endif
  </div>

</div>

<div class="Container-Table">
  <div class="table-responsive m-2" style="max-height:500px;">
    <table class="table" style="white-space: nowrap;">
      <thead class="thead-dark bg-dark text-light" style="position: sticky; top: 0; z-index: 1;">
        <tr>
          <th scope="col">#</th>
          <th scope="col">No</th>
          <th scope="col">NOMOR INDUK KEPENDUDUKAN (NIK)</th>
          <th scope="col">NAMA</th>
          <th scope="col">KAB/KOTA</th>
          <th scope="col">KECAMATAN</th>
          <th scope="col">KELURAHAN/DESA</th>
          <th scope="col">ALAMAT LENGKAP</th>
          <th scope="col">NO. HP</th>
          <th scope="col">NAMA USAHA</th>
          <th scope="col">BENTUK USAHA</th>
          <th scope="col">TAHUN BERDIRI</th>
          <th scope="col">LEGALITAS USAHA</th>
          <th scope="col">NIB/TAHUN</th>
          <th scope="col">NOMOR SERTIFIKAT HALAL/ TAHUN</th>
          <th scope="col">SERTIFIKAT MEREK/TAHUN</th>
          <th scope="col">NOMOR TEST REPORT/TAHUN</th>
          <th scope="col">SNI/TAHUN</th>
          <th scope="col">JENIS USAHA</th>
          <th scope="col">CABANG INDUSTRI</th>
          <th scope="col">INVESTASI/ MODAL (RP. 000)</th>
          <th scope="col">JUMLAH TENAGA KERJA PRIA</th>
          <th scope="col">JUMLAH TENAGA KERJA WANITA</th>
          <th scope="col">KAPASITAS PRODUKSI (RP. 000)</th>
          <th scope="col">SATUAN PRODUKSI</th>
          <th scope="col">NILAI PRODUKSI (RP.000)</th>
          <th scope="col">NILAI BAHAN BAKU (RP.000)</th>
        </tr>
      </thead>
      <tbody>
        @foreach($BadanUsaha as $key=>$item)
        <tr>
          <td style="display: flex;">
            <form method="GET" action="/form/admin/{{$item->id}}" style="margin-right:10px">
              <button type="submit" class="btn btn-primary btn-sm">Edit</button>
            </form>

            <form method="GET" action="/form/badan_usaha/delete/{{$item->id}}">
              <button type="submit" id="deleteButton" class="btn btn-primary btn-sm" onclick="return confirm_delete_1()">Hapus</button>
            </form>
            <!-- <i onclick="return confirm_delete_1()" class="fas fa-trash-alt" style="cursor:pointer;"></i> -->
          </td>
          <td scope="row" style="text-align:center;">{{ (++$key + (100* ((int)$BadanUsaha->currentPage() -1) ) ) }}</td>
          <td>{{$item->nik}}</td>
          <td>{{$item->nama_direktur}}</td>
          <td>{{$item->kabupaten}}</td>
          <td>{{$item->kecamatan}}</td>
          <td>{{$item->kelurahan}}</td>
          <td>{{$item->alamat_lengkap}}</td>
          <td>{{$item->no_hp}}</td>
          <td>{{$item->nama_usaha}}</td>
          <td>{{$item->bentuk_usaha}}</td>
          <td>{{$item->tahun_berdiri}}</td>
          <td>{{$item->formal_informal}}</td>
          <td>{{$item->nib_tahun}}</td>
          <td>{{$item->nomor_sertifikat_halal_tahun}}</td>
          <td>{{$item->sertifikat_merek_tahun}}</td>
          <td>{{$item->nomor_test_report_tahun}}</td>
          <td>{{$item->sni_tahun}}</td>
          <td>{{$item->jenis_usaha}}</td>
          <td>{{$item->cabang_industri}}</td>
          <td>{{$item->investasi_modal}}</td>
          <td>{{$item->jumlah_tenaga_kerja_pria}}</td>
          <td>{{$item->jumlah_tenaga_kerja_wanita}}</td>
          <td>{{$item->kapasitas_produksi_perbulan}}</td>
          <td>{{$item->satuan_produksi}}</td>
          <td>{{$item->nilai_produksi_perbulan}}</td>
          <td>{{$item->nilai_bahan_baku_perbulan}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  {{ $BadanUsaha->links() }}
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