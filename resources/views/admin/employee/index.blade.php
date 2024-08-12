@extends('admin.navbar')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
@section('content')
<div class="alert p-1 mt-2 mb-2 ps-3 fs-5"style="background-color: #FEFEFE; display: flex;align-items: center;"  >
    <img src="{{ asset('image/logo/back-arrow.png') }}" width="35px" height="35px"  alt="">
    ຈັດການຂໍ້ມູນພະນັກງານ ແລະ ຜູ້ໃຊ້
    <button class="btn btn-primary position-absolute end-0 " data-bs-toggle="modal" data-bs-target="#modalInsertData">ເພີ່ມຜູ້ໃຊ້</button>
    <form action="{{route('employee.add')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="modalInsertData" tabindex="-1" aria-labelledby="modalInsertDataLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg ">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                    <h5 class="modal-title text-light fs-5" id="modalInsertDataLabel">ເພີ່ມຂໍ້ມູນຜູ້ໃຊ້</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card mb-2">
                            <div class="card-header"style="background-color: #2C9CDB;color: #fff;">
                                <b>ຂໍ້ມູນທົ່ວໄປ / Employee information</b>
                            </div>
                            <div class="card-body">
                                <div class="row g-2">
                                    <div class="form-group col-6">
                                        <label for="emp_name" class="form-label">ຊື່ພະນັກງານ</label>
                                        <input type="text" name="emp_name" class="form-control @error('emp_name') is-invalid @enderror" placeholder="FirtsName.." value="{{ old('emp_name')}}">
                                        @error('emp_name')
                                            <span class="text-danger my-1">{{$message}}</span>
                                        @endError
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="emp_surname" class="form-label">ນາມສະກູນ</label>
                                        <input type="text" name="emp_surname" class="form-control @error('emp_surname') is-invalid @enderror" placeholder="LastName.." value="{{ old('emp_surname')}}">
                                        @error('emp_surname')
                                            <span class="text-danger my-1">{{$message}}</span>
                                        @endError
                                    </div>
                                    <div class="form-group col-5">
                                        <label for="contract" class="form-label">ເບີໂທຕິດຕໍ່</label>
                                        <input type="tel" name="contract" class="form-control @error('contract') is-invalid @enderror" placeholder="Contract.."value="{{ old('contract')}}">
                                        @error('contract')
                                            <span class="text-danger my-1">{{$message}}</span>
                                        @endError
                                    </div>
                                    <div class="form-group col-auto">
                                        <label for="gender" class="form-label">ເພດ</label>
                                        <select class="form-select @error('gender') is-invalid @enderror" name="gender" id="gender">
                                            <option selected>--ເລືອກ--</option>
                                            <option value="ຊາຍ"{{ old('gender') == 'ຊາຍ' ? 'selected' : '' }}>ຊາຍ</option>
                                            <option value="ຍິງ"{{ old('gender') == 'ຍິງ' ? 'selected' : '' }}>ຍິງ</option>
                                        </select>
                                        @error('gender')
                                            <span class="text-danger my-1">{{$message}}</span>
                                        @endError
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="email" class="form-label">ອີເມວ</label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email.." value="{{ old('email')}}">
                                        @error('email')
                                            <span class="text-danger my-1">{{$message}}</span>
                                        @endError
                                    </div>
                                    <div class="form-group col-7">
                                        <label for="address" class="form-label">ທີ່ຢູ່</label>
                                        <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" cols="30" rows="10" style="height: 100px;">{{{ old('address')}}}</textarea >
                                        @error('address')
                                            <span class="text-danger my-1">{{$message}}</span>
                                        @endError</div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header"style="background-color: #2C9CDB;color: #fff;">
                                <b>ຂໍ້ມູນຜູ້ໃຊ້ / User information</b>
                            </div>
                            <div class="card-body">
                                <div class="row g-2">
                                    <div class="form-group col-auto">
                                        <label for="is_admin" class="form-label">ສະຖານະ</label>
                                        <select class="form-select @error('is_admin') is-invalid @enderror" name="is_admin" id="is_admin">
                                            <option selected disabled>--ເລືອກ--</option>
                                            <option value="1"{{ old('is_admin') == 1 ? 'selected' : '' }}>Admin</option>
                                            <option value="0"{{ old('is_admin') == 0 ? 'selected' : '' }}>User</option>
                                        </select>
                                        @error('is_admin')
                                            <span class="text-danger my-1">{{$message}}</span>
                                        @endError
                                    </div>
                                    <div class="form-group col-5">
                                        <label for="username" class="form-label">ຊື່ຜູ້ໃຊ້</label>
                                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Username.." value="{{ old('username')}}">
                                        @error('username')
                                            <span class="text-danger my-1">{{$message}}</span>
                                        @endError
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="userpass" class="form-label">ລະຫັດຜ່ານ</label>
                                        <input type="text" name="userpass" class="form-control @error('userpass') is-invalid @enderror" placeholder="password.." value="{{ old('userpass')}}">
                                        @error('userpass')
                                            <span class="text-danger my-1">{{$message}}</span>
                                        @endError
                                    </div>
                                </div>
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
<div class="container-xxl rounded-2 p-2" style="background-color: #FEFEFE;">

    
    <table class="table table-sm table-hover table-light fs-5 " id="myTable">
        <thead class="table-primary">
            <tr class="text_center">
                <th>ລะຫັດພະນັກງານ</th>
                <th>ຊື່ ແລະ ນາມສະກູນ</th>
                <th>ທີ່ຢູ່</th>
                <th>ເບີໂທຕິດຕໍ່</th>
                <th>ເພດ</th>
                <th>ຊື່ຜູ້ໃຊ້</th>
                <th>ສະຖານະ</th>
                <th>ຈັດການ</th>
            </tr>
        </thead>
        <tbody>
            @foreach($emp as $key => $row)
                <tr class="align-middle">
                    <td>E000{{$row->id}}</td>
                    <td>{{$row->emp_name}} {{$row->emp_surname}}</td>
                    <td>{{$row->address}}</td>
                    <td>{{chunk_split($row->contract, 3, ' ')}}</td>
                    <td>{{$row->gender}}</td>
                    <td>{{$row->username}}</td>
                    <td>
                        @if($row->is_admin==1)
                        <strong class="text-success"> 
                            ຜູ້ດູແລລະບົບ
                        </strong>
                        @elseif($row->is_admin==0)
                        <strong class="text-warning">
                            ຜູ້ໃຊ້ລະບົບ
                        </strong>
                        @else
                        <strong class="text-danger">
                            ພະນັກງານລ້າງລົດ
                        </strong>
                        @endif
                    </td>
                    <td>
                        <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditData{{$row->id}}">ແກ້ໄຂ</button>
                            <div class="modal fade" id="modalEditData{{$row->id}}" tabindex="-1" aria-labelledby="modalEditDataLabel" aria-hidden="true">
                                <div class="modal-dialog  modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary">
                                        <h5 class="modal-title text-light fs-5" id="modalEditDataLabel">ແກ້ໄຂຂໍ້ມູນລາຍການ</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{route('employee.edit')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$row->id}}">
                                            <div class="modal-body">
                                                <div class="card mb-2">
                                                    <div class="card-header"style="background-color: #2C9CDB;color: #fff;">
                                                        <b>ຂໍ້ມູນທົ່ວໄປ / Employee information</b>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row g-2">
                                                            <div class="form-group col-6">
                                                                <label for="emp_name" class="form-label">ຊື່ພະນັກງານ</label>
                                                                <input type="text" name="emp_name" class="form-control @error('emp_name') is-invalid @enderror" placeholder="FirtsName.." value="{{ $row->emp_name}}">
                                                                @error('emp_name')
                                                                    <span class="text-danger my-1">{{$message}}</span>
                                                                @endError
                                                            </div>
                                                            <div class="form-group col-6">
                                                                <label for="emp_surname" class="form-label">ນາມສະກູນ</label>
                                                                <input type="text" name="emp_surname" class="form-control @error('emp_surname') is-invalid @enderror" placeholder="LastName.." value="{{ $row->emp_surname}}">
                                                                @error('emp_surname')
                                                                    <span class="text-danger my-1">{{$message}}</span>
                                                                @endError
                                                            </div>
                                                            <div class="form-group col-5">
                                                                <label for="contract" class="form-label">ເບີໂທຕິດຕໍ່</label>
                                                                <input type="tel" name="contract" class="form-control @error('contract') is-invalid @enderror" placeholder="Contract.."value="{{ $row->contract}}">
                                                                @error('contract')
                                                                    <span class="text-danger my-1">{{$message}}</span>
                                                                @endError
                                                            </div>
                                                            <div class="form-group col-auto">
                                                                <label for="gender" class="form-label">ເພດ</label>
                                                                <select class="form-select @error('gender') is-invalid @enderror" name="gender" id="gender">
                                                                    <option selected disabled>--ເລືອກ--</option>
                                                                    <option value="ຊາຍ"{{ old('gender',$row->gender) == 'ຊາຍ' ? 'selected' : '' }}>ຊາຍ</option>
                                                                    <option value="ຍິງ"{{ old('gender',$row->gender) == 'ຍິງ' ? 'selected' : '' }}>ຍິງ</option>
                                                                </select>
                                                                @error('gender')
                                                                    <span class="text-danger my-1">{{$message}}</span>
                                                                @endError
                                                            </div>
                                                            <div class="form-group col-auto">
                                                                <label for="email" class="form-label">ອີເມວ</label>
                                                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email.." value="{{ $row->email}}">
                                                                @error('email')
                                                                    <span class="text-danger my-1">{{$message}}</span>
                                                                @endError
                                                            </div>
                                                            <div class="form-group col-7">
                                                                <label for="address" class="form-label">ທີ່ຢູ່</label>
                                                                <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" cols="30" rows="10" style="height: 100px;">{{{ $row->address}}}</textarea >
                                                                @error('address')
                                                                    <span class="text-danger my-1">{{$message}}</span>
                                                                @endError</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" name="save" class="btn btn-success">ອັບເດດ</button>
                                            </div> 
                                        </form> 
                                    </div>
                                </div>
                            </div>
                        <button type="button" class="btn btn-outline-warning btn-sm " data-bs-toggle="modal" data-bs-target="#modalEditPass{{$row->id}}">ປ່ຽນລະຫັດ</button>
                        <div class="modal fade" id="modalEditPass{{$row->id}}" tabindex="-1" aria-labelledby="modalEditDataLabel" aria-hidden="true">
                            <div class="modal-dialog modal-sm modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-warning">
                                    <h5 class="modal-title text-light fs-5" id="modalEditDataLabel">ລະຫັດຜ່ານໃໝ່</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{route('employee.editpass')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$row->id}}">
                                        <div class="modal-body bg-dark mb-2">
                                            <div class="row">
                                                <div class="col-12">
                                                    <input type="text" name="userpass" class="form-control @error('userpass') is-invalid @enderror" placeholder="ລະຫັດຜ່ານໃໝ່.." autofocus >
                                                    @error('userpass')
                                                        <span class="text-danger my-1">{{$message}}</span>
                                                    @endError
                                                </div>
                                            </div>
                                        </div>  
                                        <div class="modal-footer p-0 text-center">
                                            <button type="submit" name="update" value="put" class="btn btn-success">ບັນທຶກ</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@include('sweetalert::alert')
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
        });
    });
</script>
<!-- <script>
    function phoneMask() { 
    var num = $(this).val().replace(/\D/g,''); 
    $(this).val(num.substring(0,3) + ' ' + num.substring(3,6) + ' ' + num.substring(6,9) + ' ' + num.substring(9,11)); 
    }
    $('[type="tel"]').keypress(phoneMask);
    
</script> -->
@stop