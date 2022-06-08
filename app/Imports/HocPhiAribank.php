<?php

namespace App\Imports;

use App\IMPORT_HOC_PHI_AGR_OCB;
use Maatwebsite\Excel\Concerns\ToModel;

class HocPhiAribank implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new IMPORT_HOC_PHI_AGR_OCB([
            // "NGAY_NOP_HOC_PHI" => $row["NGAY_NOP_HOC_PHI"],
            // "SO_TIEN"=> $row["SO_TIEN"],
            // "NOI_DUNG_AGR_OCB"=> $row["NOI_DUNG_AGR_OCB"],
            // "MA_HOC_VIEN"=> $row["MA_HOC_VIEN"],
            // "NGAN_HANG"=> $row["NGAN_HANG"],
            // "LOAI_HOC_PHI"=> $row["LOAI_HOC_PHI"],
            // "DOT_HOC"=> $row["DOT_HOC"],
            // "SO_GIAO_DICH" => $row["SO_GIAO_DICH"]

            "NGAY_NOP_HOC_PHI" => $row[0],
            "SO_TIEN"=> $row[1],
            "NOI_DUNG_AGR_OCB"=> $row[2],
            "MA_HOC_VIEN"=> $row[3],
            "NGAN_HANG"=> $row[4],
            "LOAI_HOC_PHI"=> $row[5],
            "DOT_HOC"=> $row[6],
            "SO_GIAO_DICH" => $row[7]
        ]);
    }
}
