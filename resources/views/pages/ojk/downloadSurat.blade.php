<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Simanis</title>
</head>

<body>
    @if($PengajuanDana)
    @php
    $kopBulan=date("m",strtotime($PengajuanDana->updated_at));
    $kopTahun=date("Y",strtotime($PengajuanDana->updated_at));
    $footTanggal=date("d",strtotime($PengajuanDana->created_at));
    $footBulan=date("m",strtotime($PengajuanDana->created_at));
    $footTahun=date("Y",strtotime($PengajuanDana->created_at));

    $BulanIndo;

    if($footBulan == 1) $BulanIndo = "JANUARI";
    if($footBulan == 2) $BulanIndo = "FEBRUARI";
    if($footBulan == 3) $BulanIndo = "MARET";
    if($footBulan == 4) $BulanIndo = "APRIL";
    if($footBulan == 5) $BulanIndo = "MEI";
    if($footBulan == 6) $BulanIndo = "JUNI";
    if($footBulan == 7) $BulanIndo = "JULI";
    if($footBulan == 8) $BulanIndo = "AGUSTUS";
    if($footBulan == 9) $BulanIndo = "SEPTEMBER";
    if($footBulan == 10) $BulanIndo = "OKTOBER";
    if($footBulan == 11) $BulanIndo = "NOVEMBER";
    if($footBulan == 12) $BulanIndo = "DESEMBER";
    @endphp
    <div id="surat" class="">
        <div class="flex justify-center mb-4">
            <img class="mr-4 h-[84px]" src="{{ asset('/images/Logo NTB 1.png') }}" />
            <div class="text-center flex flex-col">
                <span class="font-normal text-black text-3xl">PEMERINTAH PROVINSI NUSA TENGGARA BARAT </span>
                <span class="font-bold text-black text-3xl">{{$Surat->judul_kop}}</span>
                <!-- <span class="font-bold text-black">Dinas Pawriwisata Dan Kebudayaan</span> -->
                <!-- <span>Jl. Langko No.70, Pejeruk, Kec. Ampenan, Kota Mataram,</span>
                <span>Nusa Tenggara Bar. 83114</span> -->
                <span class="text-black">{{$Surat->alamat_kop}}</span>
                <span class="text-black">email : disperin@ntbprov.go.id <span class="ml-[20px]">website: https://disperin.ntbprov.go.id</span></span>
            </div>
            <span class="ml-[120px] h-[84px]"></span>
            <img class="ml-[100px] h-[84px] hidden" src="{{ asset('/images/NTB Gemilang Logo 1.png') }}" />
        </div>
        <div class="border-t-4 border-black mb-1"></div>
        <div class="border-t-2 border-black mb-2"></div>
        <!-- <div class="h-[4px] bg-black w-full mb-1"></div> -->
        <!-- <div class="h-[2px] bg-black w-full mb-2"></div> -->
        <div class="flex justify-center">
            <div class="text-center flex flex-col">
                <span class="font-bold text-black">SURAT REKOMENDASI</span>
                <span>Nomor : {{$PengajuanDana->no_surat}}</span>
            </div>
        </div>

        <div class="flex justify-start mt-[20px]">
            <div class="text-left flex flex-col">
                <span>Yang bertanda tangan dibawah ini :</span>
                <div class="flex ml-10 ">
                    <div class="flex flex-col mr-7">
                        <span>Nama</span>
                        <span>Pangkat/Gol. Ruang</span>
                        <span>NIP</span>
                        <span>Jabatan</span>
                        <!-- <span>Alamat</span> -->
                    </div>
                    <div class="flex flex-col">
                        <span>: {{$Surat->nama_kadis}}</span>
                        <span>: {{$Surat->golongan}} (IV/c)</span>
                        <span>: {{$Surat->nip}}</span>
                        <span>: {{$Surat->jabatan}}</span>
                        <!-- <span>: {{$Surat->alamat}}</span> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-start mt-[20px]">
            <div class="text-left flex flex-col">
                <span>Dengan ini menerangkan bahwa IKM :</span>
                <div class="flex ml-10 ">
                    <div class="flex flex-col mr-7">
                        <span>Nama</span>
                        <span>Alamat</span>
                        <span>Nama Pemilik</span>
                        <span>No. Telepon</span>
                    </div>
                    <div class="flex flex-col">
                        <span>: {{$BadanUsaha[0]->nama_usaha}}</span>
                        <span>: {{$BadanUsaha[0]->alamat_lengkap}}</span>
                        <span>: {{$BadanUsaha[0]->nama_direktur}}</span>
                        <span>: {{$BadanUsaha[0]->no_hp}}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-start mt-[50px]">
            <div class="text-center flex flex-col">
                <span class="w-[700px]">Adalah IKM Binaan Dinas Perindustrian Provinsi NTB dan telah memenuhi persyaratan untuk mengajukan pembiayaan kepada PT {{$PengajuanDana->nama}}</span>
                <span class="mt-[20px]">Demikian surat ini dibuat untuk digunakan sebagaimana mestinya</span>
            </div>
        </div>
        <div class="flex justify-end mt-[50px]">
            <div class="text-center flex flex-col">
                <span>Mataram, {{$footTanggal}}-{{$BulanIndo}}-{{$footTahun}} </span>
                <span>Kepala Dinas Perindustrian <br> Provinsi Nusa Tenggara Barat</span>
                <img class="h-[60px]" src="{{ asset($Surat->ttd) }}">
                <span class="font-bold text-black">{{$Surat->nama_kadis}}</span>
                <span>{{$Surat->golongan}}</span>

                <span>{{$Surat->nip}}</span>
            </div>
        </div>

        <div class="flex mt-[100px]">
            <div class="flex items-end">
                <img class="h-[30px]" src="{{ asset('/images/logo_footer.png') }}">
                <span class="mr-2 text-[10px]">Industrialisasi dari NTB untuk Indonesia</span>
            </div>

            <div class="flex items-end">
                <img class="h-[15px] mr-1" src="{{ asset('/images/logo_fb.png') }}">
                <span class="mr-2 text-[10px]">Dinas_perindustrianntb</span>
            </div>

            <div class="flex items-end">
                <img class="h-[15px] mr-1" src="{{ asset('/images/logo_youtube.png') }}">
                <span class="mr-2 text-[10px]">Dinas Perindustrian Provinsi NTB</span>
            </div>

            <div class="flex items-end">
                <img class="h-[15px] mr-1" src="{{ asset('/images/logo_instagram.png') }}">
                <span class="mr-2 text-[10px]">@dinas_perindustrianntb</span>
            </div>
        </div>
    </div>


    <!-- <div class="p-[100px]">
    <button onclick="printSurat()" class="rounded-xl px-4 py-2 bg-blue-500 text-white">Print</button>
    <button class="rounded-xl px-4 py-2 bg-blue-500 text-white">Download PDF</button>
</div> -->
    @else
    <div>
        <h1>Belum Ada Surat Rekomendasi</h1>
    </div>
    @endif
</body>
<script>
    print();
</script>

</html>