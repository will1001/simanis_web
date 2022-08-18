@extends('layouts.member')
<style>
    .badan_usaha_container,
    p,
    .btn {
        margin: 20px 0;
    }
</style>
@section('content')
<!-- <h1>Member</h1> -->
@foreach($BadanUsaha as $key => $item)
<div class="badan_usaha_container">
    <h5>{{$key+1}} . Nama Usaha : {{$item->nama_usaha}}</h5>
    <span>kelengkepan Profil : </span>
    <div class="progress" style="width: 200px;">
        <div class="progress-bar" role="progressbar" style="width: {{round($userDataProgress[$key],0)}}%;height: 20px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{round($userDataProgress[$key],0)}}%</div>
    </div>
    <form method="GET" action="/member/dashboard/ProfilBadanUsaha/{{$item->id}}">
        <button type="submit" class="btn btn-success btn-sm">Lihat Profil</button>
    </form>
    @if(round($userDataProgress[$key],0) != 100)
    <p class="text-danger">Mohon lengkapi seluruh Profil untuk mendapatkan akses fitur yang lain, seperti pengajuan dana , kartu member, dan lain lain.</p>
    @else
    <p class="text-success">Selamat Profilmu sudah lengkap, sekarang kamu bisa mengakses fitur lain, seperti pengajuan dana , kartu member, dan lain lain.</p>
    @endif
    @if($item->status_verifikasi == 0)
    <button disabled type="submit" class="btn btn-info btn-sm">Ajukan Dana</button>
    @else
    <button type="submit" class="btn btn-info btn-sm">Ajukan Dana</button>
    @endif

</div>
@endforeach
@endsection