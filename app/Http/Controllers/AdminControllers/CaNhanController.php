<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Exception;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use SebastianBergmann\Environment\Console;
use Illuminate\Http\Request;

class CaNhanController extends Controller
{
    public function chiTietCaNhan()
    {
        if($this->checkCurrentLogin()){
            return view('/admin.src.CacTrangKhac.ChiTietCaNhan');
        }
        return View('/admin.src.Login');
    }

    public function getAllThongTinCaNhan()
    {
        $hocvien = DB::table('HOC_VIEN')
        ->where('MA_HOC_VIEN','=',Session('userInfor')->user_name)
        ->get();

        $hocPhiHocVien = DB::table('HOC_PHI_HOC_KY_HV')
        ->where('MA_HOC_VIEN','=',Session('userInfor')->user_name)
        ->get();

        $hocPhiDaDong = DB::table('IMPORT_HOC_PHI_AGR_OCB')
        ->where('MA_HOC_VIEN','=',Session('userInfor')->user_name)
        ->get();

        $hocPhiNo = DB::table('NO_HOC_PHI')
        ->where('MA_HOC_VIEN','=',Session('userInfor')->user_name)
        ->get();

        $dangKyMon = DB::table('DANG_KY_MON_HOC')
        ->leftJoin('MON_HOC', 'MON_HOC.MA_MH', '=', 'DANG_KY_MON_HOC.MA_MH')
        ->select('DANG_KY_MON_HOC.*', 'MON_HOC.*')
        ->where('DANG_KY_MON_HOC.MA_HOC_VIEN','=',Session('userInfor')->user_name)
        ->get();

        //Lọc tất cả học kỳ hoc viên
        $dsHocKy = [];
        foreach($dangKyMon as $dangky )
        {
            if(count($dsHocKy)==0){
                $dsHocKy[] = $dangky->DOT_HOC;
            }
            else
            {
                $check = 0;
                foreach($dsHocKy as $hocky )
                {
                    if($hocky == $dangky->DOT_HOC)
                    {
                        $check = 1;
                    }
                }
                if($check ==0)
                {
                    $dsHocKy[] = $dangky->DOT_HOC;
                }
            }
        }

        //lọc phân môn cho từng học kỳ
        $tongket = [];
        foreach($dsHocKy as $hocKy)
        {
            $hocky_mon =[];
            foreach($dangKyMon as $dangky)
            {
                if($dangky->DOT_HOC ==$hocKy){
                    $hocky_mon[] = [
                        'MA_MH'=>$dangky->MA_MH,
                        'TEN_MH'=>$dangky->TEN,
                        'SO_TIN_CHI'=>$dangky->SO_TIN_CHI
                    ];
                }
            }
            $hocky_hocPhi =[];
            foreach($hocPhiHocVien as $hocphi){
                if($hocphi->DOT_HOC ==$hocKy){
                    $hocky_hocPhi[] = [
                        'TONG_SO_TIN_CHI'=>$hocphi->TONG_SO_TIN_CHI,
                        'HOC_PHI'=>$hocphi->HOC_PHI,
                    ];
                }
            }

            $hocky_noHocPhi =[];
            foreach($hocPhiNo as $no){
                if($no->DOT_HOC ==$hocKy){
                    $hocky_noHocPhi[] = [
                        'SO_TIEN_NO'=>$no->SO_TIEN_NO,
                    ];
                }
            }
            $tongket[$hocKy] = [
                "MONS"=>$hocky_mon,
                "HOC_PHI"=>$hocky_hocPhi,
                "NO_HOC_PHI"=>$hocky_noHocPhi,
                "TIEN_DA_DONG"=>$hocky_hocPhi[0]['HOC_PHI'] - $hocky_noHocPhi[0]['SO_TIEN_NO'],
            ];
        }

        return response()->json([
            "status" => 200,
            "msg"=>'Something went wrong',
            "data"=> $tongket,
            "listKey"=>$dsHocKy,
            "hocVien"=>$hocvien
        ]);
    }

    public function checkCurrentLogin()
    {
        if (Session::has('userInfor')) {
            return 1;
        } else {
            return 0;
        }
    }

    public function updateChitietCaNhan(Request $req)
    {
        try{
            $email= '';
            $phone='';
            $address='';
            $note='';
            if($req->email){
                $email = $req->email;
                DB::table('HOC_VIEN')
                ->where('MA_HOC_VIEN', Session('userInfor')->user_name)
                ->limit(1)
                ->update(array('EMAIL' => $email));

            }
            if($req->phone){
                $phone = $req->phone;
                DB::table('HOC_VIEN')
                ->where('MA_HOC_VIEN', Session('userInfor')->user_name)
                ->limit(1)
                ->update(array('DIEN_THOAI' => $phone));

            }
            if($req->address){
                $address = $req->address;
                DB::table('HOC_VIEN')
                ->where('MA_HOC_VIEN', Session('userInfor')->user_name)
                ->limit(1)
                ->update(array('DIA_CHI' => $address));

            }

            return response()->json([
                "status" => 200,
                "msg"=>'done',
                "data"=>[
                    'email'=>$email,
                    'phone'=>$phone,
                    'address'=>$address,
                ]
            ]);
        }
        catch( Exception $e){
            return response()->json([
                "status" => 500,
                "msg"=>'failed',
            ]);
        }


    }

}
