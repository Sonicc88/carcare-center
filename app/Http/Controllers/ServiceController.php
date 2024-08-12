<?php

namespace App\Http\Controllers;

use App\Models\service;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ServiceController extends Controller
{
     //admin
     function serviceShow(){
        $data = service::all();
        return view('admin.servicee.index',compact('data'));
    }   
    public function addTocart(Request $request){
        $product = service::findOrFail($request->search);
        $cart = session()->get('cart', []);
  
        if(isset($cart[$request->search])) {
            $cart[$request->search]['quantity']++;
        } else {
            $cart[$request->search] = [
                "id" => $product->id,
                "service_name" => $product->service_name,
                "quantity" => 1,
                "service_price" => $product->service_price,
            ];
        }
        session()->put('cart', $cart);
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
        return redirect()->back();

    }

    function search(Request $request){
        $output='';
        $startDate = Carbon::createFromFormat('Y-m-d',$request->dt_start )->startOfMonth();
        $endDate = $startDate->copy()->endOfMonth();
        if($request->dt_start){
            // $data = service::where('id','=',$request->search)->get();
            $data = service::where(function($query) use($startDate,$endDate){
                        $query->whereBetween('created_at',[$startDate, $endDate]);
                    })
                    ->get();
        }else{
            $data = service::all();
        }
        $total_row = $data->count();
        if($total_row>0){
            
            foreach($data as $rows){
                $output.='
                <tr>
                <td>'.$rows->id.'</td>
                <td>'.$rows->service_name.'</td>
                <td>'.\Carbon\Carbon::parse($rows->created_at)->format('d/m/Y').'</td>
                </tr>
                ';
            }
        }
        else{
            $output.='
                <tr>
                    <td> not data</td>
                </tr>
            ';
        }
        $data = array(
            'table_data' => $output
        );
        return Response($data);
    }

    function serviceAdd(Request $request){
        $request->validate(
            [
                'service_name' => 'required|unique:services|max:255',
                'service_price' => 'required|numeric',
                'service_image' => 'required',
            ],
            [
                'service_name.required' => "ກາລຸນາປ້ອນຂໍ້ມູນ",
                'service_name.unique' => "ຊື່ຜູ້ໃຊ້ ນີ້ມີຂໍ້ມູນຢູ່ແລ້ວ",
                'service_name.max' => "ກາລຸນາປ້ອນບໍ່ເກີນ 255 ໂຕ",

                'service_price.required' => "ກາລຸນາປ້ອນຂໍ້ມູນ",
                'service_price.numeric' => "ກາລຸນາປ້ອນຕົວເລກ",

                'service_image.required' => "ກາລຸນາເລືອກຮູບ",
            ]
        );

        $recep = $request->file('service_image');
        $fnam = $recep->getClientOriginalName();
        $upload_location = 'image/service/';
        $full_path_image = $upload_location . $fnam;

        $recep->move($upload_location, $fnam);
        $insert = new service();
        $insert->service_name = $request->service_name;
        $insert->service_price = $request->service_price;
        $insert->service_image = $full_path_image;
        if($insert->save()){
            return redirect()->route('service')->with('success','ບັນທຶກຂໍ້ມູນສຳເລັດ');
        }else{
            return redirect()->route('service')->with('error','ບັນທຶກຂໍ້ມູນບໍ່ສຳເລັດ');
        }
    }

    function serviceEdit(Request $request){
        $up = service::find($request->id);
        $recep = $request->file('service_image');
        
        if($recep==null){
            $up->service_name = $request->service_name;
            $up->service_price = $request->service_price;
            $up->save();
            return redirect()->route('service')->with('success','ແກ້ໄຂຂໍ້ມູນສຳເລັດ');
        }
        else{
            $fnam = $recep->getClientOriginalName();
            $upload_location = 'image/service/';
            $full_path_image = $upload_location . $fnam;
            unlink($up->service_image);
            $recep->move($upload_location, $fnam);
            $up->service_name = $request->service_name;
            $up->service_price = $request->service_price;
            $up->service_image = $full_path_image;
            $up->save();
            return redirect()->route('service')->with('success','ແກ້ໄຂຂໍ້ມູນສຳເລັດ');
        }
    }

    function serviceDelete(Request $request){
        service::find($request->id)->delete();
        toast('ລຶບຂໍ້ມູນສຳເລັດ','success')->timerProgressBar()->width('270px');
        return redirect()->route('service');
    }






}
