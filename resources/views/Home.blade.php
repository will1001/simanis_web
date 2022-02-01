@extends('layouts.public', ['include_chart' => true])
@section('title')
UMKM NTB
@stop
<style>
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

<?php
$chartTitle = [
    "SEBARAN INDUSTRI (IKM) NTB BERBASIS SKALA INDUSTRI",
    "SEBARAN INDUSTRI KECIL DAN MENENGAH (IKM) NTB BERBASIS KABUPATEN/ KOTA",
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

        @foreach($chartTitle as $i=>$title)
        <div class="container text-center">
            <h5 class="text-center m-3">{{$title}}</h5>
            @if($i == 0)
            <div class="row">
                <div class="col-sm">
                    <canvas id="Chart{{$i+$i+$i+1}}"></canvas>
                </div>
            </div>
            @else
            <div class="row">
                <div class="col-sm">
                    <h5 class="text-center">Industri Kecil</h5>
                    <canvas id="Chart{{$i+$i+$i+1}}"></canvas>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <h5 class="text-center">Industri Menengah</h5>
                    <canvas id="Chart{{$i+$i+$i+2}}"></canvas>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <h5 class="text-center">Industri Besar</h5>
                    <canvas id="Chart{{$i+$i+$i+3}}"></canvas>
                </div>
            </div>
            @endif
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
    const kecamatan = @json($Kecamatan);
    const kelurahan = @json($Kelurahan);
    const chartTitle = @json($chartTitle);
    const cabangIndustri = @json($cabangIndustri);
    const subCabangIndustri = @json($subCabangIndustri);
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
    let industriKecil = badanUsaha.filter(e => parseInt(e.investasi_modal) < 1000000000);
    let industriMenengah = badanUsaha.filter(e => parseInt(e.investasi_modal) > 1000000000 && e.investasi_modal < 15000000000);
    let industriBesar = badanUsaha.filter(e => parseInt(e.investasi_modal) > 15000000000);
    let barChart = [];
    const renderCart = (noChart, Data, bgColor, labelsData) => {
        barChart[noChart] = new Chart(`Chart${noChart+1}`, {
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
                        onClick: (_points, _event, barClicked) => {
                            console.log(_points.chart._sortedMetasets[0]._parsed);
                            // console.log(barClicked);
                            // console.log(_event);

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

    let idKabupatenFilterApply = "";
    let kecamatanFilterApply = "";
    let kelurahanFilterApply = "";
    let cabangIndustriFilterApply = "";
    let subCabangIndustriFilterApply = "";

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
        const kecamatanList = kecamatan.filter(e => e.regency_id == idKabupaten);
        for (let item of kecamatanList) {
            str += `<option value='${item.id}'>` + item.name + "</option>"
        }
        document.getElementById("kecamatanFilter").innerHTML = str;
    }

    const renderKelurahanSelectFilter = (idKecamatan) => {
        var str = `<option value=''>Semua</option>`
        const kelurahanList = kelurahan.filter(e => e.district_id == idKecamatan);
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

        ].filter(e => e.value !== "");
        console.log(filters);
        for (let i = 0; i < chartTitle.length; i++) {
            if (i === 0) {
                const IndustriList = ["Industri Kecil", "Industri Menengah", "Industri Besar"];
                let ik = industriKecil;
                let im = industriMenengah;
                let ib = industriBesar;
                for (let filter of filters) {
                    ik = ik.filter(e => (e[filter.prop] !== null ? e[filter.prop] : '').toString() === filter.value);
                    im = im.filter(e => (e[filter.prop] !== null ? e[filter.prop] : '').toString() === filter.value);
                    ib = ib.filter(e => (e[filter.prop] !== null ? e[filter.prop] : '').toString() === filter.value);
                }
                industriData = [
                    ik.length,
                    im.length,
                    ib.length,
                ]
                barChart[0].data.datasets[0].data = industriData;
                barChart[0].update();
            } else if (i === 1) {
                const formalInformal = ["FORMAL", "INFORMAL"];
                let ik = [];
                let im = [];
                let ib = [];
                for (let j = 0; j < formalInformal.length; j++) {
                    let aaaa = industriKecil.filter(param => param.formal_informal === formalInformal[j])
                    let bbbb = industriMenengah.filter(param => param.formal_informal === formalInformal[j])
                    let cccc = industriBesar.filter(param => param.formal_informal === formalInformal[j])

                    for (let filter of filters) {
                        aaaa = aaaa.filter(e => (e[filter.prop] !== null ? e[filter.prop] : '').toString() === filter.value);
                        bbbb = bbbb.filter(e => (e[filter.prop] !== null ? e[filter.prop] : '').toString() === filter.value);
                        cccc = cccc.filter(e => (e[filter.prop] !== null ? e[filter.prop] : '').toString() === filter.value);
                    }


                    ik[j] = aaaa.length;
                    im[j] = bbbb.length;
                    ib[j] = cccc.length;
                }

                data = [ik, im, ib];

                for (let k = i + i + i; k < data.length + i + i + i; k++) {
                    barChart[k].data.datasets[0].data = data[k - i - i - i];
                    barChart[k].update();
                }

            } else if (i === 2) {
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
                let ik = [];
                let im = [];
                let ib = [];
                for (let j = 0; j < kabupaten.length; j++) {
                    let aaaa = industriKecil.filter(param => parseInt(param.id_kabupaten) === parseInt(kabupaten[j]['id']))
                    let bbbb = industriMenengah.filter(param => parseInt(param.id_kabupaten) === parseInt(kabupaten[j]['id']))
                    let cccc = industriBesar.filter(param => parseInt(param.id_kabupaten) === parseInt(kabupaten[j]['id']))

                    for (let filter of filters) {
                        aaaa = aaaa.filter(e => (e[filter.prop] !== null ? e[filter.prop] : '').toString() === filter.value);
                        bbbb = bbbb.filter(e => (e[filter.prop] !== null ? e[filter.prop] : '').toString() === filter.value);
                        cccc = cccc.filter(e => (e[filter.prop] !== null ? e[filter.prop] : '').toString() === filter.value);
                    }

                    ik[j] = aaaa.length;
                    im[j] = bbbb.length;
                    ib[j] = cccc.length;

                }
                data = [ik, im, ib];

                for (let k = i + i + i; k < data.length + i + i + i; k++) {
                    barChart[k].data.datasets[0].data = data[k - i - i - i];
                    barChart[k].update();
                }
            } else if (i === 3) {
                const cabangIndustriLabel = [
                    "Pangan",
                    "Hulu Agro",
                    "Permesinan",
                    "Hasil Pertambangan",
                    "Kesehatan",
                    "Ekonomi Kreatif",
                ];
                let ik = [];
                let im = [];
                let ib = [];
                for (let j = 0; j < cabangIndustri.length; j++) {
                    let aaaa = industriKecil.filter(param => param.cabang_industri?.toLowerCase() === cabangIndustri[j]['name']?.toLowerCase())
                    let bbbb = industriMenengah.filter(param => param => param.cabang_industri?.toLowerCase() === cabangIndustri[j]['name']?.toLowerCase())
                    let cccc = industriBesar.filter(param => param => param.cabang_industri?.toLowerCase() === cabangIndustri[j]['name']?.toLowerCase())

                    for (let filter of filters) {
                        aaaa = aaaa.filter(e => (e[filter.prop] !== null ? e[filter.prop] : '').toString() === filter.value);
                        bbbb = bbbb.filter(e => (e[filter.prop] !== null ? e[filter.prop] : '').toString() === filter.value);
                        cccc = cccc.filter(e => (e[filter.prop] !== null ? e[filter.prop] : '').toString() === filter.value);
                    }

                    ik[j] = aaaa.length;
                    im[j] = bbbb.length;
                    ib[j] = cccc.length;

                }
                data = [ik, im, ib];

                for (let k = i + i + i; k < data.length + i + i + i; k++) {
                    barChart[k].data.datasets[0].data = data[k - i - i - i];
                    barChart[k].update();
                }
            } else if (i === 4) {
                let ik = [];
                let im = [];
                let ib = [];
                const sertifikatHalal = ["Memiliki Sertifikasi Halal", "Tidak Memiliki Sertifikasi Halal"];

                let aaaa = industriKecil.filter(param => param.nomor_sertifikat_halal_tahun !== null)
                let bbbb = industriMenengah.filter(param => param.nomor_sertifikat_halal_tahun !== null)
                let cccc = industriBesar.filter(param => param.nomor_sertifikat_halal_tahun !== null)

                let dddd = industriKecil;
                let eeee = industriMenengah;
                let ffff = industriBesar;

                for (let filter of filters) {
                    aaaa = aaaa.filter(e => (e[filter.prop] !== null ? e[filter.prop] : '').toString() === filter.value);
                    bbbb = bbbb.filter(e => (e[filter.prop] !== null ? e[filter.prop] : '').toString() === filter.value);
                    cccc = cccc.filter(e => (e[filter.prop] !== null ? e[filter.prop] : '').toString() === filter.value);
                    dddd = dddd.filter(e => (e[filter.prop] !== null ? e[filter.prop] : '').toString() === filter.value);
                    eeee = eeee.filter(e => (e[filter.prop] !== null ? e[filter.prop] : '').toString() === filter.value);
                    ffff = ffff.filter(e => (e[filter.prop] !== null ? e[filter.prop] : '').toString() === filter.value);
                }

                ik = [aaaa.length, dddd.length - aaaa.length];
                im = [bbbb.length, eeee.length - bbbb.length];
                ib = [cccc.length, ffff.length - cccc.length];

                data = [ik, im, ib];

                for (let k = i + i + i; k < data.length + i + i + i; k++) {
                    barChart[k].data.datasets[0].data = data[k - i - i - i];
                    barChart[k].update();
                }

            } else if (i === 5) {
                let ik = [];
                let im = [];
                let ib = [];
                const sertifikatMerek = ["Memiliki Sertifikasi Merek", "Tidak Memiliki Sertifikasi Merek"];

                let aaaa = industriKecil.filter(param => param.sertifikat_merek_tahun !== null)
                let bbbb = industriMenengah.filter(param => param.sertifikat_merek_tahun !== null)
                let cccc = industriBesar.filter(param => param.sertifikat_merek_tahun !== null)

                let dddd = industriKecil;
                let eeee = industriMenengah;
                let ffff = industriBesar;

                for (let filter of filters) {
                    aaaa = aaaa.filter(e => (e[filter.prop] !== null ? e[filter.prop] : '').toString() === filter.value);
                    bbbb = bbbb.filter(e => (e[filter.prop] !== null ? e[filter.prop] : '').toString() === filter.value);
                    cccc = cccc.filter(e => (e[filter.prop] !== null ? e[filter.prop] : '').toString() === filter.value);
                    dddd = dddd.filter(e => (e[filter.prop] !== null ? e[filter.prop] : '').toString() === filter.value);
                    eeee = eeee.filter(e => (e[filter.prop] !== null ? e[filter.prop] : '').toString() === filter.value);
                    ffff = ffff.filter(e => (e[filter.prop] !== null ? e[filter.prop] : '').toString() === filter.value);
                }

                ik = [aaaa.length, dddd.length - aaaa.length];
                im = [bbbb.length, eeee.length - bbbb.length];
                ib = [cccc.length, ffff.length - cccc.length];

                data = [ik, im, ib];

                for (let k = i + i + i; k < data.length + i + i + i; k++) {
                    barChart[k].data.datasets[0].data = data[k - i - i - i];
                    barChart[k].update();
                }

            }

        }

    }



    for (let i = 0; i < chartTitle.length; i++) {
        let ik = new Array(kabupaten.length);
        let im = new Array(kabupaten.length);
        let ib = new Array(kabupaten.length);
        let labelsName;
        let bgColorChart;
        if (i === 0) {
            const IndustriList = ["Industri Kecil", "Industri Menengah", "Industri Besar"];
            industriData = [
                industriKecil.length,
                industriMenengah.length,
                industriBesar.length,
            ]
            labelsName = IndustriList;
            bgColorChart = bgColorList.slice(0, IndustriList.length);
        } else if (i === 1) {
            const formalInformalLabel = ["Legalitas Usaha (Formal)", "Legalitas Usaha (Informal)"];
            const formalInformal = ["FORMAL", "INFORMAL"];
            for (let j = 0; j < formalInformal.length; j++) {
                const aaaa = industriKecil.filter(param => param.formal_informal === formalInformal[j])
                const bbbb = industriMenengah.filter(param => param.formal_informal === formalInformal[j])
                const cccc = industriBesar.filter(param => param.formal_informal === formalInformal[j])


                ik[j] = aaaa.length;
                im[j] = bbbb.length;
                ib[j] = cccc.length;
                labelsName = formalInformalLabel;
                bgColorChart = bgColorList.slice(0, formalInformal.length);
            }

        } else if (i === 2) {
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
                const aaaa = industriKecil.filter(param => parseInt(param.id_kabupaten) === parseInt(kabupaten[j]['id']))
                const bbbb = industriMenengah.filter(param => parseInt(param.id_kabupaten) === parseInt(kabupaten[j]['id']))
                const cccc = industriBesar.filter(param => parseInt(param.id_kabupaten) === parseInt(kabupaten[j]['id']))

                ik[j] = aaaa.length;
                im[j] = bbbb.length;
                ib[j] = cccc.length;
                labelsName = kabupatenLabel;
                bgColorChart = bgColorList;

            }
        } else if (i === 3) {
            const cabangIndustriLabel = [
                "Pangan",
                "Hulu Agro",
                "permesinan",
                "Hasil Pertambangan",
                "Kesehatan",
                "Ekonomi Kreatif",
            ];
            for (let j = 0; j < cabangIndustri.length; j++) {
                const aaaa = industriKecil.filter(param => param.cabang_industri?.toLowerCase() === cabangIndustri[j]['name']?.toLowerCase())

                const bbbb = industriMenengah.filter(param => param.cabang_industri?.toLowerCase() === cabangIndustri[j]['name']?.toLowerCase())
                const cccc = industriBesar.filter(param => param.cabang_industri?.toLowerCase() === cabangIndustri[j]['name']?.toLowerCase())

                ik[j] = aaaa.length;
                im[j] = bbbb.length;
                ib[j] = cccc.length;
                labelsName = cabangIndustriLabel;
                bgColorChart = bgColorList.slice(0, cabangIndustri.length);

            }
        } else if (i === 4) {
            const sertifikatHalal = ["Memiliki Sertifikasi Halal", "Tidak Memiliki Sertifikasi Halal"];
            const aaaa = industriKecil.filter(param => param.nomor_sertifikat_halal_tahun !== null)
            const bbbb = industriMenengah.filter(param => param.nomor_sertifikat_halal_tahun !== null)
            const cccc = industriBesar.filter(param => param.nomor_sertifikat_halal_tahun !== null)

            ik = [aaaa.length, industriKecil.length - aaaa.length];
            im = [bbbb.length, industriMenengah.length - bbbb.length];
            ib = [cccc.length, industriBesar.length - cccc.length];
            labelsName = sertifikatHalal;
            bgColorChart = bgColorList.slice(0, sertifikatHalal.length);

        } else if (i === 5) {
            const sertifikatMerek = ["Memiliki Sertifikasi Merek", "Tidak Memiliki Sertifikasi Merek"];
            const aaaa = industriKecil.filter(param => param.sertifikat_merek_tahun !== null)
            const bbbb = industriMenengah.filter(param => param.sertifikat_merek_tahun !== null)
            const cccc = industriBesar.filter(param => param.sertifikat_merek_tahun !== null)

            ik = [aaaa.length, industriKecil.length - aaaa.length];
            im = [bbbb.length, industriMenengah.length - bbbb.length];
            ib = [cccc.length, industriBesar.length - cccc.length];
            labelsName = sertifikatMerek;
            bgColorChart = bgColorList.slice(0, sertifikatMerek.length);

        } else {
            ik[j] = [];
            im[j] = [];
            ib[j] = [];
            labelsName = [];
            bgColorChart = [];
        }





        let data = [];




        if (i === 0) {
            data = [{
                'title': 'Industri',
                'dataList': industriData
            }, ]

        } else {
            data = [{
                    'title': 'Industri Kecil',
                    'dataList': ik
                },
                {
                    'title': 'Industri Menengah',
                    'dataList': im
                },
                {
                    'title': 'Industri Besar',
                    'dataList': ib
                },
            ];
        }

        for (let k = i + i + i; k < data.length + i + i + i; k++) {


            renderCart(k, data[k - i - i - i], bgColorChart, labelsName)
        }


    }
</script>
@endsection