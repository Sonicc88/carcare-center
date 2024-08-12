@extends('admin.navbar')

@section('content')
    <div class="alert p-1 mt-2 ps-3 fs-5"style="background-color: #FEFEFE; display: flex; justify-content-center"  >
        <img src="{{ asset('image/logo/back-arrow.png') }}" width="35px" height="35px"  alt="">
        ລໍຄິວລ້າງ
    </div>                          
    <div class="container-xxl rounded-2 pt-1 pb-3 mt-2" style="background-color: #FEFEFE;">
        <div class="alert alert-light p-1">
            <div class="row g-2">
                <a href="{{route('payment')}}" class="col-md-4 col-lg-3 col-xl-2 btn btn-info fs-5 btn-sm mb-1 me-2">ກໍາລັງລ້າງ
                    <span class="badge bg-warning h5 pt-1 pb-1 pe-2 ps-2">{{$counting}}</span>
                </a>
                <a href="{{route('payment.cleaned')}}" class="col-md-4 col-lg-3 col-xl-2 btn btn-primary fs-5 btn-sm mb-1 me-2">ລ້າງສໍາເລັດ
                    <span class="badge bg-success h5 pt-1 pb-1 pe-2 ps-2">{{$counted}}</span>
                </a>
            </div>
        </div>
        <table class="table table-sm table-hover table-light fs-5" id="myTable">
            <thead class="table-primary">
                <tr class="text_center">
                    <th>ລໍາດັບ</th>
                    <th>ລາຍການບໍລິການ</th>
                    <th>ຍີ່ຫໍ້ລົດ/ລູ້ນລົດ</th>
                    <th>ທະບຽນ</th>
                    <th>ລາຄາລວມ</th>
                    <th>ຜູ້ບັນທຶກ</th>
                    <th>ຈັດການ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i=1;
                ?>
                @foreach($que as $row)
                    <tr class="align-middle fs-6">
                        <td>{{$row->order_id}}</td>
                        <td>{{$row->service_name}}</td>
                        <td class="text-danger">{{$row->car_brand}} / {{$row->car_model}}</td>
                        <td>{{$row->car_plate}}</td>
                        <td>{{$row->total}}</td>
                        <td>{{$row->emp_name}}</td>
                        <td>
                            <a href="{{route('payment.call',$row->order_id)}}" class="btn btn-outline-primary">ເອີ້ນຄິວ</a>
                            <a href="#" class="btn btn-outline-danger">ຍົກເລີກ</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @include('sweetalert::alert')

@stop