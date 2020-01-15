<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OpenController extends BaseController
{
    //
    /*
     * 采集接口
     * */
    public function index(){
        $openApi=DB::table('config')->where(array('name'=>'siteconfig'))->first();
        $res=json_decode($openApi->config);
        if($res->api !=0){
            return response()->json(['code'=>6000,'status'=>'error','data'=>'no open api']);
        }else{
            $vod=DB::table('vod')
            	->where(array('vod.status'=>0))
                ->join('columns', 'vod.pid', '=', 'columns.id')
                ->OrderBy('created_at')
                ->select('vod.id','vod.name','vod.alias','vod.director','vod.to_star','vod.type','vod.region','vod.language','vod.release_time','vod.film_length','vod.broadcast','vod.score','vod.count_score','vod.thumb','vod.desc','vod.play_list','vod.stop','vod.pid','vod.pids','vod.red','vod.created_at','vod.updated_at','columns.name as pidname')
                ->get();
//        dd($vod);
            return response()->json(['code'=>200,'status'=>'success','data'=>$vod]);
        }

    }
}
