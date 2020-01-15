<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
header("Access-Control-Allow-Origin:*");
class ShareController extends BaseController
{
    //
    public function index(Request $request){
//        获取视频id
        $vod_id=$request->id;
//        获取播放id,并解密
        $play_id=$this->endecodevodId($request->p,'decode');
//        dd($play_id);
        $detail=DB::table('vod')
            ->where(array('vod.id'=>$vod_id))
            ->join('vod_ad', 'vod.ad', '=', 'vod_ad.id')
            ->join('vod_domain', 'vod.domain', '=', 'vod_domain.id')
            ->select('vod.*','vod_ad.url as vod_adurl','vod_domain.domain')
            ->first();
        $vod_cate=DB::table('columns')->where(array('id'=>$detail->pid))->select('id','pid')->first();
        if($vod_cate->pid==0){
            $detail->share=$vod_cate->id;
        }else{
            $detail->share=$vod_cate->pid;
        }
        $play_list=array_filter(str_replace("\r\n","",explode("&&",$detail->play_list))); //播放列表
        $detail->playUrl=$play_list[$play_id]; //根据p查询键播放列表
//        dd($detail);
        return view('index.share.index',['detail'=>$detail,'play_id'=>$play_id]);
    }
    /**
     * 加密解密视频id,
     * @param unknown $string
     * @param string $action  encode|decode
     * @return string
     */
    public function endecodevodId($string, $action = 'encode') {
        $startLen = 13;
        $endLen = 8;

        $coderes = '';
        #TOD 暂设定uid字符长度最大到9
        if ($action=='encode') {
            $uidlen = strlen($string);
            $salt = 'yourself_code';
            $codestr = $string.$salt;
            $encodestr = hash('md4', $codestr);
            $coderes = $uidlen.substr($encodestr, 5,$startLen-$uidlen).$string.substr($encodestr, -12,$endLen);
            $coderes = strtoupper($coderes);
        }elseif($action=='decode'){
            $strlen = strlen($string);
            $uidlen = $string[0];
            $coderes = substr($string, $startLen-$uidlen+1,$uidlen);
        }
        return  $coderes;
    }
}
