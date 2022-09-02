        @extends('layouts.koperasi')
<style>
    .badan_usaha_container,
    p,
    .btn {
        margin: 20px 0;
    }
    .box {
        width: 500px;
        height: 670px;
        padding: 42px;
    }
    .gray300{       
        color: #D1D5DB;
    }
    .inputText{
        width: 180px;
        height: 40px;
    }
    .bg1{
        width:100%;
        height:1000px;
    }
</style>
@section('content')

<div class="bg1 bg-slate-150 absolute"></div>

<h2 class="ml-4">Simulasi Angsuran</h2>

<div class="flex mt-4 gap-5 ml-4">
    <span class="text-disetujuiTextColor underline text-xl font-bold">Murobhahah</span>
    <span class="text-xl font-bold text-slate-700">Mudharobah</span> 
    <span class="text-xl font-bold text-slate-700">Musyarakah</span>      
</div> 

<div class="flex flex-col box bg-white ml-4 mt-4 gap-2 rounded-2xl shadow-lg">
    <span class="text-2xl gray300 font-semibold">INFORMASI UMUM</span>
    <div class="flex justify-between text-slate-800">
            <span class="my-auto">Harga Barang</span> <input type="text" class="inputText rounded-md border">
    </div>
    <div class="flex justify-between text-slate-800">
            <span class="my-auto">Uang Muka (Opsional)</span> <input type="text" class="inputText rounded-md border">
    </div>
    <div class="flex justify-between text-slate-800">
            <span class="my-auto">Jangka Waktu</span> <input type="text" class="inputText rounded-md border">
    </div>
    <div class="flex justify-between text-slate-800">
            <span class="my-auto">Angsuran Perbulan</span> <input type="text" class="inputText rounded-md border">
    </div>
    <div class="flex justify-between text-slate-800">
            <span class="my-auto">Angsuran Perminggu</span> <input type="text" class="inputText rounded-md border">
    </div>
    <div class="flex justify-between text-slate-800">
            <span class="my-auto">Biaya Realisasi</span> <input type="text" class="inputText rounded-md border">
    </div>
    
    <span class="text-2xl gray300 font-semibold my-2"><hr></span>

    <div class="flex justify-between text-slate-800">
            <span class="my-auto">Harga Jual</span> <input type="text" class="inputText rounded-md border">
    </div>
    <div class="flex justify-between text-slate-800">
            <span class="my-auto">Harga Pembiayaan</span> <input type="text" class="inputText rounded-md border">
    </div>
    <div class="flex justify-between text-slate-800">
            <span class="my-auto">Margin Keuntungan</span> <input type="text" class="inputText rounded-md border">
    </div>
    <div class="flex justify-between text-slate-800">
            <span class="my-auto">Total Pembayaran Angsuran</span> <input type="text" class="inputText rounded-md border">
    </div>
</div>

@endsection