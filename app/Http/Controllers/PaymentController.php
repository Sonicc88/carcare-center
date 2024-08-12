<?php

namespace App\Http\Controllers;

use App\Models\order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function show_cleaning(){
        $countw = order::where('order_status',1)->whereDate('orders.created_at', now()->today())->count();
        $counted = order::where('order_status',3)->count();
        $order = DB::table('order_details')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->join('services', 'order_details.service_id', '=', 'services.id')
            ->join('employees', 'order_details.user_id', '=', 'employees.id')
            ->select('order_details.order_id', 'orders.car_brand', 'orders.car_model', 'orders.car_plate', 'employees.emp_name','orders.order_status','orders.created_at', DB::raw("group_concat(' ',services.service_name) as service_name"),DB::raw("SUM(price) as total"))
            ->groupBy('order_details.order_id','orders.car_brand', 'orders.car_model', 'orders.car_plate','employees.emp_name','orders.order_status','orders.created_at')
            ->whereDate('orders.created_at', now()->today())
            ->where('order_status',2)
            ->get();
        return view('admin.main.payment',compact('order','countw','counted'));
    }
    public function show_waitclean(){
        $counting = order::where('order_status',2)->whereDate('orders.created_at', now()->today())->count();
        $counted = order::where('order_status',3)->count();
        $que =  DB::table('order_details')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->join('services', 'order_details.service_id', '=', 'services.id')
            ->join('employees', 'order_details.user_id', '=', 'employees.id')
            ->select('order_details.order_id', 'orders.car_brand', 'orders.car_model', 'orders.car_plate', 'employees.emp_name','orders.order_status', DB::raw("group_concat(' ',services.service_name) as service_name"),DB::raw("SUM(price) as total"))
            ->groupBy('order_details.order_id','orders.car_brand', 'orders.car_model', 'orders.car_plate','employees.emp_name','orders.order_status')
            ->whereDate('orders.created_at', now()->today())
            ->where('order_status',1)
            ->get();
        return view('admin.main.wait',compact('que','counting','counted'));
    }
    public function show_cleaned(){
        $countw = order::where('order_status',1)->whereDate('orders.created_at', now()->today())->count();
        $countp = order::where('order_status',2)->whereDate('orders.created_at', now()->today())->count();
        $que =  DB::table('order_details')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->join('services', 'order_details.service_id', '=', 'services.id')
            ->join('employees', 'order_details.user_id', '=', 'employees.id')
            ->select('order_details.order_id', 'orders.car_brand', 'orders.car_model', 'orders.car_plate', 'employees.emp_name','orders.order_status','orders.created_at', DB::raw("group_concat(' ',services.service_name) as service_name"),DB::raw("SUM(price) as total"))
            ->groupBy('order_details.order_id','orders.car_brand', 'orders.car_model', 'orders.car_plate','employees.emp_name','orders.order_status','orders.created_at')
            ->where('order_status',3)
            ->get();
        return view('admin.main.cleaned',compact('que','countw','countp'));
    }

    public function updating($id){
        $up = order::find($id);
        $up->order_status = 2;
        $up->save();
        toast('ເອີ້ນຄິວສໍາເລັດແລ້ວ','success')->timerProgressBar()->width('300px');
        return redirect()->back();
    }
    public function updated(Request $request){
        $up = order::find($request->id);
        $up->order_status = 3;
        $up->save();
        alert()->info('ເງິນທອນ', '<h1 class="text-danger fw-bold">'.number_format($request->thrn,0)." ກີບ".'</h1>')->toHtml()->timerProgressBar()->width('380px')->autoClose(10000);
        return redirect()->back();

    }


    public function show_cleaning1(){
        $countw = order::where('order_status',1)->whereDate('orders.created_at', now()->today())->count();
        $counted = order::where('order_status',3)->count();
        $order = DB::table('order_details')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->join('services', 'order_details.service_id', '=', 'services.id')
            ->join('employees', 'order_details.user_id', '=', 'employees.id')
            ->select('order_details.order_id', 'orders.car_brand', 'orders.car_model', 'orders.car_plate', 'employees.emp_name','orders.order_status','orders.created_at', DB::raw("group_concat(' ',services.service_name) as service_name"),DB::raw("SUM(price) as total"))
            ->groupBy('order_details.order_id','orders.car_brand', 'orders.car_model', 'orders.car_plate','employees.emp_name','orders.order_status','orders.created_at')
            ->whereDate('orders.created_at', now()->today())
            ->where('order_status',2)
            ->get();
        return view('user.main.payment',compact('order','countw','counted'));
    }
    public function show_waitclean1(){
        $counting = order::where('order_status',2)->whereDate('orders.created_at', now()->today())->count();
        $counted = order::where('order_status',3)->count();
        $que =  DB::table('order_details')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->join('services', 'order_details.service_id', '=', 'services.id')
            ->join('employees', 'order_details.user_id', '=', 'employees.id')
            ->select('order_details.order_id', 'orders.car_brand', 'orders.car_model', 'orders.car_plate', 'employees.emp_name','orders.order_status', DB::raw("group_concat(' ',services.service_name) as service_name"),DB::raw("SUM(price) as total"))
            ->groupBy('order_details.order_id','orders.car_brand', 'orders.car_model', 'orders.car_plate','employees.emp_name','orders.order_status')
            ->whereDate('orders.created_at', now()->today())
            ->where('order_status',1)
            ->get();
        return view('user.main.wait',compact('que','counting','counted'));
    }
    public function show_cleaned1(){
        $countw = order::where('order_status',1)->whereDate('orders.created_at', now()->today())->count();
        $countp = order::where('order_status',2)->whereDate('orders.created_at', now()->today())->count();
        $que =  DB::table('order_details')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->join('services', 'order_details.service_id', '=', 'services.id')
            ->join('employees', 'order_details.user_id', '=', 'employees.id')
            ->select('order_details.order_id', 'orders.car_brand', 'orders.car_model', 'orders.car_plate', 'employees.emp_name','orders.order_status','orders.created_at', DB::raw("group_concat(' ',services.service_name) as service_name"),DB::raw("SUM(price) as total"))
            ->groupBy('order_details.order_id','orders.car_brand', 'orders.car_model', 'orders.car_plate','employees.emp_name','orders.order_status','orders.created_at')
            ->where('order_status',3)
            ->get();
        return view('user.main.cleaned',compact('que','countw','countp'));
    }
}
