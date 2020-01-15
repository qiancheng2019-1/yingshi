<?php
namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
header("Access-Control-Allow-Origin:*");
class M3u8Controller extends BaseController
{
    //
    public function index(Request $request){
        if($request->url){
            $id=$request->url;
            $p=$request->p ? $request->p : 0;
            $detail=DB::table('vod')
                ->where(array('vod.id'=>$id))
                ->join('vod_ad', 'vod.ad', '=', 'vod_ad.id')
                ->join('vod_domain', 'vod.domain', '=', 'vod_domain.id')
                ->select('vod.id','vod.ad','vod.play_list','vod_ad.url as vod_adurl','vod_domain.domain')
                ->first();
            $play_list=array_filter(str_replace("\r\n","",explode("&&",$detail->play_list))); //播放列表
            $detail->playUrl=$play_list[$p]; //根据p查询键播放列表
//            dd($detail);
            return view('index.m3u8.index',['detail'=>$detail]);
        }
        return 'none';
    }
}
