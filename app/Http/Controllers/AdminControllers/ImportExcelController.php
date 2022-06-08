<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Exception;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Imports\HocPhiAribank;
use App\IMPORT_HOC_PHI_AGR_OCB;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as ReaderXlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpParser\Node\Stmt\Echo_;
use Carbon\Carbon;

class ImportExcelController extends Controller
{
    public function importHocphi(Request $req)
    {
        try {

            if ($req->file) {
                $result = [];
                $path = storage_path() . '/app/' . request()->file('file')->store('tmp');

                //read excel file
                $reader = new ReaderXlsx();
                $spreadsheet = $reader->load($path);
                $sheet = $spreadsheet->getActiveSheet();

                $worksheetInfo = $reader->listWorksheetInfo($path);
                $totalRows = $worksheetInfo[0]['totalRows'];

                $arr = [];
                for ($row = 2; $row <= $totalRows; $row++) {
                    $arr[] = (object) [
                        'NGAY_NOP_HOC_PHI' =>  new Carbon($sheet->getCell("A{$row}")->getValue()),
                        'SO_TIEN' => $sheet->getCell("B{$row}")->getValue(),
                        'NOI_DUNG_AGR_OCB' => $sheet->getCell("C{$row}")->getValue(),
                        'MA_HOC_VIEN' => $sheet->getCell("D{$row}")->getValue(),
                        'NGAN_HANG' => $sheet->getCell("E{$row}")->getValue(),
                        'LOAI_HOC_PHI' => $sheet->getCell("F{$row}")->getValue(),
                        'DOT_HOC' => new Carbon($sheet->getCell("G{$row}")->getValue()),
                        'SO_GIAO_DICH' => $sheet->getCell("H{$row}")->getValue()
                    ];
                }
                $listInsert = [];
                foreach ($arr as $item) {
                    $users = DB::table('IMPORT_HOC_PHI_AGR_OCB')
                        ->where('SO_GIAO_DICH', '=', $item->SO_GIAO_DICH)
                        ->get();
                    if (count($users) == 0) {
                        $import = new IMPORT_HOC_PHI_AGR_OCB;
                        $import->NGAY_NOP_HOC_PHI = $item->NGAY_NOP_HOC_PHI;
                        $import->MA_HOC_VIEN = $item->MA_HOC_VIEN;
                        $import->SO_TIEN = $item->SO_TIEN;
                        $import->NOI_DUNG_AGR_OCB = $item->NOI_DUNG_AGR_OCB;
                        $import->NGAN_HANG = $item->NGAN_HANG;
                        $import->LOAI_HOC_PHI = $item->LOAI_HOC_PHI;
                        $import->DOT_HOC = $item->DOT_HOC;
                        $import->SO_GIAO_DICH = $item->SO_GIAO_DICH;
                        $import->save();
                        $listInsert[] = $import->id;
                    }
                }

                $listNoDuplicate = [];
                //Chương 2 :Tìm học phí phải đóng của mấy đứa vừa insert
                foreach ($listInsert as $id) {
                    //B1 : Tìm đấy đủ thông tin mấy đứa vừa insert trước
                    $importAribank = DB::table('IMPORT_HOC_PHI_AGR_OCB')
                        ->where('ID', '=', $id)
                        ->first();

                    //B2 :Tìm đứa nào bị insert 2 lần (nó chuyển tiền 2 lần trong 1 đợt )-> tính tổng tiền nó gửi thành 1 danh sách thôi
                    if (count($listNoDuplicate) == 0) {
                        $listNoDuplicate[] = $importAribank;
                    } else {
                        $iskDuplicate = false;
                        for ($j = 0; $j < count($listNoDuplicate); $j++) {
                            if ($listNoDuplicate[$j]->DOT_HOC == $importAribank->DOT_HOC && $listNoDuplicate[$j]->MA_HOC_VIEN == $importAribank->MA_HOC_VIEN) {
                                $listNoDuplicate[$j]->SO_TIEN += $importAribank->SO_TIEN;
                                $iskDuplicate = true;
                            }
                        }
                        if ($iskDuplicate == false) {
                            $listNoDuplicate[] = $importAribank;
                        }
                    }
                }

                //B3 :Tìm những đứa đã insert trước đó trùng với những đứa trong danh sách mới insert -> cộng tổng tiền rồi lưu vào listNoDuplicate luôn , *tận dụng
                for ($k = 0; $k < count($listNoDuplicate); $k++) {
                    $so_tien_da_dong = DB::table('IMPORT_HOC_PHI_AGR_OCB')
                        ->where('DOT_HOC', '=', $listNoDuplicate[$k]->DOT_HOC)
                        ->where('MA_HOC_VIEN', '=', $listNoDuplicate[$k]->MA_HOC_VIEN)
                        ->get();

                    $tongSoTienDaDong = 0;
                    foreach ($so_tien_da_dong as $student) {
                        $tongSoTienDaDong += $student->SO_TIEN;
                    }
                    $listNoDuplicate[$k]->SO_TIEN = $tongSoTienDaDong;
                }
                // Chương 3: Insert nợ học phí
                for ($g = 0; $g < count($listNoDuplicate); $g++) {
                    // B1: Duyệt mảng noDuplicate tìm tiền phải đóng
                    $so_tien_phai_dong = DB::table('HOC_PHI_HOC_KY_HV')
                        ->where('DOT_HOC', '=', $listNoDuplicate[$g]->DOT_HOC)
                        ->where('MA_HOC_VIEN', '=', $listNoDuplicate[$g]->MA_HOC_VIEN)
                        ->first();
                    if ($so_tien_phai_dong) {
                        // B2 :Tính tiền nợ
                        $tien = $so_tien_phai_dong->HOC_PHI - $listNoDuplicate[$g]->SO_TIEN;
                        if ($tien > 0) {
                            // case 1 :Nếu tiền phải đóng - tiến đã đóng > 0 -> NỢ ->INSERT vào nợ học phí
                            DB::table('NO_HOC_PHI')->updateOrInsert(
                                [
                                    'MA_HOC_VIEN' =>  $listNoDuplicate[$g]->MA_HOC_VIEN
                                    ,'DOT_HOC' => $listNoDuplicate[$g]->DOT_HOC
                                ],
                                [ 'NGAY_DUYET' => Carbon::today()->toDateString()
                                  ,'SO_TIEN_NO' => $tien
                                ]
                            );
                            // case 2: Nếu tiền phải đóng - tiến đã đóng <=0 -> HẾT NỢ ->DELETE  nợ học phí
                        } else {
                            $deleted = DB::table('NO_HOC_PHI')
                                ->where('DOT_HOC', '=', $listNoDuplicate[$g]->DOT_HOC)
                                ->where('MA_HOC_VIEN', '=', $listNoDuplicate[$g]->MA_HOC_VIEN)
                                ->delete();
                        }
                    }
                }

                return response()->json([
                    "status" => 200,
                    'msg' => 'insert thành công',
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                "status" => 400,
                "msg" => $e->getMessage()
            ]);
        }
    }
}
