<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\order_detail;
use App\Models\service;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    function orderShow(){
        $user_data = service::all();
        $countw = order::where('order_status',1)->whereDate('orders.created_at', now()->today())->count();
        $countp = order::where('order_status',2)->whereDate('orders.created_at', now()->today())->count();
        $counted = order::where('order_status',3)->count();
        return view('admin.main.index',compact('user_data','countw','countp','counted'));
    }
    //session
    public function addTocart(Request $request){
        $productId = $request->input('id');
        $productd = service::findOrFail($productId);
        if (!$productd) {
            return response()->json(['error' => 'Prodcut not found'], 404);
        }
        
        $cart = session()->get('cart', []);
  
        if(isset($cart[$request->id])) {
            $cart[$request->id]['quantity']++;
        } else {
            $cart[$request->id] = [
                "id" => $productd->id,
                "service_image" => $productd->service_image,
                "service_name" => $productd->service_name,
                "quantity" => 1,
                "service_price" => $productd->service_price,
            ];
        }
        session()->put('cart', $cart);
        return response()->json(['message' => 'Cart updated'], 200);

    }   
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
        }
        return redirect()->route('order');
    }
    //session
    public function store(Request $request){
        if($request->session()->get('cart')>[]){
            $in = new order();
            $in->car_brand = $request->car_brand;
            $in->car_model = $request->car_model;
            $in->car_plate = $request->car_plate;
            $in->order_status = 1;
            $in->save();
            $order_id = order::max('id');
            $cart = $request->session()->get('cart');
            if($order_id){
                foreach($cart as $row){
                    $ind = new order_detail();
                    $ind->order_id = $order_id;
                    $ind->service_id = $row['id'];
                    $ind->price = $row['service_price'];
                    $ind->user_id = auth()->user()->id;
                    $ind->save();
                    toast('ຮັບລົດສໍາເລັດແລ້ວ','success')->timerProgressBar()->width('300px');
                }
                if (session()->has('cart')){
                    $request->session()->forget('cart');
                }
            }
        }
        else{
            alert()->warning('ແຈ້ງເຕືອນ','ບໍ່ມີຂໍ້ມູນລາຍການ.');
        }
        return redirect()->route('order');
    }
}
