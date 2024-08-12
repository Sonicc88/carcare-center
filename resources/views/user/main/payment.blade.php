@extends('user.navbar')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

@section('content')
<div class="alert p-1 mt-2 ps-3 fs-5"style="background-color: #FEFEFE;display: flex; justify-content-center"  >
    <img src="{{ asset('image/logo/back-arrow.png') }}" width="35px" height="35px"  alt="">
    ກໍາລັງລ້າງ
</div>  
<div class="container-xxl rounded-2 pt-1 pb-3 mt-2" style="background-color: #FEFEFE;">
    <div class="alert alert-light p-1">
        <div class="row g-2">
            <a href="{{route('payment.wait1')}}" class="col-sm-12 col-md-4 col-lg-3 col-xl-2 btn btn-warning fs-5 btn-sm me-2">ລໍຄິວລ້າງ
                <span class="badge bg-danger h5 pt-1 pb-1 pe-2 ps-2"  >{{$countw}}</span>
            </a>
            <a href="{{route('payment.cleaned1')}}" class="col-sm-12 col-md-4 col-lg-3 col-xl-2 btn btn-primary fs-5 btn-sm me-2">ລ້າງສໍາເລັດ
                <span class="badge h5 bg-success pt-1 pb-1 pe-2 ps-2" >{{$counted}}</span>
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
            @foreach($order as $row)
                <tr class="align-middle fs-6">
                    <td><?= $i++ ?></td>
                    <td>{{$row->service_name}}</td>
                    <td class="text-danger">{{$row->car_brand}} / {{$row->car_model}}</td>
                    <td>{{$row->car_plate}}</td>
                    <td>{{$row->total}}</td>
                    <td>{{$row->emp_name}}</td>
                    <td>
                        <button type="button" class="btn btn-outline-success fs-6 mb-1 me-1" data-bs-toggle="modal" data-bs-target="#modalEditData{{$row->order_id}}">ຊໍາລະເງິນ</button>
                        <form action="{{route('payment.reciep1')}}" method="post">
                            @csrf
                            <div class="modal fade" id="modalEditData{{$row->order_id}}" tabindex="-1" aria-labelledby="modalEditDataLabel" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-primary fs-4" id="modalEditDataLabel">ຊໍາລະເງິນ</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="d-flex justify-content-between">
                                                <div class="d-flex flex-column">
                                                    <span class="fs-5 fw-bold">ລາຄາລວມ</span>
                                                    <h2 class="text-warning">{{number_format($row->total,0)." ກີບ "}}</h2>
                                                    <span class="fs-5 fw-bold">ລ້າງວັນທີ : {{date('d-m-Y', strtotime($row->created_at))}}</span>
                                                </div>
                                                <img src="{{ asset('image/logo/invoice.png') }}" width="100px" height="100px"  alt="">
                                            </div>
                                            <hr>
                                            <div class="d-flex justify-content-between">
                                                <div class="d-flex flex-column">
                                                    <span class="fs-5 fw-bold">ຍີ່ຫໍ້ລົດ  :  <span class="text-danger">{{$row->car_brand}}</span></span>
                                                    <span class="fs-5 fw-bold">ລູ້ນລົດ  :  <span class="text-danger">{{$row->car_model}}</span></span>
                                                    <span class="fs-5 fw-bold">ທະບຽນລົດ  : <span class="text-danger">{{$row->car_plate}}</span> </span>
                                                    <span class="fs-5 fw-bold">ລາຍການບໍລິການ  : <span class="text-danger">{{$row->service_name}}</span> </span>
                                                    <!-- <label for="typepayment" class="form-label fs-5 fw-bold">ເລືອກຊໍາລະ:</label>
                                                    <select class="form-select fs-5 fw-bold" name="typepayment" id="typepayment">
                                                        <option value="ເງິນສົດ">ເງິນສົດ</option>
                                                        <option value="ເງິນໂອນ">ເງິນໂອນ</option>
                                                    </select> -->
                                                </div>
                                            </div>
                                            <hr>
                                            <input type="text" name="reciep" id="reciep" class="form-control fs-2 fw-bold text-warning text-center bg-black" placeholder="0.0" autofocus value="{{$row->total}}">
                                            <input type="text" name="total" id="total" class="form-control " value="{{$row->total}}" hidden>
                                            <input type="text" name="re" id="re" class="form-control" value="{{$row->total}}" hidden>

                                            <!-- <h2 id="total"hidden>{{$row->total}}</h2> -->
                                            <input type="text" name="thrn" id="thrn" class="form-control " hidden>
                                            <input type="text" name="id" value="{{$row->order_id}}" hidden>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-outline-primary" onclick="edValueKeyup()" >ຮັບເງິນ</button>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@include('sweetalert::alert')
<script>
    function edValueKeyup() {
    var edValue = document.getElementById("re");
    var s = edValue.value;
    var total = document.getElementById("total");
    var t = total.value;
    
    var lblValue = document.getElementById("thrn");
    
    lblValue.value= s-t;
}
</script>
<script>
     $('#reciep').on('keyup',function(){
            $value=$(this).val();
            let sum = document.getElementById('re');
            sum.value= $value
        })
</script>
@stop
