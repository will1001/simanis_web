@extends('layouts.admin')
@section('content')
<h1>Setting Surat</h1>
<form action="/admin/surat" method="post">
    @csrf
    <div class="flex justify-between items-center">
        <span>Alamat KOP Surat</span>
        <textarea class="border-2 border-gray-300 w-[300px] p-1 rounded-md ml-2" type="text" name="alamat_kop" rows="7">{{$surat->alamat_kop}}</textarea>
    </div>
    <br>
    <div class="flex justify-between items-center">
        <span>Nama Kadis</span>
        <input value="{{$surat->nama_kadis}}" class="border-2 border-gray-300 w-[300px] p-1 rounded-md ml-2" type="text" name="nama_kadis">
    </div>
    <br>
    <div class="flex justify-between items-center">
        <span>NIP</span>
        <input value="{{$surat->nip}}" class="border-2 border-gray-300 w-[300px] p-1 rounded-md ml-2" type="text" name="nip">
    </div>
    <br>
    <div class="flex justify-between items-center">
        <span>Jabatan</span>
        <input value="{{$surat->jabatan}}" class="border-2 border-gray-300 w-[300px] p-1 rounded-md ml-2" type="text" name="jabatan">
    </div>
    <br>
    <div class="flex justify-between items-center">
        <span>Alamat</span>
        <input value="{{$surat->alamat}}" class="border-2 border-gray-300 w-[300px] p-1 rounded-md ml-2" type="text" name="alamat">
    </div>
    <br>
    <button class="rounded-xl px-4 py-2 bg-blue-500 text-white">Simpan</button>
</form>
@endsection