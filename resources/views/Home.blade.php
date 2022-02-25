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
                        <a href="{{ url('login') }}" class="site-btn sb-white">Login</a>
                        @endif

                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- Hero section end  -->




<section class="services-section p-3">
    <div class="container">
        <div style="text-align: center;">
            <h2 style="font-weight:bolder;">Data UMKM Provinsi NTB</h2>
        </div>
        <form action="" method="GET" style="display:none;" id="formChartDetail">
            <!-- @csrf -->
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
                </div>
            </div>
        </div>
        <div class="container text-center">
            <!-- <h5 class="text-center m-3">Data Statistik IKM</h5> -->
            <div class="row">
                <div class="col-sm">
                    <canvas id="Chart1"></canvas>
                </div>
            </div>
        </div>
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
    const kecamatan = @json($Kecamatan);
    const kelurahan = @json($Kelurahan);
    const cabangIndustri = @json($cabangIndustri);
    const subCabangIndustri = @json($subCabangIndustri);
    let idKabupatenFilterApply = "";
    let kecamatanFilterApply = "";
    let kelurahanFilterApply = "";
    let cabangIndustriFilterApply = "";
    let subCabangIndustriFilterApply = "";
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
    // console.log(totalTenagaKerja);
    let barChart = [];
    const renderCart = (noChart, Data, bgColor, labelsData) => {
        barChart[noChart] = new Chart(`Chart1`, {
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
                        position: window.screen.availWidth <= 400 ? "bottom" : "right",
                        itemStyle: {
                            width: 90 // or whatever, auto-wrap
                        },
                        onClick: (_points, _event) => {
                            for (let i = 0; i < Data['dataDetailsList'].length; i++) {
                                if (labelsData[i] === _event.text.split(":")[0].substring(0, _event.text.split(":")[0].length - 1)) {

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

                                    ].filter(e => e.value !== "" && e.value !== "Semua"))
                                    const formChartDetail = document.getElementById('formChartDetail');
                                    const submitButtonchartDetail = document.getElementById('submitButtonchartDetail');
                                    let chartID = _points.chart.canvas.id;
                                    chartID = chartID.substring(5, chartID.length)
                                    const title = _event.text;
                                    formChartDetail.action = `/chartDetail/${filter}/${chartID}/${title}`;
                                    submitButtonchartDetail.click();
                                }

                            }


                        },
                        labels: {
                            boxWidth: 10,
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
                        font: {
                            size: 30,
                            weight: 'bold',

                        }
                    }
                }
            }
        });
    }



    const changeFilterKabupaten = () => {
        const kabupatenFilter = document.getElementById('kabupatenFilter');
        const idKabupaten = kabupatenFilter.options[kabupatenFilter.selectedIndex].value;
        renderKecamatanSelectFilter(idKabupaten);
        renderKelurahanSelectFilter(0)
        idKabupatenFilterApply = idKabupaten;
        kecamatanFilterApply = "";
        kelurahanFilterApply = "";
        applyFilter(
            idKabupatenFilterApply, kecamatanFilterApply, kelurahanFilterApply, cabangIndustriFilterApply, subCabangIndustriFilterApply
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
            idKabupatenFilterApply, kecamatanFilterApply, kelurahanFilterApply, cabangIndustriFilterApply, subCabangIndustriFilterApply
        )
    }

    const changeFilterKelurahan = () => {
        const kelurahanFilter = document.getElementById('kelurahanFilter');
        const idKelurahan = kelurahanFilter.options[kelurahanFilter.selectedIndex].value;
        const textKelurahan = kelurahanFilter.options[kelurahanFilter.selectedIndex].text;
        kelurahanFilterApply = textKelurahan;
        applyFilter(
            idKabupatenFilterApply, kecamatanFilterApply, kelurahanFilterApply, cabangIndustriFilterApply, subCabangIndustriFilterApply
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
            idKabupatenFilterApply, kecamatanFilterApply, kelurahanFilterApply, cabangIndustriFilterApply, subCabangIndustriFilterApply
        )
    }

    const changeFilterSubCabangIndustri = () => {
        const subCabangIndustriFilter = document.getElementById('subCabangIndustriFilter');
        const idSubCabangIndsutri = subCabangIndustriFilter.options[subCabangIndustriFilter.selectedIndex].value;
        const textSubCabangIndsutri = subCabangIndustriFilter.options[subCabangIndustriFilter.selectedIndex].text;
        subCabangIndustriFilterApply = textSubCabangIndsutri;
        applyFilter(
            idKabupatenFilterApply, kecamatanFilterApply, kelurahanFilterApply, cabangIndustriFilterApply, subCabangIndustriFilterApply
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



    const applyFilter = (idKabupaten, kecamatan, kelurahan, cabang_industri, subCabangIndustri) => {
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

        ].filter(e => e.value !== "" && e.value !== "Semua");


    }



    labelsName = ['total iKM', 'Tenaga Kerja', 'IKM Baru', 'Industri Kecil', 'Industri Menengah', 'Industri Besar', 'Sertifikikat Halal', 'Sertifikikat HAKI', 'Sertifikikat SNI', 'Sertifikat Test Report', 'Formal', 'Informal'];
    industriData = [totalIKM, totalTenagaKerja, totalIKMBaru, industriKecil, industriMenengah, industriBesar, sertifikatHalal, sertifikatHaki, sertifikatSNI, sertifikatTestReport, formal, informal];
    bgColorChart = bgColorList.slice(0, industriData.length);
    data = [{
        'title': 'Industri',
        'dataList': industriData,
    }, ]
    renderCart(0, data[0], bgColorChart, labelsName)
</script>
@endsection