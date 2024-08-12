<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Login</title>
  </head>
  <body>
    <div id="form">
        <div class="card_header">
            <h3>ເຂົ້າສູ່ລະບົບ</h3>
        </div>
        <div class="card_body">
            @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-dismissible fade show hide" id="alert" role="alert">
                    <strong]>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form action="{{route('login.Post')}}" method="post">
                <div class="form-group mb-3">
                    @csrf
                    <div class="row">
                            <div class="col-sm-12 col-md-12 mt-1">
                                <label for="email" class=" col-sm-12 form-label">ຊື່ຜູ້ໃຊ້ ຫຼື ອີເມວ</label>
                                <input type="text" name="email" class="form-control mr-5 @error('email') is-invalid @enderror" placeholder="ອີເມວ" value="{{ old('email')}}" 
                                @error('email')
                                    <?php echo"autofocus"?>
                                @endError require
                                >
                            </div>
                            @error('email')
                                    <span class="text-danger my-1">{{$message}}</span>
                            @endError
                            <div class="col-sm-12 col-md-12 mt-1">
                                <label for="password" class=" col-sm-12 form-label">ລະຫັດຜ່ານ</label>
                                <div class="input-group">
                                    <input type="password" id="password" name="password" class="form-control mr-5 @error('password') error @enderror" placeholder="ປ້ອນລະຫັດຜ່ານ"
                                    @error('password')
                                        @php 
                                            echo"autofocus" 
                                        @endphp
                                    @endError require
                                    style="z-index: 0; border-radius: 6px; padding-right: 30px;">
                                    <i class="fa-solid fa-eye-low-vision" id="togglePassword"></i>
                                </div>
                            </div>
                            @error('password')
                                    <span class="text-danger my-1">{{$message}}</span>
                            @endError
                            <div class="d-flex justify-content-between mt-2">
                                <p>
                                    <input type="checkbox" name="checkbox" id="checkbox" onclick="myFunction()">
                                    ສະແດງລະຫັດຜ່ານ
                                </p>
                            </div>
                    </div>
                </div>
            <button type="submit" class="btn btn-success">ເຂົ້າສູ່ລະບົບ</button>

            <a href="{{route('register')}}" class="text-center mt-2">ລົງທະບຽນສະມາຊິກ</a>
            </form>
        </div>
    </div>
    <script>
        setTimeout(() => {
        const alert = document.getElementById('alert');
        alert.style.display = 'none';
        }, 6000); 
    </script>
    <script>
        function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
        }
    </script>
    <script>
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");

        togglePassword.addEventListener("click", function () {
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            togglePassword.classList.toggle("fa-eye");
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    @include('sweetalert::alert')
  </body>
</html>