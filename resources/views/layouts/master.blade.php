<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('template/img/favicon.png')}}">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    @yield('link')
    <link href="{{asset('template/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('template/css/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('template/css/magnific-popup.css')}}" rel="stylesheet">
    <link href="{{asset('template/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('template/css/themify-icons.css')}}" rel="stylesheet">
    <link href="{{asset('template/css/nice-select.css')}}" rel="stylesheet">
    <link href="{{asset('template/css/flaticon.css')}}" rel="stylesheet">
    <link href="{{asset('template/css/gijgo.css')}}" rel="stylesheet">
    <link href="{{asset('template/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('template/css/slicknav.css')}}" rel="stylesheet">
    <link href="{{asset('template/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('template/css/responsive.css')}}" rel="stylesheet">

    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
    <style>
    .slider_area .single_slider {
    height: 450px;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
    }
    .our_department_area {
    background: #F5FBFF;
    padding-top: 60px;


}

#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
  align: center;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #0181f5;
  color: white;
}
    </style>
</head>

<body>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

    <!-- header-start -->
    <header>
        <div class="header-area ">
            <div class="header-top_area">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-md-6 ">
                            <div class="social_media_links">
                                <a href="#">
                                    <i class="fa fa-linkedin"></i>
                                </a>
                                <a href="#">
                                    <i class="fa fa-facebook"></i>
                                </a>
                                <a href="#">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6">
                            <div class="short_contact_list">
                                <ul>
                                    <li><a href="#"> <i class="fa fa-envelope"></i>industrintb@gmail.com</a></li>
                                    <li><a href="#"> <i class="fa fa-phone"></i>(0370) 647625</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="sticky-header" class="main-header-area">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-3 col-lg-2">
                            <div class="logo">
                                <a href="/">
                                    <img src="template/img/logo1.png" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-7">
                            <div class="main-menu  d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <li><a class="active" href="{{ url('/') }}">Beranda</a></li>
                                        <li><a href="{{ url('/#kat_prod') }}" class="section-scroll" >Katalog Produk</a></li>

                                        <li><a href="{{ url('/#about') }}" class="section-scroll">Tentang Kami</a></li>
                                        <li><a href="{{ url('/#about') }}" class="section-scroll">FAQ</a></li>


                                    </ul>

                                </nav>

                            </div>
                        </div>

                        <!-- <div class="button-group-area mt-40">
                            <div class="Appointment">
                                <div class="book_btn d-none d-lg-block">
                                    <a class="popup" style="margin:5px;" href="{{route('login')}}" >Masuk</a>
                                </div>
                                <div class="book_btn d-none d-lg-block">
                                    <a class="popup-with-form" style="margin:5px;"  href="{{route('register')}}">Daftar</a>
                                </div>
                            </div>
                         </div> -->



                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->

@yield('content')
 <!-- End Of content -->

<!-- footer start -->
    <footer class="footer">
            <div class="footer_top">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-md-6 col-lg-4">
                            <div class="footer_widget">
                                <div class="footer_logo">
                                    <a href="#">
                                        <img src="template/img/logo1.png" alt="">
                                    </a>
                                </div>
                                <p>
                                        Firmament morning sixth subdue darkness
                                        creeping gathered divide.
                                </p>
                                <div class="socail_links">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <i class="ti-facebook"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="ti-twitter-alt"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-instagram"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                        <div class="col-xl-2 offset-xl-1 col-md-6 col-lg-3">
                            <div class="footer_widget">
                                <h3 class="footer_title">
                                        Departments
                                </h3>
                                <ul>
                                    <li><a href="#">Eye Care</a></li>
                                    <li><a href="#">Skin Care</a></li>
                                    <li><a href="#">Pathology</a></li>
                                    <li><a href="#">Medicine</a></li>
                                    <li><a href="#">Dental</a></li>
                                </ul>

                            </div>
                        </div>
                        <div class="col-xl-2 col-md-6 col-lg-2">
                            <div class="footer_widget">
                                <h3 class="footer_title">
                                        Useful Links
                                </h3>
                                <ul>
                                    <li><a href="#">About</a></li>
                                    <li><a href="#">Blog</a></li>
                                    <li><a href="#">About</a></li>
                                    <li><a href="#"> Contact</a></li>
                                    <li><a href="#"> Appointment</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-lg-3">
                            <div class="footer_widget">
                                <h3 class="footer_title">
                                        Address
                                </h3>
                                <p>
                                    200, D-block, Green lane USA <br>
                                    +10 367 467 8934 <br>
                                    docmed@contact.com
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copy-right_text">
                <div class="container">
                    <div class="footer_border"></div>
                    <div class="row">
                        <div class="col-xl-12">
                            <p class="copy_right text-center">
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
<!-- footer end  -->

    <!-- JS here -->

    <script src="{{asset('template/js/vendor/modernizr-3.5.0.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('template/js/vendor/jquery-1.12.4.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('template/js/popper.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('template/js/bootstrap.js')}}" type="text/javascript"></script>
    <script src="{{asset('template/js/owl.carousel.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('template/js/isotope.pkgd.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('template/js/ajax-form.js')}}" type="text/javascript"></script>
    <script src="{{asset('template/js/waypoints.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('template/jsjquery.counterup.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('template/js/imagesloaded.pkgd.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('template/js/scrollIt.js')}}" type="text/javascript"></script>
    <script src="{{asset('template/js/jquery.scrollUp.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('template/js/wow.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('template/js/nice-select.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('template/js/jquery.slicknav.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('template/js/jquery.magnific-popup.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('template/js/plugins.js')}}" type="text/javascript"></script>
    <script src="{{asset('template/js/gijgo.min.js')}}" type="text/javascript"></script>
    <!--contact js-->
    <script src="{{asset('template/js/contact.js')}}" type="text/javascript"></script>
    <script src="{{asset('template/js/jquery.ajaxchimp.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('template/js/jquery.form.js')}}" type="text/javascript"></script>
    <script src="{{asset('template/js/jquery.validate.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('template/js/mail-script.js')}}" type="text/javascript"></script>
    <script src="{{asset('template/js/main.js')}}" type="text/javascript"></script>
    <script>
        $('#datepicker').datepicker({
            iconsLibrary: 'fontawesome',
            icons: {
                rightIcon: '<span class="fa fa-caret-down"></span>'
            }
        });
        $('#datepicker2').datepicker({
            iconsLibrary: 'fontawesome',
            icons: {
                rightIcon: '<span class="fa fa-caret-down"></span>'
            }

        });
    $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});


    </script>

@yield('script')

</body>

</html>
