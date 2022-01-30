@extends('layouts.public', ['include_chart' => true])
@section('title')
UMKM NTB
@stop
<style>
    @media only screen and (min-width: 401px) {
   .pie_chart{
       width: 70%;
   }
}
 .pie_chart{
       width: 10%;
   }
</style>
@section('content')

<!-- Hero section  -->
<section class="hero-section" style="background-color: #17172d">
    <div class="hero-slider owl-carousel">
        <div class="hero-item set-bg" data-setbg="{{ asset('tmplate3/img/hero-slider/1.jpg') }}">

            <div class="container">
                <div class="row">
                    <div class="col-xl-8">
                        <h2><span style="font-weight: bold;">SIMANIS</span><span style="font-size: 32px;">SISTEM
                                INFORMASI MANAJEMEN
                                INDUSTRI</span></h2>
                        @if (Auth::check())
                        @else
                        <a href="{{ url('daftar') }}" class="site-btn sb-light-dark mr-4 mb-3">Daftar</a>
                        <a href="{{ url('masuk') }}" class="site-btn sb-white">Login</a>
                        @endif

                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- Hero section end  -->

<?php
$chartTitle = [
    "SEBARAN INDUSTRI KECIL DAN MENENGAH (IKM) NTB BERBASIS KABUPATEN/ KOTA",
    // "SEBARAN INDUSTRI KECIL DAN MENENGAH (IKM) NTB BERBASIS SKALA INDUSTRI",
    "SEBARAN INDUSTRI KECIL DAN MENENGAH (IKM) NTB BERBASIS PERIZINAN",
    "SEBARAN INDUSTRI KECIL DAN MENENGAH (IKM) NTB BERBASIS CABANG INDUSTRI",
    "SEBARAN INDUSTRI KECIL DAN MENENGAH (IKM) NTB BERBASIS SERTIFIKASI HALAL",
    "SEBARAN INDUSTRI KECIL DAN MENENGAH (IKM) NTB BERBASIS SERTIFIKASI MEREK",
];


?>


<section class="services-section p-3">
    <div class="container">
        <div style="text-align: center;">
            <h2 style="font-weight:bolder;">Data UMKM Provinsi NTB</h2>
        </div>

        @foreach($chartTitle as $i=>$title)
        <div class="container text-center">
            <h5 class="text-center m-3">{{$title}}</h5>
            <div class="row">
                <div class="col-sm">
                    <h5 class="text-center">Industri Kecil</h5>
                    <canvas id="Chart{{$i+$i+1}}" ></canvas>
                </div>
            </div>
             <div class="row">
                 <div class="col-sm">
                    <h5 class="text-center">Industri Menengah</h5>
                    <canvas id="Chart{{$i+$i+2}}" ></canvas>
                </div>
            </div>
        </div>
        @endforeach
        
    </div>
</section>
<!-- Services section end  -->


<section class="clients-section spad" style="background-color: #17172d">
    <div class="container">

        <div class="client-text">
            <h2 style="color: white; font-weight:bolder;">SIMANIS</h2>
            <p>Simanis Adalah Sistem Informasi Manajemen Industri yang berguna untuk mendata para pelaku UMKM yang ada
                di Provinsi Nusa Tenggara Barat dan Membantu dalam memudahkan UMKM untuk melakukan pengajuan Modal.</p>
        </div>

    </div>
</section>

<!-- Call to action section  -->
<section class="cta-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 d-flex align-items-center">
                <h2>Kami siap untuk melayani dan menjawab pertanyaan Anda</h2>
            </div>
            <div class="col-lg-3 text-md-right">
                <a href="https://api.whatsapp.com/send?phone=6287728937983" target="_blank" class="site-btn sb-dark">Hubungi Kami</a>
            </div>
        </div>
    </div>
</section>



<h2 style="margin:45px 0;font-family:'Montserrat',sans-serif;text-align:center;color:rgb(90,90,90)">Survei Kepuasan</h2>

<section class="clients-section spad" style="background-color: #17172d">
    <div class="container">
        <div class="row" style="text-align: center">
            <div class="col">
                <iframe class="responsive-iframe" src="https://docs.google.com/forms/d/e/1FAIpQLSdampdX0BstgbXIrfSj89fqN-q2TFjt0rmkifEm2n5aTQ3tfQ/viewform?embedded=true" width="auto" height="550" frameborder="0" marginheight="0" marginwidth="0">Memuat…</iframe>
            </div>
        </div>
    </div>
</section>




