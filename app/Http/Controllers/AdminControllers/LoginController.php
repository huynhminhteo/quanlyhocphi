<?php

namespace App\Http\Controllers\AdminControllers;
use App\Http\Controllers\Controller;
use Exception;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Session;
class LoginController extends Controller
{
    public function loginPage(){
        if($this->checkCurrentLogin()){
            return redirect('admin/ThongKeHocPhi');
        }
        return View('/admin.src.Login');
    }
    public function registerPage(){
        if($this->checkCurrentLogin()){
            return redirect('admin/ThongKeHocPhi');
        }
        return View('/admin.src.Register');
    }
    public function ThongTinHocPhiPage(){
        if($this->checkCurrentLogin()){
            return View('/admin.src.ManyTable.ThongTinHocPhi');
        }
        return redirect('/');
    }
    public function checkCurrentLogin(){
        if(Session::has('userInfor')){
            return 1 ;
        }
        else{
            return 0;
        }
    }

    public function postLogin(Request $req){
       try{
        $arr = [
            'user_name' => $req->user_name,
            'password' => $req->password,
        ];

        if ($user = User::where($arr)->first()) {
            $req->session()->put('userInfor', $user);
            return redirect('admin/ThongKeHocPhi');
            //..code tùy chọn
            //đăng nhập thành công thì hiển thị thông báo đăng nhập thành công
        } else {

            return ('tài khoản và mật khẩu chưa chính xác');
            //...code tùy chọn
            //đăng nhập thất bại hiển thị đăng nhập thất bại
        }
       }
       catch(Exception $e){
        return $e->getMessage();
        return redirect('/');
       }
    }
    public function register(){

        return 'register ne';
    }
    public function postLogOut(){
        Session::forget('userInfor');
        return redirect('/');
    }


}
