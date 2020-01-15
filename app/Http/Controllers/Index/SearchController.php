<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SearchController extends BaseController
{
    //
    /*
     * 搜索
     * */
    public function index(Request $request){
    	// $where = [];
         $where[] = ['vod.name','like','%'.$request->search.'%'];
         $where[] = ['vod.status','=','0'];
         
        $vod_list=DB::table('vod')
            ->where($where)
            ->join('columns', 'vod.pid', '=', 'columns.id')
            ->select('vod.*','columns.name as pidname')
            ->OrderBy('created_at','desc')
            ->paginate(26);
        foreach ($vod_list as $k=>$v){
            $vod_list[$k]->play_list=count(explode("\r\n",$v->play_list));
            $vod_cate=DB::table('columns')->where(array('id'=>$v->pid))->select('id','pid')->first();
            if($vod_cate->pid==0){
                $vod_list[$k]->share=$vod_cate->id;
            }else{
                $vod_list[$k]->share=$vod_cate->pid;
            }

        }
        return view('index.search.index',['vod_list'=>$vod_list]);
    }
}
