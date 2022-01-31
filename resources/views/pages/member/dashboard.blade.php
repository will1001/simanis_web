@extends('layouts.member')
@section('content')
<h1>Member</h1>
<div class="progress" style="width: 200px;">
    <div class="progress-bar" role="progressbar" style="width: {{$userDataProgress}}%;height: 20px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{$userDataProgress}}%</div>
</div>
@endsection