@stop
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script>
        const badanUsaha = @json($BadanUsaha);
        // console.log(badanUsaha);
        const kabupaten = @json($kabupaten);
        const chartTitle = @json($chartTitle);
        const cabangIndustri = @json($cabangIndustri);
        const bgColorList = [  
                            'rgba(54, 162, 235, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(0,255,0, 1)',
                            'rgba(0,255,255, 1)',
                            'rgba(0,128,128, 1)',
                            'rgba(138,43,226, 1)',
                            'rgba(221,160,221, 1)',
                            'rgba(244,164,96, 1)',
                            'rgba(176,196,222, 1)',
                            'rgba(255,140,0, 1)',
                        ]
        let industriKecil = badanUsaha.filter(e=>parseInt(e.investasi_modal) < 1000000000);
        let industriMenengah = badanUsaha.filter(e=>parseInt(e.investasi_modal) > 1000000000 && e.investasi_modal < 15000000000);
        let industriBesar = badanUsaha.filter(e=>parseInt(e.investasi_modal) > 15000000000);
        let barChart= new Array(4);
        const renderCart = (noChart,Data,bgColor,labelsData)=>{
            barChart[noChart] = new Chart(`Chart${noChart+1}`, {
                type: 'pie',
                data: {
                    labels: labelsData,
                    datasets: [
                        {
                    
                        data: Data['dataList'],
                        backgroundColor: bgColor,
                    },
                    
                ]
                },
                options: {
                     onClick: function(_points, _event, barClicked){
                         console.log(_event[0].index);
                    },  
                   plugins: {
                    legend: {
                        position:window.screen.availWidth <= 400 ?"bottom":"right",
						itemStyle: {
							width: 90 // or whatever, auto-wrap
						},
                        labels: {
						boxWidth:10,
                        generateLabels: (chart) => {
                            const datasets = chart.data.datasets;
                            return datasets[0].data.map((data, i) => ({
                            text: `${chart.data.labels[i]} : ${data}`,
                            fillStyle: datasets[0].backgroundColor[i],
                            }))
                        }
                        }
                    },
                    title: {
                        display: false,
                        text: Data['title'],
                        font:{
                            size:30,
                            weight:'bold',

                        }
                    }
                    }
                }
            });
        }
      

       

        for (let i = 0; i < chartTitle.length; i++) {
            let ik=new Array(kabupaten.length);
            let im=new Array(kabupaten.length);
            let labelsName;
            let bgColorChart;
            if(i===0){
                  const kabupatenLabel = [
                    "Lombok Barat",
                    "Lombok Tengah",
                    "Lombok Timur",
                    "Sumbawa",
                    "Dompu",
                    "Bima",
                    "Sumbawa Barat",
                    "Lombok Utara",
                    "Kota Mataram",
                    "Kota Bima",
                ];
                 for (let j = 0; j < kabupaten.length; j++) {
                    const aaaa= industriKecil.filter(param=>parseInt(param.id_kabupaten) === parseInt(kabupaten[j]['id']))
                    const bbbb= industriMenengah.filter(param=>parseInt(param.id_kabupaten) === parseInt(kabupaten[j]['id']))
                    ik[j] = aaaa.length;
                    im[j] = bbbb.length;
                    labelsName= kabupatenLabel;
                    bgColorChart= bgColorList;
                        
                    }
            }else if(i===2){
                const cabangIndustriLabel = [
                    "Pangan",
                    "Hulu Agro",
                    "permesinan",
                    "Hasil Pertambangan",
                    "Kesehatan",
                    "Ekonomi Kreatif",
                ];
                 for (let j = 0; j < cabangIndustri.length; j++) {
                    const aaaa= industriKecil.filter(param=>param.cabang_industri?.toLowerCase() === cabangIndustri[j]['nama']?.toLowerCase())
                    const bbbb= industriMenengah.filter(param=>param=>param.cabang_industri?.toLowerCase() === cabangIndustri[j]['nama']?.toLowerCase())
                    ik[j] = aaaa.length;
                    im[j] = bbbb.length;
                    labelsName= cabangIndustriLabel;
                    bgColorChart= bgColorList.slice(0,cabangIndustri.length);
                        
                    }
            }else if(i===3){
                const sertifikatHalal = ["Memiliki Sertifikasi Halal", "Tidak Memiliki Sertifikasi Halal"];
                    const aaaa= industriKecil.filter(param=>param.nomor_sertifikat_halal_tahun !== null)
                    const bbbb= industriMenengah.filter(param=>param.nomor_sertifikat_halal_tahun !== null)
                    ik = [aaaa.length,industriKecil.length - aaaa.length];
                    im = [bbbb.length,industriMenengah.length - bbbb.length];
                    labelsName= sertifikatHalal;
                    bgColorChart= bgColorList.slice(0,sertifikatHalal.length);
                        
            }else if(i===4){
                const sertifikatMerek = ["Memiliki Sertifikasi Merek", "Tidak Memiliki Sertifikasi Merek"];
                    const aaaa= industriKecil.filter(param=>param.sertifikat_merek_tahun !== null)
                    const bbbb= industriMenengah.filter(param=>param.sertifikat_merek_tahun !== null)
                    ik = [aaaa.length,industriKecil.length - aaaa.length];
                    im = [bbbb.length,industriMenengah.length - bbbb.length];
                    labelsName= sertifikatMerek;
                    bgColorChart= bgColorList.slice(0,sertifikatMerek.length);
                        
            }else if(i===1){
                const formalInformalLabel = ["Legalitas Usaha (Formal)","Legalitas Usaha (Informal)"];
                const formalInformal = ["FORMAL","INFORMAL"];
                 for (let j = 0; j < formalInformal.length; j++) {
                    const aaaa= industriKecil.filter(param=>param.formal_informal === formalInformal[j])
                    const bbbb= industriMenengah.filter(param=>param.formal_informal === formalInformal[j])
                 

                        ik[j] = aaaa.length;
                        im[j] = bbbb.length;
                        labelsName= formalInformalLabel;
                        bgColorChart= bgColorList.slice(0,formalInformal.length);
                    }
            }else{
                    ik[j] = [];
                    im[j] = [];
                    labelsName= [];
                    bgColorChart= [];
            }
           
           
            

           
            let data = [
                {
                    'title' : 'Industri Kecil',
                    'dataList' : ik
                },
                {
                    'title' : 'Industri Menengah',
                    'dataList' : im
                }
            ];


          

           
            for (let k = i+i; k < data.length+i+i; k++) {
                
                 

                renderCart(k,data[k-i-i],bgColorChart,labelsName)
            }
           
        }
        

</script>
@endsection