<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Document</title>
    
    <style>
         @font-face {
            font-family: 'Phetsarath';
            font-style: normal;
            font-weight: bold;
            src: url("{{ public_path('fonts/Phetsarath-Bold.ttf') }}") format('truetype');
        }
         @font-face {
            font-family: 'Phetsarath';
            font-style: normal;
            font-weight: normal;
            src: url("{{ public_path('fonts/Phetsarath-Regular.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'Saysettha';
            font-style: normal;
            font-weight: bold;
            src: url("{{ public_path('fonts/Saysettha-Bold.ttf') }}") format('truetype');
        }
         @font-face {
            font-family: 'Saysettha';
            font-style: normal;
            font-weight: normal;
            src: url("{{ public_path('fonts/Saysettha-Regular.ttf') }}") format('truetype');
        }
         @font-face {
            font-family: 'times';
            font-style: normal;
            font-weight: bold;
            src: url("{{ public_path('fonts/times new roman bold.ttf') }}") format('truetype');
        }
         @font-face {
            font-family: 'times';
            font-style: normal;
            font-weight: normal;
            src: url("{{ public_path('fonts/times new roman.ttf') }}") format('truetype');
        }
        body {
        font-family: 'Saysettha';
        }
        table {
            border-collapse: collapse;
            width:100%;
        }
        table,
        td,
        th {
            border: 1px solid;
        }

        .text-center {
            text-align: center;
        }

        .text-start {
            text-align: left;
        }

        .text-danger {
            color: red;
        }
        .text-end{
            text-align: right;
        }
        .small{
            line-height: 0.5;
        }
        .small1{
            line-height: 0.2;
        }
    </style>

</head>
<body>
            <div class="container">
                <div class="logo" style="width: 100%; height: fit-content;">
                        <img src="{{ public_path('image/logo/logo_car.png') }}" alt="" width="60px" height="70px">
                    <div class="end" style="float: right; width: 90%;" >
                        <p class="small" style="font-family: times;">Carcare Center</p>
                        <p class="small">ສູນທໍາຄວາມສະອາດລົດ</p>
                    </div>
                </div>
                <p class="small text-center" style="font-weight:700; font-size: 17px;">ລາຍງານ ຕິດຕາມເງິນ</p>
                <p class="small1 text-center">ປະຈໍາເດືອນ
                <p class="small1 text-center text-danger" style="font-family: times;">{{\Carbon\Carbon::parse($startDate)->format('m/Y')}}</p>
                </p>
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>ລ/ດ</th>
                            <th>ວັນເດືອນປີ</th>
                            <th>ເນື້ອໃນ</th>
                            <th>ຍີ້ຫໍ້/ລູ້ນ</th>
                            <th>ທະບຽນ</th>
                            <th>ຈໍານວນ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i=1;
                        ?>
                        @foreach($data as $row)
                            <tr class="text-center" style="font-family: times;">
                                <td><?= $i++ ?></td>
                                <td>{{\Carbon\Carbon::parse($row->created_at)->format('d-m-Y')}}</td>
                                <td class="text-start" style="font-family: Phetsarath;padding-bottom: 4px">{{$row->service_name}}</td>
                                <td class="text-start">{{$row->car_brand}} / {{$row->car_model}}</td>
                                <td style="font-family: Phetsarath;padding-bottom: 4px">{{$row->car_plate}}</td>
                                <td>{{number_format($row->total,0)}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    @foreach($total_all as $rows)
                    <tr>
                        <th colspan='5' class='text-end' style="padding-bottom: 4px;">ຍອດລວມ</th>
                        <th id="sum" style="font-family: times;">{{number_format($rows->total1,0)." LAK"}}</th>
                    @endforeach
                    </tr>
                    </tfoot>
                </table>
                <div class="fend" style="float: right;width: 25%;">
                    <p class="small text-center">ຜູ້ອອກລາຍງານ</p>
                    <p class="small text-center" style="font-family: times;">{{auth()->user()->username}}</p>
                </div>
            </div>
</body>
</html>