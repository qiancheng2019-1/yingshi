<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
header("Access-Control-Allow-Origin:*");
class VodController extends BaseController
{
    /*
     * 视频分类
     * */
    public function type(Request $request){
        $vod_ty=DB::table('columns')->where('id','=',$request->id)->select('id','pid','name')->first();
        if($vod_ty->pid==0){
            $ids=$vod_ty->id;
            $vod_list=DB::table('vod')
                ->where(array('vod.pids'=>$ids,'vod.status'=>0))
                ->join('columns', 'vod.pids', '=', 'columns.id')
                ->select('vod.*','columns.name as pidname')
                ->OrderBy('created_at','desc')
                ->paginate(26);

        }else{
                $vod_list=DB::table('vod')
                ->where(array('vod.pid'=>$request->id,'vod.status'=>0))
                ->join('columns', 'vod.pid', '=', 'columns.id')
                ->select('vod.*','columns.name as pidname')
                ->OrderBy('created_at','desc')
                ->paginate(26);
        };

        return view('index.vod.type',['vod_list'=>$vod_list,'vod_ty'=>$vod_ty]);
    }
    //
    /*
     * 视频详情
     * */
    public function detail(Request $request){
        $p = $request['p'] ?? 0;
        $detail=DB::table('vod')
            ->where(array('vod.id'=>$request->id))
            ->join('columns', 'vod.pid', '=', 'columns.id')
            ->join('vod_ad', 'vod.ad', '=', 'vod_ad.id')
            ->join('vod_domain', 'vod.domain', '=', 'vod_domain.id')
            ->select('vod.*','columns.name as pidname','vod_ad.url as vod_adurl','vod_domain.domain')
            ->first();
            DB::table('vod')->increment('red');
            $ids = explode( ',',$detail->type);
            $columns_cate=DB::table('vod_plot')->whereIn('id',$ids)->get(); //获取剧情
            $play_list=array_filter(str_replace("\r\n","",explode("&&",$detail->play_list))); //播放列表
            $vod_cate=DB::table('columns')->where(array('id'=>$detail->pid))->select('id','pid')->first();
            if($vod_cate->pid==0){
                $detail->share=$vod_cate->id;
            }else{
                $detail->share=$vod_cate->pid;
            }
            $detail->playUrl=$play_list[$p]; //根据p查询键播放列表
        return view('index.vod.detail',['detail'=>$detail,'columns_cate'=>$columns_cate,'play_list'=>$play_list,'p'=>$p]);
    }

}
