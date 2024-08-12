@extends('user.navbar')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
@section('content')
    <div class="alert p-1 mt-2 ps-3 fs-5"style="background-color: #FEFEFE;display: flex; justify-content-center" >
        <img src="{{ asset('image/logo/back-arrow.png') }}" width="35px" height="35px"  alt="">
            ລ້າງສໍາເລັດ
    </div>
    <div class="container-xxl rounded-2 pt-1 pb-3 mt-2" style="background-color: #FEFEFE;">
        <div class="alert alert-light p-1 ">
            <div class="row g-2">
                <a href="{{route('payment.wait1')}}" class="col-sm-12 col-md-4 col-lg-3 col-xl-2 btn btn-warning fs-5 btn-sm mb-1 me-2">ລໍຄິວລ້າງ
                    <span class="badge bg-danger h5 pt-1 pb-1 pe-2 ps-2">{{$countw}}</span>
                </a>
                <a href="{{route('payment1')}}" class="12 col-md-4 col-lg-3 col-xl-2 btn btn-info fs-5 btn-sm mb-1 me-2">ກໍາລັງລ້າງ
                    <span class="badge bg-warning h5 pt-1 pb-1 pe-2 ps-2">{{$countp}}</span>
                </a>
            </div>
        </div>
        <table class="table table-sm table-hover table-light fs-5" id="myTable">
            <thead class="table-primary">
                <tr class="text_center">
                    <th>ລໍາດັບ</th>
                    <th>ຍີ່ຫໍ້ລົດ/ລູ້ນລົດ</th>
                    <th>ທະບຽນ</th>
                    <th>ວັນເດືອນປີ</th>
                    <th>ຜູ້ບັນທຶກ</th>
                    <th>ຈັດການ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i=1;
                ?>
                @foreach($que as $row)
                    <tr class="align-middle" style="font-size: 17.5px;">
                        <td><?= $i++ ?></td>
                        <td>{{$row->car_brand}} / {{$row->car_model}}</td>
                        <td>{{$row->car_plate}}</td>
                        <td>{{\Carbon\Carbon::parse($row->created_at)->format('d-m-Y')}}</td>
                        <td>{{$row->emp_name}}</td>
                        <td>
                            <button type="button" class="btn btn-outline-primary btn-sm mb-1 me-1" data-bs-toggle="modal" data-bs-target="#modalEditData{{$row->order_id}}">ສະແດງ</button>
                            <div class="modal fade" id="modalEditData{{$row->order_id}}" tabindex="-1" aria-labelledby="modalEditDataLabel" aria-hidden="true">
                                    <div class="modal-dialog  modal-dialog-centered modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                <h5 class="modal-title text-light fs-5" id="modalEditDataLabel">ຂໍ້ມູນການລ້າງ</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h6 class="fw-bold text-primary fs-5 mb-3">Q000{{$row->order_id}}  / ຜູ້ຮັບລົດ   : {{$row->emp_name}}</h6>
                                                <div class="container rounded-2 pt-1 pb-1" style="background-color: #FEFEFE; border-left: 8px solid #26CB8E; border-top: 1px solid #26CB8E;border-bottom: 1px solid #26CB8E">
                                                    <span class="fs-5 fw-bold">ຂໍ້ມູນລົດ</span>
                                                    <hr style="border-top: 2px solid #26CB8E;">
                                                    <div class="d-flex justify-content-around">
                                                        <span class="fw-bold">ຍີ່ຫໍ້ລົດ  :  <span class="text-danger">{{$row->car_brand}}</span></span>
                                                        <span class="fw-bold">ລູ້ນລົດ  :  <span class="text-danger">{{$row->car_model}}</span></span>
                                                        <span class="fw-bold">ທະບຽນລົດ  : <span class="text-danger">{{$row->car_plate}}</span> </span>
                                                    </div>
                                                </div>
                                                <div class="container rounded-2 pt-1 pb-1 mt-4" style="background-color: #FEFEFE; border-left: 8px solid #14CADB; border-top: 1px solid #14CADB;border-bottom: 1px solid #14CADB">
                                                    <span class="fs-5 fw-bold">ປະຫວັດການລ້າງ</span>
                                                    <hr style="border-top: 2px solid #26CB8E;">
                                                    <table class="table table-sm table-light fs-5" id="myTable">
                                                    <thead class="table-primary">
                                                        <tr class="text_center">
                                                            <th>#</th>
                                                            <th>ລາຍການບໍລິການ</th>
                                                            <th>ລາຄາລວມ</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td class="text-danger">{{$row->service_name}}</td>
                                                            <td class="text-danger">{{$row->total}}</td>
                                                        </tr>
                                                    </tbody>
                                                    </table>
                                                </div>
                                            </div>  
                                        </div>
                                    </div>
                                </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready( function(){
            $('#myTable').DataTable({
                language: 
                        {
                            "decimal":        "",
                            "emptyTable":     "ບໍ່ມີຂໍ້ມູນ",
                            "info":           "ສະແດງ _START_ - _END_ ຈາກ _TOTAL_ ລາຍການ",
                            "infoEmpty":      "ສະແດງ 0 - 0 ຈາກ 0 ລາຍການ",
                            "infoFiltered":   "(ຄົ້ນຫາຈາກທັງໝົດ _MAX_ ລາຍການ)",
                            "infoPostFix":    "",
                            "thousands":      ",",
                            "lengthMenu":     "ສະແດງ _MENU_ ລາຍການ",
                            "loadingRecords": "Loading...",
                            "processing":     "",
                            "search":         "ຄົ້ນຫາ:",
                            "zeroRecords":    "ບໍ່ມີຂໍ້ມູນທີ່ຕົງກັນ",
                            "paginate": {
                                "first":      "ໜ້າທໍາອິດ",
                                "last":       "ໜ້າສູດທ້າຍ",
                                "next":       "ໜ້າຕໍ່ໄປ",
                                "previous":   "ກ່ອນໜ້າ"
                            },
                            "aria": {
                                "sortAscending":  ": activate to sort column ascending",
                                "sortDescending": ": activate to sort column descending"
                            }
                        },
                        lengthMenu: [5, 10, 15]
            });
        });
    </script>
@stop