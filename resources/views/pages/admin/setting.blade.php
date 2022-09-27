@extends('layouts.admin')
<style>
    .imgSlide {
        width: 100%;
        margin: 20px;
    }
</style>
<?php
$baseUrl = env('APP_URL');
?>
@section('content')
<h1>Slide Setting Mobile</h1>
@foreach($SlideShow as $key=>$item)
    @if($item->type == "mobile")
        <img class="imgSlide" src="{{$baseUrl.$item->img}}" alt="img">
        <span>Slide {{$key+1}} : </span>
        <form action="/admin/slideshow/{{$item->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="slide">
            <br>
            <br>
            <button class="rounded-xl px-4 py-2 bg-blue-500 text-white" type="submit">Submit</button>
        </form>
    @endif
@endforeach
<h1>Slide Setting Website</h1>
@foreach($SlideShow as $key=>$item)
    @if($item->type == "website")
        <img class="imgSlide" src="{{$baseUrl.$item->img}}" alt="img">
        <span>Slide {{$key+1}} : </span>
        <form action="/admin/slideshow/{{$item->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="slide">
            <br>
            <br>
            <button class="rounded-xl px-4 py-2 bg-blue-500 text-white" type="submit">Submit</button>
        </form>
    @endif
@endforeach
<!-- <h1>Survei Setting</h1>
<form action="/admin/survei/{{$Survei[0]->id}}" method="POST">
    @csrf
    <input type="text" name="link" value="{{$Survei[0]->link}}">
    <button type="subnit">submit</button>
</form> -->

@endsection