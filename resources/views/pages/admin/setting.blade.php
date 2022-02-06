@extends('layouts.admin')
<style>
    .imgSlide {
        width: 100%;
        margin: 20px;
    }
</style>
<?php
$baseUrl = "http://127.0.0.1:8000";
?>
@section('content')
<h1>Slide Setting</h1>
@foreach($SlideShow as $key=>$item)
<img class="imgSlide" src="{{$baseUrl.$item->img}}" alt="img">
<span>Slide {{$key+1}} : </span>
<form action="/admin/slideshow/{{$item->id}}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="slide">
    <button type="submit">Submit</button>
</form>
@endforeach
<h1>Survei Setting</h1>
<form action="/admin/survei/{{$Survei[0]->id}}" method="POST">
    @csrf
    <input type="text" name="link" value="{{$Survei[0]->link}}">
    <button type="subnit">submit</button>
</form>

@endsection