<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;


class ReportController extends Controller
{
     //gneratePDF
     function report_data(){
        $order = DB::table('order_details')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->join('services', 'order_details.service_id', '=', 'services.id')
            ->join('employees', 'order_details.user_id', '=', 'employees.id')
            ->select('order_details.order_id', 'orders.car_brand', 'orders.car_model', 'orders.car_plate', 'employees.emp_name','orders.order_status','orders.created_at', DB::raw("group_concat(' ',services.service_name) as service_name"),DB::raw("SUM(price) as total"))
            ->groupBy('order_details.order_id','orders.car_brand', 'orders.car_model', 'orders.car_plate','employees.emp_name','orders.order_status','orders.created_at')
            ->where('order_status',3)
            ->get();
        return view('admin.reportt.report_all',compact('order'));
        
    }
    function search(Request $request){
        $output='';
        $startDate = Carbon::createFromFormat('d/m/Y',$request->dt_start )->startOfMonth();
        $endDate = $startDate->copy()->endOfMonth();
            if($request->dt_start){
                $data = DB::table('order_details')
                ->join('orders', 'order_details.order_id', '=', 'orders.id')
                ->join('services', 'order_details.service_id', '=', 'services.id')
                ->join('employees', 'order_details.user_id', '=', 'employees.id')
                ->select('order_details.order_id', 'orders.car_brand', 'orders.car_model', 'orders.car_plate', 'employees.emp_name','orders.order_status','orders.created_at', DB::raw("group_concat(' ',services.service_name) as service_name"),DB::raw("SUM(price) as total"))
                ->groupBy('order_details.order_id','orders.car_brand', 'orders.car_model', 'orders.car_plate','employees.emp_name','orders.order_status','orders.created_at')
                ->where('order_status',3)
                ->whereBetween('orders.created_at',[$startDate, $endDate])
                ->get();
            }else{
                $data = DB::table('order_details')
                ->join('orders', 'order_details.order_id', '=', 'orders.id')
                ->join('services', 'order_details.service_id', '=', 'services.id')
                ->join('employees', 'order_details.user_id', '=', 'employees.id')
                ->select('order_details.order_id', 'orders.car_brand', 'orders.car_model', 'orders.car_plate', 'employees.emp_name','orders.order_status','orders.created_at', DB::raw("group_concat(' ',services.service_name) as service_name"),DB::raw("SUM(price) as total"))
                ->groupBy('order_details.order_id','orders.car_brand', 'orders.car_model', 'orders.car_plate','employees.emp_name','orders.order_status','orders.created_at')
                ->where('order_status',3)
                ->get();
            }
            $total_row = $data->count();
            if($total_row>0){
                $i=1;
                foreach($data as $rows){
                    $output.='
                    <tr class="align-middle text-center">
                                <td>'.$i++.'</td>
                                <td>'.\Carbon\Carbon::parse($rows->created_at)->format('d/m/Y').'</td>
                                <td class="text-start">'.$rows->service_name.'</td>
                                <td class="text-danger text-start">'.$rows->car_brand.' / '.$rows->car_model.'</td>
                                <td>'.$rows->car_plate.'</td>
                                <td>'.number_format($rows->total,0).'</td>
                            </tr>
                    </tr>
                    ';
                }
            }
            else{
                $output.='
                    <tr>
                        <td colspan=6 class=text-center> ບໍ່ມີຂໍ້ມູນ</td>
                    </tr>
                ';
            }
            $data = array(
                'table_data' => $output
            );
            return Response($data);
    }
    public function pdf_generator_get(Request $request){
        $startDate = Carbon::createFromFormat('d/m/Y',$request->dt_start )->startOfMonth();
        $endDate = $startDate->copy()->endOfMonth();
            $data = DB::table('order_details')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->join('services', 'order_details.service_id', '=', 'services.id')
            ->join('employees', 'order_details.user_id', '=', 'employees.id')
            ->select('order_details.order_id', 'orders.car_brand', 'orders.car_model', 'orders.car_plate', 'employees.emp_name','orders.order_status','orders.created_at', DB::raw("group_concat(' ',services.service_name) as service_name"),DB::raw("SUM(price) as total"))
            ->groupBy('order_details.order_id','orders.car_brand', 'orders.car_model', 'orders.car_plate','employees.emp_name','orders.order_status','orders.created_at')
            ->where('order_status',3)
            ->whereBetween('orders.created_at',[$startDate, $endDate])
            ->get();
        $total_all = DB::table('order_details')
        ->join('orders', 'order_details.order_id', '=', 'orders.id')
        ->select(DB::raw("SUM(order_details.price) as total1"))
        ->where('order_status',3)
        ->whereBetween('orders.created_at',[$startDate, $endDate])
        ->get();
        $pdf = PDF::loadView('admin.reportt.myPDF',compact('data','total_all','startDate'))
        ->setOption([
            'font_dir' => public_path('/fonts'),
            'font_cache' => public_path('/fonts'),
        ])
        ->setPaper('a4','portrait');
        return $pdf->download('document.pdf');
    }
}
