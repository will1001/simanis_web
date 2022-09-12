@extends('layouts.public', ['include_chart' => true])
@section('title')
UMKM NTB
@stop
<style>
    @media only screen and (min-width: 401px) {
        canvas {
            max-width: 70%;
            width: 100%;
            max-height: 300px;
        }
    }


    @media only screen and (min-width: 401px) {
        .pie_chart {
            width: 70%;
        }
    }

    .pie_chart {
        width: 10%;
    }

    .filterChart {
        display: flex;
        flex-direction: column;
        width: 40%;
    }

    .filterChart select {
        margin: 5px 0;
    }

    @media only screen and (max-width: 400px) {
        .filterChart {
            width: 100%;
        }

    }


    .mobilebannerimg {
        display: none;
    }

    .bannerimg {
        width: 100%;
        height: 500px;
        object-fit: fill;
    }

    .fotobanner1 {
        position: absolute;
        top: -53px;
        left: -71px;
        width: 760px;
    }

    .fotobanner2 {
        position: absolute;
        top: 66px;
        right: -5px;
        width: 460px;
    }

    .loginRegisterContainer {
        position: absolute;
        top: 524px;
        left: 108px;
    }

    .buttonreg {
        background-color: #FECD1F;
        padding: 10px 30px;
        border-radius: 25px;
        font-family: Poppins;
        font-style: normal;
        font-weight: 600;
        font-size: 20px;
        line-height: 30px;
        color: #FFFFFF;
    }

    .buttonlog {
        background-color: #FFFFFF;
        padding: 10px 30px;
        border-radius: 25px;
        font-family: Poppins;
        font-style: normal;
        font-weight: 600;
        font-size: 20px;
        line-height: 30px;
        color: #3A8EE2;
    }

    .titleSectionContainer {
        background: linear-gradient(90deg, rgba(25, 112, 200, 0.92) 0%, rgba(15, 75, 136, 0.92) 100%);
        padding: 15px;
        margin-bottom: 50px;
    }

    .titleSectionContainer h2 {
        font-family: Poppins;
        font-style: normal;
        font-weight: 600;
        font-size: 54px;
        line-height: 81px;
        color: #FFFFFF;
    }

    .filterChart select {
        margin: 5px 0;
        border-radius: 8px;
        padding: 10px;
        color: #C7C9D9;
    }

    .filterChart span {
        font-family: Poppins;
        font-style: normal;
        font-weight: 600;
        font-size: 14px;
        line-height: 21px;
        color: #404040;
    }

    .chartDescTitle {
        background: #2081E2;
        border-radius: 8px;
        padding: 5px 10px;
        display: inline;

    }

    .chartDescTitle span {
        font-family: Poppins;
        font-style: normal;
        font-weight: 600;
        font-size: 14px;
        line-height: 21px;
        text-align: center;
        color: #FFFFFF;
    }

    .boxChartDesc {
        width: 15px;
        height: 15px;
        margin-bottom: 20px;
    }

    .titleChartDesc {
        word-wrap: break-word;
        hyphens: auto;
        white-space: normal;
    }

    .titleChartDesc,
    .valueChartDesc {
        font-family: Poppins;
        font-style: normal;
        font-weight: 600;
        font-size: 12px;
        line-height: 18px;
        text-align: center;
        color: #404040;
    }

    .ChartDescContainer {
        display: flex;
        flex-direction: column;
        align-content: center;
        align-items: center;
        justify-content: center;
        margin-right: 20px;
        margin-bottom: 20px;
        width: 100px;
        cursor: pointer;
    }

    .ChartContainer {
        display: flex;
        /* justify-content: space-between; */
        margin-top: 20px;
        flex-flow: row wrap;
        width: 90%;
    }

    .client-text p {
        font-family: Poppins;
        font-style: normal;
        font-weight: 600;
        font-size: 20px;
        line-height: 30px;
        text-align: center;
        color: #FFFFFF;
    }

    .download-app-button {
        background: #FECD1F;
        border-radius: 8px;
        display: inline-block;
        padding: 10px;
        font-family: Poppins;
        font-style: normal;
        font-weight: 600;
        font-size: 20px;
        line-height: 30px;
        text-align: center;
        color: #FFFFFF;
        margin-bottom: 20px;
    }

    section.clients-section.spad {
        text-align: center;
    }

    .cta-section h2 {
        font-family: Poppins;
        font-style: normal;
        font-weight: 600;
        font-size: 35px;
        line-height: 52px;
        color: #FFFFFF;
    }



    @media only screen and (max-width: 900px) {
        .filterChart {
            width: 100%;
        }

        .fotobanner1 {
            top: -13px;
            left: -35px;
            width: 760px;
            display: none;
        }

        .fotobanner2 {
            top: 208px;
            right: 0px;
            width: 308px;
            display: none;
        }

        .loginRegisterContainer {
            position: absolute;
            top: 469px;
            left: 11px;
        }

        .logo-container {
            display: none !important;
        }

        .mobilebannerimg {
            display: block;
            width: 100%;
        }

        .bannerimg {
            display: none;
        }
    }
