@extends('admin.navbar')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css"rel="stylesheet"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

@section('content')
<div class="alert p-1 mt-2 ps-3 fs-5"style="background-color: #FEFEFE;display: flex; justify-content-center"  >
    <img src="{{ asset('image/logo/back-arrow.png') }}" width="35px" height="35px"  alt="">
    ລາຍງານ
</div> 
<div class="container-fluid rounded-2 pt-2" style="background-color: #FEFEFE;">
        <div class="container">
            <p>ເລືອກວັນທີ</p>
            <div class="row">
                <div class="container d-flex border-bottom">
                    <div class="col-sm-6" style="height:60px;">
                        <div class='col-md-12'>
                            <div class="form-group">
                                <div class='input-group date' id='startDate'>
                                    <!-- <label for="startDate" class="input-group-addon input-group-text">ວັນ/ເດືອນ/ປີ</label>
                                    <input id="startDate" class="form-control" type="text" /> -->
                                        <div class="input-group">
                                            <label for="startDate" class="input-group-addon input-group-text">ວັນ/ເດືອນ/ປີ</label>
                                            <input type="text" class="form-control" name="dt_start" id="dt_start" data-date-format="dd-mm-yyyy" >
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6" style="height:60px;">
                        <form action="{{route('PDF_generator')}}" method="get">
                                <input type="text" class="form-control" name="dt_start" id="dt_s" data-date-format="dd-mm-yyyy" hidden >
                                <button type="submit" class="btn btn-success float-end">ສ້າງລາຍງານ PDF</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="container bg-light" style="width: 86%;">
                <p class="h5 text-center">ລາຍງານ ຕິດຕາມເງິນ</p>
                <p class="text-center text-danger" id="fordate">ປະຈໍາ .../...</p>
                <table class="table table-sm table-bordered  border-dark ">
                    <thead>
                        <tr class="text-center">
                            <th style="width: 60px;">ລ/ດ</th>
                            <th style="width:120px ;">ວັນເດືອນປີ</th>
                            <th>ເນື້ອໃນ</th>
                            <th>ຍີ້ຫໍ້/ລູ້ນ</th>
                            <th>ທະບຽນ</th>
                            <th>ຈໍານວນ</th>
                        </tr>
                    </thead>
                    <tbody id="table">
                        <?php
                        $i=1;
                        ?>
                        @foreach($order as $row)
                            <tr class="align-middle text-center">
                                <td><?= $i++ ?></td>
                                <td>{{\Carbon\Carbon::parse($row->created_at)->format('d/m/Y')}}</td>
                                <td class="text-start">{{$row->service_name}}</td>
                                <td class="text-danger text-start">{{$row->car_brand}} / {{$row->car_model}}</td>
                                <td>{{$row->car_plate}}</td>
                                <td>{{number_format($row->total,0)}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
</div>

<script>
        $('#dt_start').on('change',function(){
            $value=$(this).val();
            $.ajax({
                method :'get',
                url:"{{URL::to('/admin/report_search')}}",
                data:{'dt_start':$value},
                success:function(data){
                    // console.log(data);
                    $('#table').html(data.table_data)
                }
            });
        })
</script>
<script>
     $('#dt_start').on('change',function(){
            $value=$(this).val();
            let date = document.getElementById('dt_s');
            let date1 = document.getElementById('start');
            date.value= $value
            date1.value= $value
        })
</script>
<script type="text/javascript">
      $("#dt_start").datepicker({
        format: "dd/mm/yyyy",
      });
    </script>

@stop