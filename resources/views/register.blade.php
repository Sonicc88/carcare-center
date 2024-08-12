<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Register</title>
  </head>
  <body>
    <div id="form">
        <div class="card_header">
            <h3>ລົງທະບຽນສະມາຊິກ</h3>
        </div>
        <div class="card_body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong]>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            <form action="{{route('register.Post')}}" method="post">
            @csrf
                <div class="row">
                    <div class="col-sm-12 col-md-12 mt-1">
                        <label for="name" class=" col-sm-12 form-label">ຊື່ຜູ້ໃຊ້</label>
                        <input type="text" name="name" class="form-control mr-5" placeholder="ຊື່ຜູ້ໃຊ້" require>
                    </div>
                    @error('name')
                            <span class="text-danger my-1">{{$message}}</span>
                    @endError
                    <div class="col-sm-12 col-md-12 mt-1">
                        <label for="email" class=" col-sm-12 form-label">ອີເມວ</label>
                        <input type="text" name="email" class="form-control mr-5" placeholder="ອີເມວ" require>
                    </div>
                    @error('email')
                            <span class="text-danger my-1">{{$message}}</span>
                    @endError
                    <div class="col-sm-12 col-md-12 mt-1">
                        <label for="password" class=" col-sm-12 form-label">ລະຫັດຜ່ານ</label>
                        <input type="password" name="password" class="form-control mr-5" placeholder="ລະຫັດຜ່ານ" require>
                    </div>
                    @error('password')
                            <span class="text-danger my-1">{{$message}}</span>
                    @endError
                </div>
                <button type="submit" class="btn btn-success mt-2">ລົງທະບຽນ</button>

                <a href="{{route('login')}}" class="text-center mt-2">ເຂົ້າສູ່ລະບົບ</a>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    @include('sweetalert::alert')
  </body>
</html>