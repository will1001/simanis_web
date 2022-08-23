@extends('layouts.member')
@section('content')
<div class="flex bg-white rounded-xl p-4">
    <div>
        <h2>No Kartu. 098798</h2>
     <div class="flex">
        <div>
            <div class="flex"><div class="mr-10">Nama</div></div>
            <div class="flex"><div class="mr-10">Alamat</div></div>
            <div class="flex"><div class="mr-10">Usaha</div></div>
            <div class="flex"><div class="mr-10">Kabupaten</div></div>
            <div class="flex"><div class="mr-10">NIK</div></div>
            </div>
        <div>
            <div class="text-left flex justify-start items-start">: Wili Rahmat Muhammad</div>
            <div class="text-left flex justify-start items-start">: Sikur Lombok Timur</div>
            <div class="text-left flex justify-start items-start">: Ternak Sapi</div>
            <div class="text-left flex justify-start items-start">: Lombok Timur</div>
            <div class="text-left flex justify-start items-start">: 138435138413251384</div>
        </div>
     </div>
        
    </div>
    <img src="{{ asset('/img/kartuPhoto.png') }}" alt="">
</div>

@endsection