</style>
@section('content')
<?php
$chartDescList = array(
    (object)array(
        "color" => "rgba(54, 162, 235, 1)",
        "title" => "Total IKM",
        "value" => count($BadanUsaha),
    ),
    (object)array(
        "color" => "rgba(153, 102, 255, 1)",
        "title" => "Tenaga Kerja",
        "value" => $totalTenagaKerja[0]->total_tenaga_kerja,
    ),
    (object)array(
        "color" => "rgba(0,255,0, 1)",
        "title" => "IKM Baru",
        "value" => $totalIKMBaru[0]->total_ikm_baru,
    ),
    (object)array(
        "color" => "rgba(0,255,255, 1)",
        "title" => "Industri Kecil",
        "value" => count($industriKecil),
    ),
    (object)array(
        "color" => "rgba(0,128,128, 1)",
        "title" => "Industri Menengah",
        "value" => count($industriMenengah),
    ),
    (object)array(
        "color" => "rgba(138,43,226, 1)",
        "title" => "Industri Besar",
        "value" => count($industriBesar),
    ),
    (object)array(
        "color" => "rgba(221,160,221, 1)",
        "title" => "Sertifikikat Halal",
        "value" => count($sertifikatHalal),
    ),
    (object)array(
        "color" => "rgba(244,164,96, 1)",
        "title" => "Sertifikikat HAKI",
        "value" => count($sertifikatHaki),
    ),
    (object)array(
        "color" => "rgba(176,196,222, 1)",
        "title" => "Sertifikikat SNI",
        "value" => count($sertifikatSNI),
    ),
    (object)array(
        "color" => "rgba(255,140,0, 1)",
        "title" => "Sertifikat Test Report",
        "value" => count($sertifikatTestReport),
    ),
    (object)array(
        "color" => "rgba(110, 191, 139, 1)",
        "title" => "Formal",
        "value" => count($formal),
    ),
    (object)array(
        "color" => "rgba(54, 21, 0, 1)",
        "title" => "Informal",
        "value" => count($informal),
    ),
);
$surveyChart = array(
    (object)array(
        "color" => "rgba(54, 21, 0, 1)",
        "title" => "Sangat Puas",
        "value" => $surveyChartData[0]->sp,
    ),
    (object)array(
        "color" => "rgba(153, 102, 255, 1)",
        "title" => "Puas",
        "value" => $surveyChartData[0]->p,
    ),
    (object)array(
        "color" => "rgba(0,255,0, 1)",
        "title" => "Tidak Puas",
        "value" => $surveyChartData[0]->tp,
    ),
    (object)array(
        "color" => "rgba(0,255,255, 1)",
        "title" => "Sangat Tidak Puas",
        "value" => $surveyChartData[0]->stp,
    ),

);
?>

