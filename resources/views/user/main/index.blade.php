@extends('user.navbar')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@section('content')
    <div class="alert alert-light mt-2 mb-2 pt-1 pb-1">
        <div class="row g-2">
            <a href="{{route('payment.wait1')}}" class="col-sm-12 col-md-4 col-lg-3 col-xl-2 btn btn-warning btn-sm fs-5 me-2">ລໍຄິວລ້າງ
                
                <span class="badge h5 bg-danger">{{$countw}}</span>
            </a>
            <a href="{{route('payment1')}}" class="col-sm-12 col-md-4 col-lg-3 col-xl-2 btn btn-info fs-5 btn-sm me-2">ກໍາລັງລ້າງ
                <span class="badge h5 bg-warning">{{$countp}}</span>
            </a>
            <a href="{{route('payment.cleaned1')}}" class="col-sm-12 col-md-4 col-lg-3 col-xl-2 btn btn-primary fs-5 btn-sm me-2">ລ້າງສໍາເລັດ
                <span class="badge h5 bg-success">{{$counted}}</span>
            </a>
        </div>
    </div>
    <div class="container-xxl rounded-2" style="background-color: #FEFEFE;">
        <div class="row ">
            <div class="col-xxl-8 col-xl-8 overflow-auto " style="max-height: 84vh;">
                <div class="row ">
                @foreach($user_data as $key => $rows)
                    <div class="col-sm-6 col-md-4 col-lg-3 col-sm-2 mt-3 mb-3 ">
                        <div class="card d-flex flex-column h-100 overflow-hidden" style="box-shadow: 2px 2px 3px 1px rgba(0, 0, 0, 0.6); ">
                            <div class="card-header p-0">
                                <img class="card-img-top" src="{{asset($rows->service_image)}}"  alt="" width="100%" height="100%">
                            </div>
                            <div class="card-body text-center fw-bold d-flex flex-column pt-2 pb-2">
                                <h5 class="card-title fw-bold">{{$rows->service_name}}</h5>
                                <p class="card-text fw-bold text-info">{{number_format($rows->service_price,0)." ກີບ "}}</p>
                            </div>
                            <!-- <form action="/admin/index/addTocart" method="post" enctype="multipart/form-data"> -->
                                <!-- @csrf -->
                                <div class="card-footer d-flex justify-content-center align-items-center p-0">
                                    <input type="hidden" name="id" value="{{$rows->id}}">
                                    <button class="btn btn-primary fs-6 fw-bold add-to-cart" name="add" style="width:100%; border-radius: 0;"data-product-id="{{$rows->id}}" >ເລືອກ</button>
                                </div>
                            <!-- </form> -->
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
            <div class="col-xxl-4 col-xl-4 pe-0 ps-0">
                <table class="table table-light table-sm mt-3 mb-1">
                    <thead class="table-primary fs-5">
                        <tr class="text-center">
                            <th>ລໍາດັບ</th>
                            <th class="text-start">ລາຍການ</th>
                            <th>ລາຄາ</th>
                            <th>ຈັດການ</th>
                        </tr>
                    </thead>
                    <tbody class="table-blue ">
                    <?php
                    $i=1;
                    ?>
                    @if(Session::has('cart'))
                        @foreach(Session::get('cart') as $id=>$item)
                        <tr class="align-middle text-center fs-5">
                            <td><?= $i++?></td>
                            <td class="text-start">{{$item['service_name']}}</td>
                            <td>{{$item['service_price']}}</td>
                            <td>
                                <form action="{{route('user.remove')}}" method="post">
                                @csrf
                                    <input type="hidden" name="id" value="{{$item['id']}}">
                                    <button class="btn btn-sm btn-danger p-0" name="delete" >
                                        <img src="{{asset('image/logo/Close.png')}}" alt="" width="20px">
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                <button type="button" class="btn btn-primary btn-sm fw-bold mb-1 me-1 float-end" data-bs-toggle="modal" data-bs-target="#modalOrder">ຮັບລົດ</button>
                <form action="{{route('user.store')}}" method="post">
                    @csrf
                    <div class="modal fade" id="modalOrder" tabindex="-1" aria-labelledby="modalOrderLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-light fs-4" id="modalOrderLabel">ລາຍລະອຽດລົດ/ລູກຄ້າ</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group mb-3">
                                            <div class="row">
                                                <div class="col-sm-4 col-md-4">
                                                    <label for="car_brand" class="col-sm-8 col-form-label fs-5">ຍີ່ຫໍ້ລົດ</label>
                                                    <input type="text" name="car_brand" class="form-control mr-5 fs-5"  placeholder="ກະລູນາປ້ອນຍີ່ຫໍ້ລົດ*" required>
                                                </div>
                                                <div class="col-sm-4 col-md-4">
                                                    <label for="car_model" class="col-sm-8 col-form-label fs-5">ລູ້ນລົດ</label>
                                                    <input type="text" name="car_model" class="form-control mr-5 fs-5"  placeholder="ກະລູນາປ້ອນລູ້ນລົດ*" required>
                                                </div>
                                                <div class="col-sm-4 col-md-4">
                                                    <label for="car_plate" class="col-sm-8 col-form-label fs-5">ປ້າຍທະບຽນ</label>
                                                    <input type="text" name="car_plate" class="form-control mr-5 fs-5"  placeholder="ກະລູນາປ້ອນປ້າຍທະບຽນ*" required>
                                                </div>
                                                <table class="table table-light table-sm mt-3 mb-1">
                                                    <thead class="table-primary fs-5">
                                                        <tr class="text-center">
                                                            <th>ລໍາດັບ</th>
                                                            <th class="text-start">ລາຍການ</th>
                                                            <th>ລາຄາ</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $i=1;
                                                    ?>
                                                    @if(Session::has('cart'))
                                                        @foreach(Session::get('cart') as $id=>$item)
                                                        <tr class="align-middle text-center fs-5">
                                                            <td><?= $i++?></td>
                                                            <td class="text-start">{{$item['service_name']}}</td>
                                                            <td>{{$item['service_price']}}</td>
                                                        </tr>
                                                        @endforeach
                                                    @endif
                                                    </tbody>
                                                </table>
                                                
                                            </div>
                                        </div>
                                    </div>  
                                    <div class="modal-footer">
                                        <button type="submit" name="save" class="btn btn-success">ບັນທຶກ</button>
                                    </div>
                                </div>
                            </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
    <script type="text/javascript">
        $(".add-to-cart").click(function (e) {
        e.preventDefault();

        var productId = $(this).data("product-id");

        $.ajax({
            url: "{{ route('user.addTocart') }}",
            method: "POST",
            data: {
                _token: '{{ csrf_token() }}', 
                id:productId
            },
            success: function (response) {
                window.location.reload();
                console.log(response);
            },
            error: function (xhr, status, error) {
                // Handle errors (e.g., display an error message)
                console.error(xhr.responseText);
            }
        });
    });
</script>
@stop