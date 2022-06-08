<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
class IMPORT_HOC_PHI_AGR_OCB extends Authenticatable
{
    protected $table ='IMPORT_HOC_PHI_AGR_OCB';

    protected $fillable = [
        "NGAY_NOP_HOC_PHI"
        ,"SO_TIEN"
        ,"NOI_DUNG_AGR_OCB"
        ,"MA_HOC_VIEN"
        ,"NGAN_HANG"
        ,"LOAI_HOC_PHI"
        ,"DOT_HOC"
        ,"SO_GIAO_DICH"
    ];
    protected $hidden = ['created_at', 'updated_at'];
    public $timestamps = false;
    public static function getHocPhiAribank(){
        $records =DB::table('IMPORT_HOC_PHI_AGR_OCB')
                ->select("NGAY_NOP_HOC_PHI","SO_TIEN","NOI_DUNG_AGR_OCB","MA_HOC_VIEN","NGAN_HANG","LOAI_HOC_PHI","DOT_HOC","SO_GIAO_DICH")
                ->orderBy('NGAY_NOP_HOC_PHI','asc');
        return $records;
    }
}
