<!--
=========================================================
* Material Dashboard 2 - v3.0.0
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2021 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- @vite('resources/css/app.css') -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('admin_template/assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('admin_template/assets/img/favicon.png') }}">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital@0;1&display=swap" rel="stylesheet" />
  <title>
    SIMANIS NTB
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('admin_template/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('admin_template/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('admin_template/assets/css/material-dashboard.css?v=3.0.0') }}" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-white">
  <div class="flex h-full p-3">
    <aside class="flex flex-col bg-white p-3 rounded-xl items-start text-left">
      <div class="flex justify-center items-center">
        <img class="h-[48px] mr-2" src="{{ asset('/images/Logo_Simanis.png') }}" alt="logo">
        <span>SIMANIS.</span>
      </div>
      <a href="{{ url('/perdagangan/dashboard') }}" class="flex justify-center items-center cursor-pointer mt-3 mb-3 {{$pages=='dashboard'?'bg-blue-200':''}} p-2 rounded-md">
        <img class="mr-5" src="{{ asset('/images/dashbord.png') }}" alt="logo">
        <span>Dashboard</span>
      </a>
      <a href="{{ url('/perdagangan/daftarToko') }}" class="flex justify-center items-center cursor-pointer mt-3 mb-3 {{$pages=='daftarToko'?'bg-blue-200':''}} p-2 rounded-md">
        <img class="mr-5" src="{{ asset('/images/dashbord.png') }}" alt="logo">
        <span>Daftar Toko</span>
      </a>
      <a href="{{ url('/perdagangan/produkNTBMall') }}" class="flex justify-center items-center cursor-pointer mt-3 mb-3 p-1">
        <img class="mr-5" src="{{ asset('/images/kartu.png') }}" alt="logo">
        <span>Produk NTB Mall</span>
      </a>
      <hr class="w-full" />
      <a href="{{ url('/perdagangan/settingAkun') }}" class="flex justify-center items-center cursor-pointer mt-3 mb-3 p-1">
        <img class="mr-5" src="{{ asset('/Icon-svg/profil.svg') }}" alt="logo">
        <div class="flex flex-col">
          <span class="text-black">Perdagangan</span>
          <span>Akun {{$User->role}}</span>
        </div>
      </a>
    </aside>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
      <!-- Navbar -->
      <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
              <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
              <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Dashboard</h6>
          </nav>
          <div class="flex items-center justify-between" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
              <div class="input-group input-group-outline">
                <!-- <label class="form-label">Type here...</label>
              <input type="text" class="form-control"> -->
              </div>
            </div>
            <ul class="navbar-nav  justify-content-end">
              <!-- <li class="nav-item d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">Sign In</span>
              </a>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li> -->
              <!-- <li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0">
                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
              </a>
            </li> -->
              <li class="nav-item dropdown pe-2 d-flex align-items-center">
                <div style="visibility: collapse;" id="notifDiv" class=" overflow-scroll  h-[300px] w-[300px] bg-white absolute right-[70px] top-[5px] rounded-2xl text-center z-50">
                  <h5 class="m-3">Notifikasi Anda</h5>
                  @foreach($Notifikasi as $key=>$item)
                  <div class="flex bg-blue-50 p-3">
                    <img src="{{ asset('/Icon-svg/dana.svg') }}">
                    <div class="ml-3 text-left">
                      <p class="font-bold text-black">Pembiayaan Usaha</p>
                      <p class="text-gray-700 leading-5">{{$item->deskripsi}}</p>
                    </div>
                  </div>
                  @endforeach

                  <form action="/notifikasi/status/ADMIN/{{$pages}}" method="post">
                    @csrf
                    <input type="text" value="11111111" name="nik" style="display:none">

                    <button class="p-4 text-center w-full text-blue-700 text-sm cursor-pointer">Tandai Semua Telah Dibaca</button>
                  </form>
                </div>
                <div onclick="openCloseNotif()" class="p-2 bg-white mr-2 rounded-xl cursor-pointer">
                  <div class="flex">
                    <img src="{{ asset('/Icon-svg/notif.svg') }}">
                    @if(count($Notifikasi) != 0)
                    <div class="rounded-full p-2 absolute right-[30px] bg-red-600 w-[15px] h-[15px] flex items-center justify-center"><span class="text-white text-xs">{{count($Notifikasi)}}</span></div>
                    @endif
                  </div>
                </div>
                <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-user cursor-pointer"></i>
                </a>
                <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                  <!-- <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="./assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New message</span> from Laur
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-clock me-1"></i>
                          13 minutes ago
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="./assets/img/small-logos/logo-spotify.svg" class="avatar avatar-sm bg-gradient-dark  me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New album</span> by Travis Scott
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-clock me-1"></i>
                          1 day
                        </p>
                      </div>
                    </div>
                  </a>
                </li> -->
                  <li>
                    <form method="POST" action="{{url('logout')}}">
                      @csrf
                      <button class="dropdown-item border-radius-md" href="javascript:;">
                        <div class="d-flex py-1">
                          <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
                            <!-- <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                           -->
                            <i class="fa fa-sign-out cursor-pointer"></i>
                            <title>credit-card</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                              <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                <g transform="translate(1716.000000, 291.000000)">
                                  <g transform="translate(453.000000, 454.000000)">
                                    <path class="color-background" d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z" opacity="0.593633743"></path>
                                    <path class="color-background" d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z"></path>
                                  </g>
                                </g>
                              </g>
                            </g>
                            </svg>
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="text-sm font-weight-normal mb-1">
                              Log Out
                            </h6>
                            <!-- <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-clock me-1"></i>
                          2 days
                        </p> -->
                          </div>
                        </div>
                      </button>
                    </form>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="container">
        @yield('content')
      </div>
      <!--   Core JS Files   -->
      <script src="{{ asset('js/app.js') }}"></script>
      <script src="{{ asset('admin_template/assets/js/core/popper.min.js') }}"></script>
      <script src="{{ asset('admin_template/assets/js/core/bootstrap.min.js') }}"></script>
      <script src="{{ asset('admin_template/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
      <script src="{{ asset('admin_template/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
      <script src="{{ asset('admin_template/assets/js/plugins/chartjs.min.js') }}"></script>
      <script>
        var ctx = document.getElementById("chart-bars").getContext("2d");

        new Chart(ctx, {
          type: "bar",
          data: {
            labels: ["M", "T", "W", "T", "F", "S", "S"],
            datasets: [{
              label: "Sales",
              tension: 0.4,
              borderWidth: 0,
              borderRadius: 4,
              borderSkipped: false,
              backgroundColor: "rgba(255, 255, 255, .8)",
              data: [50, 20, 10, 22, 50, 10, 40],
              maxBarThickness: 6
            }, ],
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              legend: {
                display: false,
              }
            },
            interaction: {
              intersect: false,
              mode: 'index',
            },
            scales: {
              y: {
                grid: {
                  drawBorder: false,
                  display: true,
                  drawOnChartArea: true,
                  drawTicks: false,
                  borderDash: [5, 5],
                  color: 'rgba(255, 255, 255, .2)'
                },
                ticks: {
                  suggestedMin: 0,
                  suggestedMax: 500,
                  beginAtZero: true,
                  padding: 10,
                  font: {
                    size: 14,
                    weight: 300,
                    family: "Roboto",
                    style: 'normal',
                    lineHeight: 2
                  },
                  color: "#fff"
                },
              },
              x: {
                grid: {
                  drawBorder: false,
                  display: true,
                  drawOnChartArea: true,
                  drawTicks: false,
                  borderDash: [5, 5],
                  color: 'rgba(255, 255, 255, .2)'
                },
                ticks: {
                  display: true,
                  color: '#f8f9fa',
                  padding: 10,
                  font: {
                    size: 14,
                    weight: 300,
                    family: "Roboto",
                    style: 'normal',
                    lineHeight: 2
                  },
                }
              },
            },
          },
        });


        var ctx2 = document.getElementById("chart-line").getContext("2d");

        new Chart(ctx2, {
          type: "line",
          data: {
            labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
              label: "Mobile apps",
              tension: 0,
              borderWidth: 0,
              pointRadius: 5,
              pointBackgroundColor: "rgba(255, 255, 255, .8)",
              pointBorderColor: "transparent",
              borderColor: "rgba(255, 255, 255, .8)",
              borderColor: "rgba(255, 255, 255, .8)",
              borderWidth: 4,
              backgroundColor: "transparent",
              fill: true,
              data: [50, 40, 300, 320, 500, 350, 200, 230, 500],
              maxBarThickness: 6

            }],
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              legend: {
                display: false,
              }
            },
            interaction: {
              intersect: false,
              mode: 'index',
            },
            scales: {
              y: {
                grid: {
                  drawBorder: false,
                  display: true,
                  drawOnChartArea: true,
                  drawTicks: false,
                  borderDash: [5, 5],
                  color: 'rgba(255, 255, 255, .2)'
                },
                ticks: {
                  display: true,
                  color: '#f8f9fa',
                  padding: 10,
                  font: {
                    size: 14,
                    weight: 300,
                    family: "Roboto",
                    style: 'normal',
                    lineHeight: 2
                  },
                }
              },
              x: {
                grid: {
                  drawBorder: false,
                  display: false,
                  drawOnChartArea: false,
                  drawTicks: false,
                  borderDash: [5, 5]
                },
                ticks: {
                  display: true,
                  color: '#f8f9fa',
                  padding: 10,
                  font: {
                    size: 14,
                    weight: 300,
                    family: "Roboto",
                    style: 'normal',
                    lineHeight: 2
                  },
                }
              },
            },
          },
        });

        var ctx3 = document.getElementById("chart-line-tasks").getContext("2d");

        new Chart(ctx3, {
          type: "line",
          data: {
            labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
              label: "Mobile apps",
              tension: 0,
              borderWidth: 0,
              pointRadius: 5,
              pointBackgroundColor: "rgba(255, 255, 255, .8)",
              pointBorderColor: "transparent",
              borderColor: "rgba(255, 255, 255, .8)",
              borderWidth: 4,
              backgroundColor: "transparent",
              fill: true,
              data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
              maxBarThickness: 6

            }],
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              legend: {
                display: false,
              }
            },
            interaction: {
              intersect: false,
              mode: 'index',
            },
            scales: {
              y: {
                grid: {
                  drawBorder: false,
                  display: true,
                  drawOnChartArea: true,
                  drawTicks: false,
                  borderDash: [5, 5],
                  color: 'rgba(255, 255, 255, .2)'
                },
                ticks: {
                  display: true,
                  padding: 10,
                  color: '#f8f9fa',
                  font: {
                    size: 14,
                    weight: 300,
                    family: "Roboto",
                    style: 'normal',
                    lineHeight: 2
                  },
                }
              },
              x: {
                grid: {
                  drawBorder: false,
                  display: false,
                  drawOnChartArea: false,
                  drawTicks: false,
                  borderDash: [5, 5]
                },
                ticks: {
                  display: true,
                  color: '#f8f9fa',
                  padding: 10,
                  font: {
                    size: 14,
                    weight: 300,
                    family: "Roboto",
                    style: 'normal',
                    lineHeight: 2
                  },
                }
              },
            },
          },
        });
      </script>
      <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
          var options = {
            damping: '0.5'
          }
          Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
      </script>
      <!-- Github buttons -->
      <script async defer src="https://buttons.github.io/buttons.js"></script>
      <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
      <script src="./assets/js/material-dashboard.min.js?v=3.0.0"></script>
      <script>
        let notif_is_open = false;

        function validateForm() {
          let x = document.forms["importForm"]["file"].value;
          if (x == "") {
            alert("Pilih file yang ingin di import");
            return false;
          }
        }

        function confirm_delete() {
          return confirm('Hapus Semua Data ?');
        }

        function confirm_delete_1() {
          return confirm('Hapus Data ?');
        }
        const openCloseNotif = () => {
          let visibility;
          if (notif_is_open) {
            visibility = "collapse";
            notif_is_open = !notif_is_open;
          } else {
            visibility = "visible";
            notif_is_open = !notif_is_open;
          }
          const notifDiv = document.getElementById('notifDiv');
          notifDiv.style.visibility = visibility;

        }
      </script>


  </div>

</body>

</html>