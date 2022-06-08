<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Exception;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Arr;

use App\Http\Controllers\AdminControllers\InitController;
class ThongKeController extends Controller
{
    public function ThongKeHocPhi(Request $req)
    {
        if($this->checkCurrentLogin()){
            return view('/admin.src.ThongKeHocPhi.ThongKeHocPhi');
        }
        return View('/admin.src.Login');
    }
    public function checkCurrentLogin(){
        if(Session::has('userInfor')){
            return 1 ;
        }
        else{
            return 0;
        }
    }
    public function getAll(){
        $hocPhiHocKy = DB::table('HOC_PHI_HOC_KY_HV')
        ->leftJoin('HOC_VIEN', 'HOC_VIEN.MA_HOC_VIEN', '=', 'HOC_PHI_HOC_KY_HV.MA_HOC_VIEN')
        ->select('HOC_PHI_HOC_KY_HV.*', 'HOC_VIEN.*')
        ->get();
        $noHocPhi = DB::table('NO_HOC_PHI')
        ->leftJoin('HOC_VIEN', 'HOC_VIEN.MA_HOC_VIEN', '=', 'NO_HOC_PHI.MA_HOC_VIEN')
        ->select('NO_HOC_PHI.*', 'HOC_VIEN.*')
        ->get();
        $newHocPhiHocKy =[];
        $newNoHocPhi = [];
        $stt =1;
        $arrTemp =[];
        foreach($hocPhiHocKy as $hocPhi){
            $key = $hocPhi->DOT_HOC.','.$hocPhi->MA_HOC_VIEN;
            $newHocPhiHocKy[$key] = [
                "STT"=>$stt,
                "DOT_HOC"=>$hocPhi->DOT_HOC,
                "MA_HOC_VIEN"=>$hocPhi->MA_HOC_VIEN,
                'HO_TEN'=> $hocPhi->HO.' '.$hocPhi->TEN,
                "HOC_PHI"=>$hocPhi->HOC_PHI,
                "TIEN_DO"=>100,
                "TIEN_CON_THIEU"=>0,
            ];
            $stt+=1;

        }

        foreach($noHocPhi as $no){
            $key = $no->DOT_HOC.','.$no->MA_HOC_VIEN;
            $newNoHocPhi[$key] = [
                "DOT_HOC"=>$no->DOT_HOC,
                "MA_HOC_VIEN"=>$no->MA_HOC_VIEN,
                'HO_TEN'=> $no->HO.' '.$no->TEN,
                "SO_TIEN_NO"=>$no->SO_TIEN_NO,
            ];
        }
        foreach($newHocPhiHocKy as $key => $new){
            $check =$newNoHocPhi[$key] ??null;
            if($check){
                $newHocPhiHocKy[$key]["TIEN_DO"] =round(($new["HOC_PHI"] - $newNoHocPhi[$key]["SO_TIEN_NO"])/$new["HOC_PHI"]*100);
                $newHocPhiHocKy[$key]["TIEN_CON_THIEU"]= $newNoHocPhi[$key]["SO_TIEN_NO"];
            }
            $arrTemp[]=$newHocPhiHocKy[$key] ;
        }


        return response()->json([
                    "status" => 200,
                    "msg"=>'Sucess',
                    "data"=>$arrTemp
                ]);
    }
}
