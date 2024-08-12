<?php

namespace App\Http\Controllers;

use App\Models\employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
      //
      public function empShow(){
        $emp = employee::all();
        return view('admin.employee.index',compact('emp'));
    }
    public function empadd(Request $request){
        $request->validate(
            [
                'emp_name' => 'required|max:255',
                'emp_surname' => 'required|max:255',
                'address' => 'required|max:255',
                'contract' => 'required|max:11',
                'gender' => 'required|in:"ຊາຍ", "ຍິງ"',
                'email' => 'required|unique:employees|max:255|email',
                'username' => 'required|unique:employees|max:15',
                'userpass' => 'required|min:8',
                'is_admin' => 'required|in:"1", "0","2"',
            ],
            [
                'emp_name.required' => "ກາລຸນາປ້ອນຂໍ້ມູນ",
                'emp_name.max' => "ກາລຸນາປ້ອນບໍ່ເກີນ 255 ໂຕ",

                'emp_surname.required' => "ກາລຸນາປ້ອນຂໍ້ມູນ",
                'emp_surname.max' => "ກາລຸນາປ້ອນບໍ່ເກີນ 255 ໂຕ",

                'address.required' => "ກາລຸນາປ້ອນຂໍ້ມູນ",
                'address.max' => "ກາລຸນາປ້ອນບໍ່ເກີນ 255 ໂຕ",

                'contract.required' => "ກາລຸນາປ້ອນຂໍ້ມູນ",
                'contract.max' => "ກາລຸນາປ້ອນບໍ່ເກີນ 11 ໂຕ",

                'gender.required' => "ກາລຸນາເລືອກຂໍ້ມູນ",
                'gender.in' => "ກາລຸນາເລືອກຂໍ້ມູນ",

                'email.required' => "ກາລຸນາປ້ອນຂໍ້ມູນ",
                'email.unique' => "ອີເມວ ນີ້ມີຂໍ້ມູນຢູ່ແລ້ວ",
                'email.max' => "ກາລຸນາປ້ອນບໍ່ເກີນ 255 ໂຕ",
                'email.email' => "ຮູບແບບອີເມວບໍ່ຖືກຕ້ອງ xxx_xx@gmail.com",

                'username.required' => "ກາລຸນາປ້ອນຂໍ້ມູນ",
                'username.unique' => "ຊື່ຜູ້ໃຊ້ ນີ້ມີຂໍ້ມູນຢູ່ແລ້ວ",
                'username.max' => "ກາລຸນາປ້ອນບໍ່ເກີນ 15 ໂຕ",

                'userpass.required' => "ກາລຸນາປ້ອນຂໍ້ມູນ",
                'userpass.min' => "ກາລຸນາປ້ອນບໍ່ຕໍ່າກວ່າ 8 ໂຕ",
                
                'is_admin.required' => "ກາລຸນາເລືອກຂໍ້ມູນ",
                'is_admin.in' => "ກາລຸນາເລືອກຂໍ້ມູນ",
            ]
        );
        $emp = new employee();

        $emp->emp_name=$request->emp_name;
        $emp->emp_surname=$request->emp_surname;
        $emp->address=$request->address;
        $emp->contract=$request->contract;
        $emp->gender=$request->gender;
        $emp->email=$request->email;
        $emp->username=$request->username;
        $emp->password= Hash::make($request->userpass);
        $emp->is_admin=$request->is_admin;
        if($emp->save()){
            toast('ບັນທຶກຂໍ້ມູນສໍາເລັດ','success')->timerProgressBar()->width('380px');
        }
        else{
            toast('ບັນທຶກຂໍ້ມູນບໍ່ສໍາເລັດ','success')->timerProgressBar()->width('380px');
        }
        return redirect()->route('employee');
    }
    public function empedit(Request $request){
        $empup = employee::find($request->id);
        $empup->emp_name=$request->emp_name;
        $empup->emp_surname=$request->emp_surname;
        $empup->address=$request->address;
        $empup->contract=$request->contract;
        $empup->gender=$request->gender;
        $empup->email=$request->email;
        $empup->save();
        toast('ແກ້ໄຂຂໍ້ມູນສໍາເລັດ','success')->timerProgressBar()->width('380px');
        return redirect()->route('employee');
    }
    public function emppass(Request $request){
        $emppass = employee::find($request->id);
        $emppass->password= Hash::make($request->userpass);
        $emppass->save();
        toast('ປ່ຽນລະຫັດຜ່ານສໍາເລັດ','success')->timerProgressBar()->width('390px');
        return redirect()->route('employee');
    }
}
