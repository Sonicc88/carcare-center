<?php

namespace App\Http\Controllers;

use App\Models\employee;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(){
        return view('login');
    }
    public function loginPost(Request $request){
        $request->validate(
            [
                'email' => 'required',
                'password' => 'required'
            ],
            [
                'email.required' => "ກາລຸນາປ້ອນຂໍ້ມູນ",

                'password.required' => "ກາລຸນາປ້ອນຂໍ້ມູນ",
            ]
        );
        $loginValue = $request->input('email');
        $email = filter_var($loginValue,FILTER_VALIDATE_EMAIL) ?'email' : 'username';
        request()->merge([$email => $loginValue]);
        $input = $request->all();
        $user=employee::where(array('email'=>$input['email']))->orwhere(array('username'=>$input['email']))->get();
        $credentials = array($email => $loginValue, 'password' => $input['password']);
        if(Auth::attempt($credentials)){
            if(auth()->user()->is_admin == 1){
                toast('ຍຶນດີຍິນດີຕ້ອນຮັບເຂົ້າສູ່ໜ້າ Admin','success')->timerProgressBar()->width('400px');
                return redirect()->route('order');
            }
            elseif(auth()->user()->is_admin == 0){
                toast('ຍຶນດີຍິນດີຕ້ອນຮັບເຂົ້າສູ່ໜ້າ User','success')->timerProgressBar()->width('400px');
                return redirect()->route('user');
            }
        }else{
            alert()->warning('ແຈ້ງເຕືອນ','ຊື່ຜູ້ໃຊ້ , ອີເມວ ຫຼື ລະຫັດຜ່ານບໍ່ຖືກຕ້ອງ.')->timerProgressBar()->width('400px');
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function register(){
        return view('register');
    }
    public function registerPost(Request $request){

        $request->validate(
            [
                'name' => 'required|unique:users|max:255',
                'email' => 'required|unique:users|max:255|email',
                'password' => 'required|min:8',
            ],
            [
                'name.required' => "ກາລຸນາປ້ອນຂໍ້ມູນ",
                'name.unique' => "ຊື່ຜູ້ໃຊ້ ນີ້ມີຂໍ້ມູນຢູ່ແລ້ວ",
                'name.max' => "ກາລຸນາປ້ອນບໍ່ເກີນ 255 ໂຕ",

                'email.required' => "ກາລຸນາປ້ອນຂໍ້ມູນ",
                'email.unique' => "ອີເມວ ນີ້ມີຂໍ້ມູນຢູ່ແລ້ວ",
                'email.max' => "ກາລຸນາປ້ອນບໍ່ເກີນ 255 ໂຕ",
                'email.email' => "ຮູບແບບອີເມວບໍ່ຖືກຕ້ອງ xxx_xx@gmail.com",

                'password.required' => "ກາລຸນາປ້ອນຂໍ້ມູນ",
                'password.min' => "ກາລຸນາປ້ອນບໍ່ຕໍ່າກວ່າ 8 ໂຕ",
            ]
        );
        $user = new employee();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password= Hash::make($request->password);
        $user->is_admin='0';
        $user->save();
        return redirect()->route('register')->with('success', "ບັນທຶກຂໍ້ມູນສຳເລັດ");
    }
}
