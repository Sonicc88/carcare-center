<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Adminpage</title>
  </head>
  <body>
    <div id="navbar">
        <div class="slide">
            <div class="logo">
                <img src="{{ asset('image/logo/logo_car.png') }}" alt="" style="width: 20%;">
                <span style="color: black; font-size: 19px; margin-left: 5px;">Carcare Center</span>
            </div>
            <hr>
            <ul>
                <li>
                  <a href="{{route('order')}}">
                      <img src="{{ asset('image/logo/home.png') }}" width="35px" height="35px"  alt="">
                      ໜ້າຫຼັກ
                  </a>
                </li>
                <li>
                    <a href="{{route('payment')}}">
                        <img src="{{ asset('image/logo/secure-payment.png') }}" width="35px" height="35px"  alt="">
                        ຊໍາລະເງິນ
                    </a>
                </li>
                <li class="drop">
                    <a href="#" id="dropdown">
                      <img src="{{ asset('image/logo/data-management.png') }}" width="35px" height="35px"  alt="">
                      ຈັດການຂໍ້ມູນ
                      <i class="fa-solid fa-angle-down float-end" id="icon" style="position: relative; padding: 7px 5px;"></i>
                    </a>
                        <div class="sub-menu" id="mysub">
                            <a href="{{route('service')}}">
                                <img src="{{ asset('image/logo/book.png') }}" width="25px" height="25px"  alt="">
                                ຈັດການຂໍ້ມູນບໍລິການ
                            </a>
                            <hr style="margin: 1px 0;">
                            <a href="{{route('employee')}}">
                                <img src="{{ asset('image/logo/setting.png') }}" width="25px" height="25px"  alt="">
                                ຈັດການຂໍ້ມູນຜູ້ໃຊ້ລະບົບ
                            </a>
                        </div>
                </li>
                <hr style="margin: 0;">
                <li class="dropdown">
                    <a href="##" id="dropdown1">
                      <img src="{{ asset('image/logo/report.png') }}" width="35px" height="35px"  alt="">
                      ລາຍງານ
                      <i class="fa-solid fa-angle-down float-end" id="icon" style="position: relative; padding: 7px 5px;"></i>
                    </a>
                    <div class="sub-menu1" id="mysubre">
                        <a href="{{route('report_service')}}">
                            <img src="{{ asset('image/logo/book.png') }}" width="25px" height="25px"  alt="">
                            ລາຍງານລ້າງລົດ
                        </a>
                        <hr style="margin: 1px 0;">
                        <!-- <a href="#">
                            <img src="{{ asset('image/logo/setting.png') }}" width="25px" height="25px"  alt="">
                            ລາຍງານລູກຄ້າ
                        </a> -->
                    </div>
                       
                </li>
            </ul>
        </div>
    </div>
    <div id="body">
        <div class="top_bar">
            <div id="menu_bar">
                <img src="{{ asset('image/logo/menu.png') }}" alt="" style="width: 45px; height: 45px;">
            </div>
            <div id="logout">
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                        <strong class="fs-5 text-white">{{auth()->user()->username}}</strong>
                    </a>
                    <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser2" style="width: 200px; padding: 0;">
                        <!-- <li><hr class="dropdown-divider"></li> -->
                        <li>
                            <a class="dropdown-item p-1 btn text-center" id="drop" href="/logout" >
                            <img src="{{ asset('image/logo/out.png') }}" width="35px" height="35px"  alt="">
                            ອອກຈາກລະບົບ
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
        @yield('content')
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        const toggle = document.getElementById('menu_bar');
        const body = document.getElementById('body');
        const navbar = document.getElementById('navbar');
        toggle.onclick = function() {
            body.classList.toggle('active');
            navbar.classList.toggle('active');
        }
    </script>
    <script>
        const dropdown = document.getElementById('dropdown');
        const menu = document.getElementById('mysub');
        const icon = document.getElementById('icon');
        dropdown.onclick = function() {
            menu.classList.toggle('show');
            icon.classList.toggle('fa-angle-up');
        }
    </script>
    <script>
        const dropdown1 = document.getElementById('dropdown1');
        const menu1 = document.getElementById('mysubre');
        const icon1 = document.getElementById('icon1');
        dropdown1.onclick = function() {
            menu1.classList.toggle('show');
            icon1.classList.toggle('fa-angle-up');
        }
    </script>
    <script>
      var currentLocation1 = location.href;
      var menuItem1 = document.querySelectorAll('a');
      var menuLength1 = menuItem1.length;
      for (let i = 0; i < menuLength1; i++) {
          if (menuItem1[i].href === currentLocation1) {
              menuItem1[i].className = "active";
          };
      };
    </script>
  </body>
</html>