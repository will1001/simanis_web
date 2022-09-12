<!DOCTYPE html>
<html lang="en" ng-app="myApp">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/logo_ntb.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <title>@yield('title') | SIMANIS</title>
    <!-- Bootstrap Core CSS -->
    <!-- <link href="{{ asset('template/css/bootstrap.min.css') }}" rel="stylesheet"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- This is for the animation CSS -->
    <link href="{{ asset('template2/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('template2/prism.css') }}" rel="stylesheet">
    <link href="{{ asset('template2/perfect-scrollbar.min.css') }}" rel="stylesheet">
    <!-- This page CSS -->

    <!-- Custom CSS -->
    <link href="{{ asset('template2/shop.css') }}" rel="stylesheet">
    <link href="{{ asset('template2/style.css') }}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('select2/css/select2.min.css') }}" rel="stylesheet">
    <!-- template 3 -->
    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('tmplate3/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('tmplate3/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('tmplate3/css/magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ asset('tmplate3/css/slicknav.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('tmplate3/css/owl.carousel.min.css') }}" />

    <!-- Main Stylesheets -->
    <link rel="stylesheet" href="{{ asset('tmplate3/css/style.css') }}" />
    <!-- template 3 -->
    <script src="{{ asset('vendor/kamscore/string.utils.js') }}" rel="stylesheet" type="text/javascript"></script>

    <?php if (isset($include_chart) && $include_chart == true) : ?>
        <script src="{{ asset('vendor/chart.js/Chart.min.js') }}" rel="stylesheet" type="text/javascript"></script>
    <?php endif ?>

    {{--
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" rel="stylesheet">
    --}}
    <link href="{{ asset('assets/css/components.min.css') }}" rel="stylesheet" type="text/css">
    <style>
        .grid-container {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr;
            /* grid-template-rows: 1fr 1fr 1fr; */
            gap: 0px 0px;
            grid-template-areas:
                "title title graphcont graphcont"
                "tab1 tab2 graphcont graphcont"
                ". . . .";
        }

        .titlenya {
            grid-area: title;
            margin: auto;
        }

        .tab1 {
            grid-area: tab1;
        }

        .tab2 {
            grid-area: tab2;
        }

        .graphcont {
            grid-area: graphcont;
            padding: 50px;
        }

        .graphdiv {
            width: 600px;
            height: 450px;
        }

        @media only screen and (max-width: 600px) {
            .grid-container {
                display: contents;
                position: absolute;
                text-align: center;

            }

            .titlenya {
                grid-area: title;
                margin: auto;
            }

            .tab1 {
                grid-area: tab1;
            }

            .tab2 {
                grid-area: tab2;
            }

            .graphcont {
                grid-area: graphcont;
                display: flex;

            }

            .graphdiv {
                width: 400px;
                height: 350px;
            }

        }


        .select2-dynamic {
            width: 100% !important;
        }

        .select2 {
            width: 100% !important;
        }

        .select2-selection--single .select2-selection__arrow:after {
            content: '';
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            border-top: 5px solid #333;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
        }

        .select2-search--dropdown .select2-search__field {
            padding: .4375rem .875rem;
            /* padding-left: 2.5625rem; */
            border: 1px solid #ddd;
            outline: 0;
            width: 100%;
            border-radius: .1875rem;
        }

        .select2-container .select2-selection--single {
            box-sizing: border-box;
            cursor: pointer;
            display: block;
            /* height: 28px; */
            user-select: none;
            -webkit-user-select: none;
        }

        .select2-selection--single {
            cursor: pointer;
            outline: 0;
            display: block;
            padding: 0 0;
            /* line-height: 1.5385; */
            /* color: #333; */
            position: relative;
            border: 1px solid transparent;
            white-space: nowrap;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            border-radius: .1875rem;
            transition: all ease-in-out .15s;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 55px;
            position: absolute;
            top: 1px;
            right: 1px;
            width: 20px;
        }

        .form-control {
            outline: 0;
            position: relative;
            display: inline-block;
            vertical-align: middle;
            text-align: left;
        }

        .select2-search--dropdown:after {
            content: "";
            position: absolute;
            top: 50%;
            left: 1.875rem;
            color: inherit;
            display: block;
            font-size: .8125rem;
            margin-top: -.40625rem;
            line-height: 1;
            opacity: .6;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .modal-backdrop {
            position: relative;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 999999;
            background-color: #000;
        }

        .modal-backdrop.show {
            opacity: 0;
        }

        .imgdet {
            height: 53%;
            width: 53%;
        }


        .cell {
            font-size: 12px;
        }


        table {
            border: 1px solid #ccc;
            border-collapse: collapse;
            margin: 0;
            padding: 0;
            width: 100%;
            table-layout: fixed;
        }

        table caption {
            font-size: 1.5em;
            margin: .5em 0 .75em;
        }

        table tr {
            background-color: #f8f8f8;
            border: 1px solid #ddd;
            padding: .35em;
        }

        table th,
        table td {
            padding: .625em;
            text-align: center;
        }

        table th {
            font-size: .85em;

            text-transform: uppercase;
        }


        @media screen and (max-width: 600px) {
            table {
                border: 0;
            }

            table caption {
                font-size: 1.3em;
            }

            table thead {
                border: none;
                clip: rect(0 0 0 0);
                height: 1px;
                margin: -1px;
                overflow: hidden;
                padding: 0;
                position: absolute;
                width: 1px;
            }

            table tr {
                border-bottom: 3px solid #ddd;
                display: block;
                margin-bottom: .625em;
            }

            table td {
                border-bottom: 1px solid #ddd;
                display: block;
                /* font-size: .8em; */
                text-align: right;
            }

            table td::before {
                /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
                content: attr(data-label);
                float: left;
                font-weight: bold;
                text-transform: uppercase;
            }

            table td:last-child {
                border-bottom: 0;
            }
        }

        .filter {
            backdrop-filter: blur(5px);
        }

        @import "https://fonts.googleapis.com/css?family=Montserrat";

        body {
            font-family: 'Montserrat', sans-serif
        }

        form {
            margin: 40px 0 0
        }

        input[type=submit] {
            margin: 15px 0 0 20px;
            padding: 8px;
            border: 1px solid #5E337D;
            cursor: pointer;
            font-family: 'Montserrat', sans-serif
        }

        .chart-h {
            width: 440px;
            display: inline-block;
            max-width: calc(100vw - 40px)
        }

        .chart {
            margin: 40px 20px 0;
            min-height: 230px;
            border-bottom: 2px solid grey;
            -webkit-display: flex;
            -webkit-align-items: flex-end;
            display: flex;
            align-items: flex-end;
            justify-content: space-around;
            overflow: hidden
        }

        .bar {
            width: calc(25% - 20px);
            height: 2px;
            transition: all 1s;
            color: rgba(255, 255, 255, 0.8);
            padding-top: 10px;
            font-size: 13px
        }

        .graph {
            width: 200px;
            height: 200px;
            position: relative;
            overflow: hidden;
            border-radius: 100%;
            background: #ba55d3;
            -webkit-transform: rotate(-90deg);
            margin: 40px 0 -10px 20px;
            display: inline-block;
            vertical-align: bottom
        }

        .graph:after {
            position: absolute;
            content: '';
            background: #d2d2d2;
            width: 100px;
            height: 100px;
            border-radius: 100%;
            top: 50px;
            left: 50px
        }

        .pie {
            width: 200px;
            height: 200px;
            position: absolute;
            clip: rect(100px, 200px, 200px, 0px);
            transition: all 1s
        }

        .responsive {

            width: 100%;
            height: auto;
        }

        body .owl-prev {
            left: 0;
            display: flex;
        }

        body .owl-next {
            right: 0;
            display: flex;
        }

        body .owl-prev i,
        body .owl-next i {
            margin: auto;
        }

        #owl_about_main_slider div h2 {
            text-align: center;
        }

        .owl-carousel.off {
            display: block;
        }

        .menu-container {
            width: 65%;
            display: flex;
            justify-content: end;
            align-items: end;
        }

        .active-navbar {
            color: #FECD1F !important;
            border-bottom: 3px solid #FECD1F;
        }

        .menu-container span,
        .menu-container .dropdown {
            margin-right: 20px;
            font-family: Poppins;
            font-style: normal;
            font-weight: 600;
            font-size: 20px;
            line-height: 30px;
            color: #FFFFFF;

        }

        .menu-container .dropdown button {
            background-color: transparent;
            border: none;
            box-shadow: none;
        }

        .logo-container {
            display: flex;
            /* justify-content: center; */
            align-items: center;
        }

        .logo {
            width: 74px;
            height: 75px;
        }

        .logo-title {
            width: 200px;
            word-wrap: break-word;
            font-family: Poppins;
            font-style: normal;
            font-weight: 600;
            font-size: 20px;
            line-height: 30px;
            text-align: center;
            color: #FFFFFF;
        }

        .logo-container-footer {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            align-content: center;
        }

        .logo-footer {
            width: 50px;
            height: 50px;
        }

        .logo-title-footer {
            width: 200px;
            word-wrap: break-word;
            font-family: Poppins;
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 22px;
            text-align: center;
            color: #FECD1F;
        }

        .site-navbar {
            background-color: #1970C8;
            opacity: 0.92;
            padding: 31px 0px 16px 128px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer-section p {
            font-family: Poppins;
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 23px;
            color: #FFFFFF;
        }

        .footer-social i {
            font-size: 30px;
        }

        .copyright {
            font-family: Poppins;
            font-style: normal;
            font-weight: normal;
            font-size: 24px;
            line-height: 36px;
            /* identical to box heigZht */
            color: #FFFFFF;
        }
    </style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    

<![endif]-->
</head>

<body class="">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">SIMANIS</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <!-- Header section  -->
    <header class="header-section clearfix">

        <div class="site-navbar">
            <!-- Logo -->
            <!-- <a href="/" class="site-logo">
                <img src="{{ asset('img/logo1.png') }}" alt="">
            </a> -->
            <div class="logo-container">
                <img class=" logo" src="{{ asset('images/logo1.png') }}" alt="">
                <div class="logo-title">
                    <span>Dinas Perindustrian Provinsi NTB</span>
                </div>
                <img class="logo" src="{{ asset('images/logo2.png') }}" alt="">
            </div>

            <div class="menu-container">
                <span class="active-navbar">Home</span>
                <span><a style="text-decoration: none;color:white;" href="#">Produk</a></span>
                <span> <a style="text-decoration: none;color:white;" href="{{ url('https://disperin.ntbprov.go.id/') }}">Berita</a></span>
                @if (Auth::check())
                @if (Auth::user()->isAdmin == 1)
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Admin
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{ url('admin/tabel') }}">Dashboard</a></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
                @endif
                @if (Auth::user()->isAdmin == 0)
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->nik }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{ url('/member/dashboard') }}">Dashboard</a></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
                @endif
                @endif
            </div>



            <div class="header-right">
                {{-- <div class="header-info-box">
					<div class="hib-icon">
						<img src="{{ asset('tmplate3/img/icons/phone.png') }}" alt="" class="">
            </div>
            <div class="hib-text">
                <h6 style="line-height: normal">(0370) 647625</h6>
                <p style="line-height: normal">+62 877-2893-7983</p>
                <p style="line-height: normal">industrintb@gmail.com</p>

                <a href="https://api.whatsapp.com/send?phone=6287728937983" target="_blank"> Hubungi
                    Kami Di Whatsapp</a>
            </div>
        </div>
        <div class="header-info-box">
            <div class="hib-icon">
                <img src="img/icons/map-marker.png" alt="" class="">
            </div>
            <div class="hib-text">
                <h6 style="line-height: normal">Jl. Majapahit No.17, Kekalik Jaya</h6>
                <p style="line-height: normal"> Kec. Sekarbela, Kota Mataram</p>
                <p style="line-height: normal"> Nusa Tenggara Barat. 83115</p>

                <a href="https://www.google.co.id/maps/place/Kantor+Perindustrian/@-8.591923,116.0942243,852m/data=!3m2!1e3!4b1!4m5!3m4!1s0x2dcdbf7c73d9d6fd:0xbe73e61705537491!8m2!3d-8.5919792!4d116.0963912?hl=id" target="_blank">Lihat Lokasi</a>
            </div>
        </div> --}}

        <!-- <button class="search-switch"><i class="fa fa-search"></i></button> -->
        </div>
        <!-- Menu -->


        </div>
    </header>
    <!-- Header section end  -->

    @yield('content')




    <!-- Footer section -->
    <footer class="footer-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget about-widget">
                        <h2 class="fw-title">Alamat</h2>
                        <p>Jl. Majapahit No.17, Kekalik Jaya, Kec. Sekarbela, Kota Mataram, Nusa Tenggara Barat 83115
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-7">
                    <div class="footer-widget">
                        <h2 class="fw-title">Kontak</h2>
                        <div class="footer-info-box">
                        </div>
                        <div class="footer-info-box">
                            <!-- <div class="fib-icon">
                                <img src="{{ asset('tmplate3/img/icons/phone.png') }}" alt="" class="">
                            </div> -->
                            <div class="fib-text">
                                <p>Telepon : (0370) 647625<br>Fax : (0370) 640800<br><a href="https://api.whatsapp.com/send?phone=6287728937983" target="_blank">
                                        Hubungi
                                        Kami Di Whatsapp</a></p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer-widget">
                        <h2 class="fw-title">Email</h2>
                        <p>industrintb@gmail.com</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget about-widget">
                        <h2 class="fw-title">Sosial Media</h2>

                        <div class="footer-social">
                            <a href="https://www.facebook.com/disperinntb"><i class="fa fa-facebook-square"></i></a>
                            <a href="https://twitter.com/disperinntb1"><i class="fa fa-twitter"></i></a>
                            <a href="https://www.youtube.com/channel/UCSAkbosyXAEZf4nMvv777_g"><i class="fa fa-youtube-play"></i></a>
                            <a href="https://www.instagram.com/dinas_perindustrianntb/?hl=en"><i class="fa fa-instagram"></i></a>
                        </div>
                        <div class="logo-container-footer">
                            <img class="logo-footer" src="{{ asset('images/logo1.png') }}" alt="">
                            <div class="logo-title-footer">
                                <span>Dinas Perindustrian Provinsi NTB</span>
                            </div>
                            <img class="logo-footer" src="{{ asset('images/logo2.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-buttom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 order-2 order-lg-1 p-0">
                        <div class="copyright">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright Simanis <script>
                                document.write(new Date().getFullYear());
                            </script>
                        </div>
                    </div>
                    <!-- <div class="col-lg-7 order-1 order-lg-2 p-0">
					<ul class="footer-menu">
						<li class="active"><a href="index.html">Home</a></li>
						<li><a href="about.html">About us</a></li>
						<li><a href="solutions.html">Solutions</a></li>
						<li><a href="blog.html">Blog</a></li>
						<li><a href="contact.html">Contact</a></li>
					</ul>
				</div> -->
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer section end -->



    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ asset('template2/jquery.min.js') }}"></script>
    <!-- Bootstrap popper Core JavaScript -->
    <script src="{{ asset('template2/popper.min.js') }}"></script>
    <!-- <script src="{{ asset('template/js/bootstrap.min.js') }}"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- This is for the animation -->
    <script src="{{ asset('template2/aos.js') }}"></script>
    <script src="{{ asset('template2/perfect-scrollbar.jquery.min.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('template2/custom.js') }}"></script>
    <script src="{{ asset('template2/prism.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"> </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"> </script>

    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!-- angularJS -->

    <script src="{{ asset('select2/js/select2.min.js') }}" type="text/javascript"></script>

    <!-- Template 3 -->
    <!--====== Javascripts & Jquery ======-->
    <script src="{{ asset('tmplate3/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('tmplate3/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('tmplate3/js/jquery.slicknav.min.js') }}"></script>
    <script src="{{ asset('tmplate3/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('tmplate3/js/circle-progress.min.js') }}"></script>
    <script src="{{ asset('tmplate3/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('tmplate3/js/main.js') }}"></script>
    <!-- Template 3 -->


    <!-- Core plugin JavaScript-->

    <script src="{{ asset('template_admin/vendor/jquery-easing/jquery.easing.min.js') }}">
    </script>
    <!-- Custom scripts for all pages-->


    <script src="{{ asset('select2/js/select2.min.js') }}" type="text/javascript"></script>
    <!-- angularJS -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.7/angular.min.js"></script>
    <script src="{{ asset('angularjs/app.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    <script src="{{ asset('angularjs/controllers.js') }}" type="text/javascript"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2();

            $(".select2-dynamic").select2({
                tags: true
            });
        });
    </script>

    <script>
        function g() {
            var colors = ["#5E337D", "purple", "violet", "mediumorchid"];
            $.getJSON(
                "https://spreadsheets.google.com/feeds/worksheets/1V8aWFQTxo4r2CkiKOqOrtd2r4xjxDS-C_MPzgnDeRjI/public/basic?alt=json",
                function(data) {
                    for (var i = 0; i < 4; i++) {
                        document.getElementsByClassName("bar")[i].style.height =
                            (data.feed.entry[i].gsx$number.$t /
                                data.feed.entry[4].gsx$number.$t) *
                            500 +
                            "px";
                        document.getElementsByClassName("bar")[i].innerHTML =
                            data.feed.entry[i].gsx$option.$t +
                            "<br/><small>" +
                            Math.floor(
                                (100 * data.feed.entry[i].gsx$number.$t) /
                                data.feed.entry[4].gsx$number.$t
                            ) +
                            "%</small>";
                        document.getElementsByClassName("bar")[i].style.background = colors[i];
                        document.getElementsByClassName("pie")[i].style.background =
                            "linear-gradient(0deg, transparent 50%, transparent 50%),linear-gradient(" +
                            Math.floor(
                                (360 * data.feed.entry[i].gsx$number.$t) /
                                data.feed.entry[4].gsx$number.$t
                            ) +
                            "deg, transparent 50%, " +
                            colors[i] +
                            " 50%)";
                        if (i != 0) {
                            document.getElementsByClassName("pie")[i].style.webkitTransform =
                                "rotate(" +
                                Math.floor(
                                    (360 * data.feed.entry[i - 1].gsx$number.$t) /
                                    data.feed.entry[4].gsx$number.$t
                                ) +
                                "deg) " +
                                document.getElementsByClassName("pie")[i - 1].style.webkitTransform;
                        }
                    }
                }
            );
        }
        g();
    </script>
    <script>
        $(document).ready(function() {
            if ($(window).width() < 854) {
                startCarousel();
            } else {
                $('.owl-carousel').addClass('off');
            }
        });


        function startCarousel() {
            $("#owl_about_main_slider").owlCarousel({
                navigation: false, // Show next and prev buttons
                autoplay: false,
                itemsDesktop: false,
                itemsDesktopSmall: false,
                itemsTablet: false,
                itemsMobile: false,
                loop: false,
                nav: false,
                responsiveClass: true,
                autoplayTimeout: 3000,
                autoplayHoverPause: false,

            });
        }
    </script>

    @yield('scripts')
</body>

</html>