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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use SebastianBergmann\Environment\Console;

class InitController extends Controller
{
    public function getAll_Hoc_Phi_Hoc_Vien()
    {
        $nganhs = DB::table('HOC_PHI_HOC_KY_HV')
        ->leftJoin('HOC_VIEN', 'HOC_VIEN.MA_HOC_VIEN', '=', 'HOC_PHI_HOC_KY_HV.MA_HOC_VIEN')
        ->select('HOC_PHI_HOC_KY_HV.*', 'HOC_VIEN.*')
        ->get();
        if ($nganhs) {
            $object = json_decode(json_encode($nganhs), FALSE);
            return response()->json([
                "data" => $object,
                "status" => 200,
                "msg"=>'Success'
            ]);
        } else {
            return response()->json([
                "status" => 404,
                "msg"=>'Something went wrong'
            ]);
        }
    }
    public function getAll_Import_AGR()
    {
        $khoas = DB::table('IMPORT_HOC_PHI_AGR_OCB')
        ->leftJoin('HOC_VIEN', 'HOC_VIEN.MA_HOC_VIEN', '=', 'IMPORT_HOC_PHI_AGR_OCB.MA_HOC_VIEN')
        ->select('IMPORT_HOC_PHI_AGR_OCB.*', 'HOC_VIEN.*')
        ->get();
        if ($khoas) {
            $object = json_decode(json_encode($khoas), FALSE);

            return response()->json([
                "data" => $object,
                "status" => 200
            ]);
        } else {
            return response()->json([
                "status" => 404
            ]);
        }
    }
    public function getAll_No_Hoc_Phi()
    {
        $mons = DB::table('NO_HOC_PHI')
        ->leftJoin('HOC_VIEN', 'HOC_VIEN.MA_HOC_VIEN', '=', 'NO_HOC_PHI.MA_HOC_VIEN')
        ->select('NO_HOC_PHI.*', 'HOC_VIEN.*')
        ->get();
        if ($mons) {
            $object = json_decode(json_encode($mons), FALSE);

            return response()->json([
                "data" => $object,
                "status" => 200,
                "msg"=>'Success'
            ]);
        } else {
            return response()->json([
                "status" => 404,
                "msg"=>'Something went wrong'
            ]);
        }
    }


    public function checkCurrentLogin()
    {
        if (Session::has('userInfor')) {
            return 1;
        } else {
            return 0;
        }
    }

}
