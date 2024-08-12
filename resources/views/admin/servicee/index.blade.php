@extends('admin.navbar')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@section('content')
    <div class="alert p-1 mt-2 mb-2 ps-3 fs-5"style="background-color: #FEFEFE; display: flex; justify-content-center"  >
        <img src="{{ asset('image/logo/back-arrow.png') }}" width="35px" height="35px"  alt="">
        ຈັດການຂໍ້ມູນບໍລິການ
    </div>  
        <div class="container-xxl rounded-2 p-0" >
            <div class="row">
                <div class="col-xl-8 mb-2">
                    <div class="container-fluid rounded-2 pt-2" style="background-color: #FEFEFE;">
                        <table class="table table-sm table-hover table-light fs-5" id="myTable">
                            <thead class="table-primary">
                                <tr class="text_center">
                                    <th>ລໍາດັບ</th>
                                    <th>ລາຍການບໍລິການ</th>
                                    <th>ຮູບພາບ</th>
                                    <th>ລາຄາ</th>
                                    <th>ຈັດການ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $key => $rows)
                                    <tr class="align-middle" style="font-size: 18px;">
                                        <td>S000{{$rows->id}}</td>
                                        <td>{{$rows->service_name}}</td>
                                        <td><img src="{{asset($rows->service_image)}}"  width="60px" height="60px" alt="" style="border-radius: 3px;"></td>
                                        <td>{{number_format($rows->service_price,0)." ກີບ "}}</td>
                                        <td width="120px"> 
                                            <form action="{{route('service.delete')}}" method="post">
                                            @csrf
                                                <button type="button" class="btn btn-outline-primary btn-sm mb-1 me-1" data-bs-toggle="modal" data-bs-target="#modalEditData{{$rows->id}}">ແກ້ໄຂ</button>
                                                <input type="hidden" name="id" value="{{$rows->id}}">
                                                <button type="submit" name="delete" class="btn btn-outline-danger btn-sm mb-1 me-1">ລຶບ</button>
                                            </form>
                                            <div class="modal fade" id="modalEditData{{$rows->id}}" tabindex="-1" aria-labelledby="modalEditDataLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-md">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-primary">
                                                        <h5 class="modal-title text-light fs-5" id="modalEditDataLabel">ແກ້ໄຂຂໍ້ມູນລາຍການ</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                        <form action="{{route('service.edit')}}" method="post" enctype="multipart/form-data">
                                                            <div class="form-group mb-3">
                                                                <div class="row">
                                                                @csrf
                                                                    <input type="text" name="id" value="{{$rows->id}}" hidden>
                                                                    <div class="col-sm-8 col-md-8">
                                                                        <label for="text_name" class="col-sm-8 col-form-label ">Service/ຊື່ລາຍການ</label>
                                                                        <input type="text" name="service_name" class="form-control mr-5 "  placeholder="ກະລູນາປ້ອນຊື່ລາຍການ" value="{{$rows->service_name}}"  required>
                                                                    </div>
                                                                    <div class="col-sm-4 col-md-4">
                                                                        <label for="text_price" class="col-sm-8 col-form-label ">Price/ລາຄາ</label>
                                                                        <input type="text" name="service_price" class="form-control mr-5 "  placeholder="ກະລູນາປ້ອນລາຄາ" value="{{$rows->service_price}}"  required>
                                                                    </div>
                                                                    <div class="col-sm-8 col-md-8">
                                                                        <label for="text_file" class="col-sm-8 col-form-label ">Picture/ຮູບພາບ</label>
                                                                        <input type="file" name="service_image" class="form-control mr-5 " accept= "image/jpg , image/jpeg, image/png " require onchange="loadFile_img1(event)" style="width: 100%;">
                                                                    </div>
                                                                    <div class="col-sm-4 col-md-4 mt-2">
                                                                        <img class="img-thumbnail" id="roundedup" src="{{asset($rows->service_image)}}" width="100%" height="150px" alt="image" style="object-fit: cover;">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" name="update" value="put" class="btn btn-success">ບັນທຶກ</button>
                                                            </div>
                                                        </form>
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
                </div>
                <div class="col-xl-4">
                    <form action="{{route('service.add')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-header" style="background-color: #2C9CDB;color: #fff;"><b>ຂໍ້ມູນລາຍການ / Service information</b></div>
                            <div class="card-body p-1">
                                <div class="form-group col-sm-12 col-md-12">
                                    <label for="text_name" class="col-sm-12 col-form-label">Service/ຊື່ລາຍການ</label>
                                    <input type="text" name="service_name" class="form-control mr-5 @error('service_name') is-invalid @enderror"  placeholder="ກະລູນາປ້ອນຊື່ລາຍການ*"value="{{ old('service_name')}}" autofocus>
                                    @error('service_name')
                                        <span class="text-danger my-1">{{$message}}</span>
                                    @endError
                                </div>
                                <div class="form-group col-sm-12 col-md-12">
                                    <label for="text_price" class="col-sm-12 col-form-label">Price/ລາຄາ</label>
                                    <input type="text" name="service_price" class="form-control mr-5 @error('service_price') is-invalid @enderror"  placeholder="ກະລູນາປ້ອນລາຄາ*"value="{{ old('service_price')}}">
                                    @error('service_price')
                                            <span class="text-danger my-1">{{$message}}</span>
                                    @endError
                                </div>
                            </div>
                        </div>
                        <div class="card my-2">
                            <div class="card-header" style="background-color: #2C9CDB;color: #fff"><b>ຂໍ້ມູນຮູບພາບ / Image information</b></div>
                            <div class="card-body p-1">
                                <div class="form-group">
                                    <div class="col-sm-8 col-md-8">
                                        <img class="img-thumbnail" id="rounded" src="{{asset('image/logo/image.png')}}" width="145px" height="145px" alt="image" style="object-fit: cover; margin-top: 5px;">
                                    </div>
                                    <div class="col-sm-12 col-md-12">
                                        <input type="file" name="service_image" id="image" class="form-control mr-5 fs-5 @error('service_image') is-invalid @enderror" accept= "image/jpg , image/jpeg, image/png " onchange="loadFile_img(event)" style="width: 100%;" hidden >
                                        <label class="lb_choosefile btn btn-warning mt-2" for="image">ເລືອກຮູບ</label>
                                        @error('service_image')
                                            <span class="text-danger my-1">{{$message}}</span>
                                        @endError
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="footer mt-2">
                            <button type="submit" name="save" class="btn btn-success float-end text-white">ບັນທຶກ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @if(Session::has('success'))
        <script>
            const Success = Swal.mixin({
            toast: true,
            position: 'top-right',
            iconColor: 'white',
            customClass: {
                popup: 'colored-toast',
            },
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
            })
            ;(async () => {
            await Success.fire({
                icon: 'success',
                title: 'ແຈ້ງເຕືອນ'+" "+"{{Session::get('success')}}",
            })
            })();
        </script>
        @elseif(Session::has('error'))
        <script>
            const Error = Swal.mixin({
            toast: true,
            position: 'top-right',
            iconColor: 'white',
            customClass: {
                popup: 'colored-toast',
            },
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
            })
            ;(async () => {
            await Error.fire({
                icon: 'error',
                title: 'ແຈ້ງເຕືອນ',
                text: "{{Session::get('error')}}",
                width:300,
            })
            })();
        </script>
        @endif
        <script>
            var service_image = document.getElementById('rounded');
            var loadFile_img = function(event) {
                service_image.src = URL.createObjectURL(event.target.files[0]);
            };
            var service_imageup = document.getElementById('roundedup');
            var loadFile_img1 = function(event) {
                service_imageup.src = URL.createObjectURL(event.target.files[0]);
            };
        </script>
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
                        lengthMenu: [4, 8, 16]
            });
        });
    </script>
@stop