<!-- Hero section  -->
<!-- <section class="hero-section" style="background-color: #17172d">
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
                        <a href="{{ url('login') }}" class="site-btn sb-white">Login</a>
                        @endif

                    </div>
                </div>
            </div>
        </div>

    </div>
</section> -->

<section class="hero-section" style="background-color: #17172d">
    <img class="bannerimg" src="{{ asset('images/bannerold.png') }}" alt="">
    <img class="mobilebannerimg" src="{{ asset('images/mobilebanner.png') }}" alt="">
    <img class="fotobanner1" src="{{ asset('images/fotobanner1.png') }}" alt="">
    <img class="fotobanner2" src="{{ asset('images/fotobanner2.png') }}" alt="">
    @if (Auth::check())
    @else
    <div class="loginRegisterContainer">
        <a href="{{ url('daftar') }}" class="buttonreg">Daftar</a>
        <a href="{{ url('login') }}" class="buttonlog">Masuk</a>
    </div>
    @endif
</section>
<!-- Hero section end  -->




<section class="services-section">
    <div class="titleSectionContainer" style="text-align: center;">
        <h2 style="font-weight:bolder;">Data UMKM Provinsi NTB</h2>
    </div>
    <div class="container">

        <form action="" method="POST" style="display:none;" id="formChartDetail">
            @csrf
            <input type="text" name="filter" id="filterChartDetail" >
            <!-- <input type="text" name="chartDetailData" id="chartDetailData">
            <input type="text" name="title" id="chartDetailTitle">
            <input type="text" name="chartId" id="chartId"> -->
            <button type="submit" id="submitButtonchartDetail"></button>
        </form>
        <div class="row">
            <div class="col-sm">
                <div class="filterChart">
                    <span>Kabupaten :</span>
                    <select onchange="return changeFilterKabupaten()" name="" id="kabupatenFilter">
                        <option value="" selected>Semua</option>
                        @foreach($kabupaten as $i=>$item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                    <span>Kecamatan :</span>
                    <select onchange="return changeFilterKecamatan()" name="" id="kecamatanFilter">
                        <option value="" selected>Semua</option>
                    </select>
                    <span>Kelurahan :</span>
                    <select onchange="return changeFilterKelurahan()" name="" id="kelurahanFilter">
                        <option value="" selected>Semua</option>
                    </select>
                </div>
            </div>
            <div class="col-sm">
                <div class="filterChart">
                    <span>Cabang Industri :</span>
                    <select onchange="return changeFilterCabangIndustri()" name="" id="cabangIndustriFilter">
                        <option value="" selected>Semua</option>
                        @foreach($cabangIndustri as $i=>$item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                    <span>Sub Cabang Industri :</span>
                    <select onchange="return changeFilterSubCabangIndustri()" name="" id="subCabangIndustriFilter">
                        <option value="" selected>Semua</option>
                    </select>
                    <span>Tahun :</span>
                    <input onchange="return changeFilterTahun()" type="number" placeholder="Tahun" class="p-2 rounded-xl" id="tahunFilter">
                </div>
            </div>
        </div>
        <div class="container text-center">
            <!-- <h5 class="text-center m-3">Data Statistik IKM</h5> -->
            <div class="row">
                <div class="col-sm">
                    <canvas id="Chart1"></canvas>
                </div>
                <div class="col-sm">
                    <div class="chartDescTitle">
                        <span>Klik tombol dibawah untuk lihat detail</span>
                    </div>
                    <div class="ChartContainer">
                        @foreach($chartDescList as $i=>$item)
                        <div class="ChartDescContainer" onclick="return goTodetailsChart('{{$item->title}}','{{$i}}');">
                            <div class="boxChartDesc" style="background-color: {{$item->color}};"></div>
                            <div class="titleChartDesc">{{$item->title}}</div>
                            <div id="ChartDescID{{$i}}" class="valueChartDesc">{{$item->value}}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Services section end  -->


<section class="clients-section spad" style="background-color: #2081E2">
    <div class="container">

        <div class="client-text">
            <h2 style="color: white;font-weight:bolder;">SIMANIS</h2>
            <p>Simanis Adalah Sistem Informasi Manajemen Industri yang berguna untuk mendata para pelaku UMKM yang ada
                di Provinsi Nusa Tenggara Barat dan Membantu dalam memudahkan UMKM untuk melakukan pengajuan Modal.</p>
        </div>
        <div class="download-app-button">
            Download Aplikasi
        </div>
        <br>
        <a href="https://play.google.com/store/apps/details?id=com.disperin.Simanis"><img class="playstoreimg" src="{{ asset('images/playstore.png') }}" alt=""></a>
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
                <!-- <a href="https://api.whatsapp.com/send?phone=6287728937983" target="_blank" class="site-btn sb-dark">Hubungi Kami</a> -->
                <a href="https://api.whatsapp.com/send?phone=6287728937983"><img class="whatsappimg" src="{{ asset('images/whatsapp.png') }}" alt=""></a>
            </div>
        </div>
    </div>
</section>



<h2 style="margin:45px 0;font-family:'Montserrat',sans-serif;text-align:center;color:rgb(90,90,90)">Survei Kepuasan</h2>

<section class="clients-section spad" style="background-color: #2081E2">
    <div class="container">
        <div class="row" style="text-align: center">
            <div class="col">
                <!-- <iframe class="responsive-iframe" src="https://docs.google.com/forms/d/e/1FAIpQLSdampdX0BstgbXIrfSj89fqN-q2TFjt0rmkifEm2n5aTQ3tfQ/viewform?embedded=true" width="auto" height="550" frameborder="0" marginheight="0" marginwidth="0">Memuat…</iframe> -->
                <div style="display: flex;justify-content: center;">
                    <canvas id="Chart2"></canvas>
                </div>
                <div style="display: flex;justify-content:space-between;margin: 20px 0px;">
                    @foreach($surveyChart as $i=>$item)
                    <div class="ChartDescContainer">
                        <div class="boxChartDesc" style="background-color: {{$item->color}};color:white!important"></div>
                        <div class="titleChartDesc" style="color:white!important">{{$item->title}}</div>
                        <div id="ChartDescID{{$i}}" class="valueChartDesc" style="color:white!important">{{$item->value}}</div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col">

                @if(Auth::check())
                <form action="/surveyChart/{{Auth::user()->nik}}" method="POST">
                    @csrf
                    <div style="display:flex;flex-direction: column;align-items: flex-start;color:white;font-weight: bold;">
                        <div>
                            <input type="radio" name="surveiChart" value="Sangat Puas" required> Sangat Puas
                        </div>
                        <div>
                            <input type="radio" name="surveiChart" value="Puas"> Puas
                        </div>
                        <div>
                            <input type="radio" name="surveiChart" value="Tidak Puas"> Tidak Puas
                        </div>
                        <div>
                            <input type="radio" name="surveiChart" value="Sangat Tidak Puas"> Sangat Tidak Puas
                        </div>
                        <button type="submit" class="download-app-button" style="cursor: pointer;">
                            Submit
                        </button>
                    </div>
                </form>
                @else
                <div style="display:flex;flex-direction: column;align-items: flex-start;color:white;font-weight: bold;">
                    <div>
                        <input type="radio" name="surveiChart" value="Sangat Puas" required> Sangat Puas
                    </div>
                    <div>
                        <input type="radio" name="surveiChart" value="Puas"> Puas
                    </div>
                    <div>
                        <input type="radio" name="surveiChart" value="Tidak Puas"> Tidak Puas
                    </div>
                    <div>
                        <input type="radio" name="surveiChart" value="Sangat Tidak Puas"> Sangat Tidak Puas
                    </div>
                    <button type="submit" class="download-app-button" style="cursor: pointer;" onclick="return surveiChartSubmit()">
                        Submit
                    </button>
                </div>
                @endif

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
    const kabupaten = @json($kabupaten);
    const kecamatan = @json($Kecamatan);
    const kelurahan = @json($Kelurahan);
    const cabangIndustri = @json($cabangIndustri);
    const subCabangIndustri = @json($subCabangIndustri);
    let idKabupatenFilterApply = "";
    let kecamatanFilterApply = "";
    let kelurahanFilterApply = "";
    let cabangIndustriFilterApply = "";
    let subCabangIndustriFilterApply = "";
    let tahunFilterApply = "";
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
        'rgba(110, 191, 139, 1)',
        'rgba(54, 21, 0, 1)',
    ]
    let totalIKM = badanUsaha.length;
    let industriKecil = @json($industriKecil).length;
    let industriMenengah = @json($industriMenengah).length;
    let industriBesar = @json($industriBesar).length;
    let totalTenagaKerja = @json($totalTenagaKerja)[0]['total_tenaga_kerja'];
    let totalIKMBaru = @json($totalIKMBaru)[0]['total_ikm_baru'];
    let sertifikatHalal = @json($sertifikatHalal).length;
    let sertifikatHaki = @json($sertifikatHaki).length;
    let sertifikatSNI = @json($sertifikatSNI).length;
    let sertifikatTestReport = @json($sertifikatTestReport).length;
    let formal = @json($formal).length;
    let informal = @json($informal).length;
    let surveyChartData = @json($surveyChartData);
    // console.log(totalTenagaKerja);
    let barChart = [];
    const renderCart = (noChart, Data, bgColor, labelsData) => {
        barChart[noChart] = new Chart(`Chart${noChart}`, {
            type: 'pie',
            data: {
                labels: labelsData,
                datasets: [{

                        data: Data['dataList'],
                        backgroundColor: bgColor,
                    },

                ]
            },
            options: {
                onClick: (_points, _event, barClicked) => {
                    console.log(_event[0].index);
                },
                plugins: {
                    legend: {
                        display: false,
                    },
                    title: {
                        display: false,
                        text: Data['title'],
                        font: {
                            size: 30,
                            weight: 'bold',

                        }
                    }
                }
            }
        });
    }


    const goTodetailsChart = (title, idChart) => {
        const filter = JSON.stringify([{
                'prop': 'id_kabupaten',
                'value': idKabupatenFilterApply
            }, {
                'prop': 'kecamatan',
                'value': kecamatanFilterApply,

            },
            {
                'prop': 'kelurahan',
                'value': kelurahanFilterApply,

            },
            {
                'prop': 'cabang_industri',
                'value': cabangIndustriFilterApply,

            },
            {
                'prop': 'sub_cabang_industri',
                'value': subCabangIndustriFilterApply,

            },
            {
                'prop': 'tahun_berdiri',
                'value': tahunFilterApply,

            },

        ].filter(e => e.value !== "" && e.value !== "Semua"))
        const formChartDetail = document.getElementById('formChartDetail');
        const filterChartDetail = document.getElementById('filterChartDetail');
        const submitButtonchartDetail = document.getElementById('submitButtonchartDetail');
        // formChartDetail.action = `/chartDetail/${filter}/${idChart}/${title}`;
        filterChartDetail.value=filter;
        formChartDetail.action = `/chartDetail/${idChart}/${title}`;
        submitButtonchartDetail.click();
    }

    const changeFilterKabupaten = () => {
        const kabupatenFilter = document.getElementById('kabupatenFilter');
        const idKabupaten = kabupatenFilter.options[kabupatenFilter.selectedIndex].value;
        renderKecamatanSelectFilter(idKabupaten);
        renderKelurahanSelectFilter(0)
        idKabupatenFilterApply = idKabupaten;
        kecamatanFilterApply = "";
        kelurahanFilterApply = "";
        console.log(idKabupatenFilterApply);
        applyFilter(
            idKabupatenFilterApply, kecamatanFilterApply, kelurahanFilterApply, cabangIndustriFilterApply, subCabangIndustriFilterApply,tahunFilterApply
        )
    }

    const changeFilterKecamatan = () => {
        const kecamatanFilter = document.getElementById('kecamatanFilter');
        const idKecamatan = kecamatanFilter.options[kecamatanFilter.selectedIndex].value;
        const textKecamatan = kecamatanFilter.options[kecamatanFilter.selectedIndex].text;
        renderKelurahanSelectFilter(idKecamatan);
        kecamatanFilterApply = textKecamatan;
        kelurahanFilterApply = "";
        applyFilter(
            idKabupatenFilterApply, kecamatanFilterApply, kelurahanFilterApply, cabangIndustriFilterApply, subCabangIndustriFilterApply,tahunFilterApply
        )
    }

    const changeFilterKelurahan = () => {
        const kelurahanFilter = document.getElementById('kelurahanFilter');
        const idKelurahan = kelurahanFilter.options[kelurahanFilter.selectedIndex].value;
        const textKelurahan = kelurahanFilter.options[kelurahanFilter.selectedIndex].text;
        kelurahanFilterApply = textKelurahan;
        applyFilter(
            idKabupatenFilterApply, kecamatanFilterApply, kelurahanFilterApply, cabangIndustriFilterApply, subCabangIndustriFilterApply,tahunFilterApply
        )
    }

    const changeFilterCabangIndustri = () => {
        const cabangIndustriFilter = document.getElementById('cabangIndustriFilter');
        const idCabangIndsutri = cabangIndustriFilter.options[cabangIndustriFilter.selectedIndex].value;
        const textCabangIndsutri = cabangIndustriFilter.options[cabangIndustriFilter.selectedIndex].text;

        renderSubCabangIndustriSelectFilter(idCabangIndsutri);
        cabangIndustriFilterApply = textCabangIndsutri;
        subCabangIndustriFilterApply = "";
        applyFilter(
            idKabupatenFilterApply, kecamatanFilterApply, kelurahanFilterApply, cabangIndustriFilterApply, subCabangIndustriFilterApply,tahunFilterApply
        )
    }

    const changeFilterSubCabangIndustri = () => {
        const subCabangIndustriFilter = document.getElementById('subCabangIndustriFilter');
        const idSubCabangIndsutri = subCabangIndustriFilter.options[subCabangIndustriFilter.selectedIndex].value;
        const textSubCabangIndsutri = subCabangIndustriFilter.options[subCabangIndustriFilter.selectedIndex].text;
        subCabangIndustriFilterApply = textSubCabangIndsutri;
        applyFilter(
            idKabupatenFilterApply, kecamatanFilterApply, kelurahanFilterApply, cabangIndustriFilterApply, subCabangIndustriFilterApply,tahunFilterApply
        )
    }
    const changeFilterTahun = () => {
        const tahunFilter = document.getElementById('tahunFilter');
        tahunFilterApply = tahunFilter.value;
        applyFilter(
            idKabupatenFilterApply, kecamatanFilterApply, kelurahanFilterApply, cabangIndustriFilterApply, subCabangIndustriFilterApply,tahunFilterApply
        )
    }

    const renderKecamatanSelectFilter = (idKabupaten) => {
        var str = `<option value=''>Semua</option>`
        const kecamatanList = kecamatan.filter(e => e.id_kabupaten == idKabupaten);
        for (let item of kecamatanList) {
            str += `<option value='${item.id}'>` + item.name + "</option>"
        }
        document.getElementById("kecamatanFilter").innerHTML = str;
    }

    const renderKelurahanSelectFilter = (idKecamatan) => {
        var str = `<option value=''>Semua</option>`
        const kelurahanList = kelurahan.filter(e => e.id_kecamatan == idKecamatan);
        for (let item of kelurahanList) {
            str += `<option value='${item.id}'>` + item.name + "</option>"
        }
        document.getElementById("kelurahanFilter").innerHTML = str;
    }

    const renderSubCabangIndustriSelectFilter = (idCabangIndsutri) => {

        var str = `<option value=''>Semua</option>`
        const subCabangIndustriList = subCabangIndustri.filter(e => e.id_cabang_industri == idCabangIndsutri);

        for (let item of subCabangIndustriList) {
            str += `<option value='${item.id}'>` + item.name + "</option>"
        }
        document.getElementById("subCabangIndustriFilter").innerHTML = str;
    }



    const applyFilter = (idKabupaten, kecamatan, kelurahan, cabang_industri, subCabangIndustri,tahun) => {
        const filters = [{
                prop: 'id_kabupaten',
                value: idKabupaten
            },
            {
                prop: 'kecamatan',
                value: kecamatan
            },
            {
                prop: 'kelurahan',
                value: kelurahan
            },
            {
                prop: 'cabang_industri',
                value: cabang_industri
            },
            {
                prop: 'sub_cabang_industri',
                value: subCabangIndustri
            },
            {
                prop: 'tahun_berdiri',
                value: tahun
            },

        ].filter(e => e.value !== "" && e.value !== "Semua");

        let totalIKMUpdate = badanUsaha;
        let industriKecilUpdate = badanUsaha.filter(e => parseInt(e.investasi_modal) <= 1000000);
        let industriMenengahUpdate = badanUsaha.filter(e => parseInt(e.investasi_modal) > 1000000 && e.investasi_modal < 15000000);
        let industriBesarUpdate = badanUsaha.filter(e => parseInt(e.investasi_modal) >= 15000000);
        let totalTenagaKerjaUpdate = totalTenagaKerja;
        let totalIKMBaruUpdate = badanUsaha.filter(e => parseInt(e.tahun_berdiri) == new Date().getFullYear());
        let sertifikatHalalUpdate = badanUsaha.filter(e => e.nomor_sertifikat_halal_tahun !== null);
        let sertifikatHakiUpdate = badanUsaha.filter(e => e.sertifikat_merek_tahun !== null);
        let sertifikatSNIUpdate = badanUsaha.filter(e => e.sni_tahun !== null);
        let sertifikatTestReportUpdate = badanUsaha.filter(e => e.nomor_test_report_tahun !== null);
        let formalUpdate = badanUsaha.filter(e => e.formal_informal === "1");
        let informalUpdate = badanUsaha.filter(e => e.formal_informal === "0");
        console.log(formalUpdate);
        console.log(informalUpdate);

        for (let filterData of filters) {
            totalIKMUpdate = totalIKMUpdate.filter(e => (e[filterData.prop] !== null ? e[filterData.prop] : '').toString() === filterData.value);
            industriKecilUpdate = industriKecilUpdate.filter(e => (e[filterData.prop] !== null ? e[filterData.prop] : '').toString() === filterData.value);
            industriMenengahUpdate = industriMenengahUpdate.filter(e => (e[filterData.prop] !== null ? e[filterData.prop] : '').toString() === filterData.value);
            industriBesarUpdate = industriBesarUpdate.filter(e => (e[filterData.prop] !== null ? e[filterData.prop] : '').toString() === filterData.value);
            // totalTenagaKerjaUpdate = totalTenagaKerjaUpdate.filter(e => (e[filterData.prop] !== null ? e[filterData.prop] : '').toString() === filterData.value);
            // totalTenagaKerjaUpdate = 10;
            totalIKMUpdate.forEach(e => {
                // console.log(e);
                // console.log(parseInt(e.jumlah_tenaga_kerja_wanita));
                totalTenagaKerjaUpdate += (parseInt(e.jumlah_tenaga_kerja_pria === null ? 0 : e.jumlah_tenaga_kerja_pria) + parseInt(e.jumlah_tenaga_kerja_wanita === null ? 0 : e.jumlah_tenaga_kerja_wanita));
            })
            totalIKMBaruUpdate = totalIKMBaruUpdate.filter(e => (e[filterData.prop] !== null ? e[filterData.prop] : '').toString() === filterData.value);
            sertifikatHalalUpdate = sertifikatHalalUpdate.filter(e => (e[filterData.prop] !== null ? e[filterData.prop] : '').toString() === filterData.value);
            sertifikatHakiUpdate = sertifikatHakiUpdate.filter(e => (e[filterData.prop] !== null ? e[filterData.prop] : '').toString() === filterData.value);
            sertifikatSNIUpdate = sertifikatSNIUpdate.filter(e => (e[filterData.prop] !== null ? e[filterData.prop] : '').toString() === filterData.value);
            sertifikatTestReportUpdate = sertifikatTestReportUpdate.filter(e => (e[filterData.prop] !== null ? e[filterData.prop] : '').toString() === filterData.value);
            formalUpdate = formalUpdate.filter(e => (e[filterData.prop] !== null ? e[filterData.prop] : '').toString() === filterData.value);
            informalUpdate = informalUpdate.filter(e => (e[filterData.prop] !== null ? e[filterData.prop] : '').toString() === filterData.value);
        }
        industriData = [totalIKMUpdate.length, totalTenagaKerjaUpdate, totalIKMBaruUpdate.length, industriKecilUpdate.length, industriMenengahUpdate.length, industriBesarUpdate.length, sertifikatHalalUpdate.length, sertifikatHakiUpdate.length, sertifikatSNIUpdate.length, sertifikatTestReportUpdate.length, formalUpdate.length, informalUpdate.length];

        for (let i = 0; i < industriData.length; i++) {
            const descValueChart = document.getElementById('ChartDescID' + i);
            descValueChart.innerHTML = industriData[i];
        }


        barChart[1].data.datasets[0].data = industriData;
        barChart[1].update();

    }



    labelsName = ['total iKM', 'Tenaga Kerja', 'IKM Baru', 'Industri Kecil', 'Industri Menengah', 'Industri Besar', 'Sertifikikat Halal', 'Sertifikikat HAKI', 'Sertifikikat SNI', 'Sertifikat Test Report', 'Formal', 'Informal'];
    industriData = [totalIKM, totalTenagaKerja, totalIKMBaru, industriKecil, industriMenengah, industriBesar, sertifikatHalal, sertifikatHaki, sertifikatSNI, sertifikatTestReport, formal, informal];
    bgColorChart = bgColorList.slice(0, industriData.length);
    data = [{
        'title': 'Industri',
        'dataList': industriData,
    }, ]
    renderCart(1, data[0], bgColorChart, labelsName)

    labelsName2 = ['Sangat Puas', 'Puas', 'Kurang Puas', 'Sangat Tidak Puas'];
    // industriData2 = ['20%','45%','10%','25%'];
    // console.log(surveyChartData[0]['sp']);
    industriData2 = [surveyChartData[0]['sp'], surveyChartData[0]['p'], surveyChartData[0]['tp'], surveyChartData[0]['stp']];
    bgColorChart2 = ['rgba(54, 21, 0, 1)', 'rgba(153, 102, 255, 1)', 'rgba(0,255,0, 1)', 'rgba(0,255,255, 1)'];
    data2 = [{
        'title': 'Survei Kepuasan',
        'dataList': industriData2,
    }, ]
    renderCart(2, data2[0], bgColorChart2, labelsName2)
</script>

<script>
    const surveiChartSubmit = () => {
        alert("Login Terlebih Dahulu");
    }
</script>
@endsection