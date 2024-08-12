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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <title>Userpage</title>
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
                  <a href="{{route('user')}}">
                      <img src="{{ asset('image/logo/home.png') }}" width="35px" height="35px"  alt="">
                      ໜ້າຫຼັກ
                  </a>
                </li>
                <li>
                    <a href="{{route('payment1')}}">
                        <img src="{{ asset('image/logo/secure-payment.png') }}" width="35px" height="35px"  alt="">
                        ຊໍາລະເງິນ
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div id="body">
        <div class="top_bar">
            <div id="menu_bar" class="d-flex">
                <img src="{{ asset('image/logo/menu.png') }}" alt="" style="width: 50px; height: 50px;">
            </div>
            
            <div id="logout">
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                        <strong class="fs-5">{{auth()->user()->username}}</strong>
                    </a>
                    <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser2" style="width: 200px; padding: 0;">
                        <!-- <li><hr class="dropdown-divider"></li> -->
                        <li>
                            <a class="dropdown-item p-2 btn text-center" id="drop" href="/logout" >
                            <span class="fs-5">ອອກຈາກລະບົບ</span>
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