<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class IndexController extends BaseController
{
    //
    /*
     * 前台首页
     * */
    public function index(){
        $vod_list=DB::table('vod')
        	->where(array('vod.status'=>0))
            ->join('columns', 'vod.pid', '=', 'columns.id')
            ->select('vod.*','columns.name as pidname')
            ->OrderBy('updated_at','desc')
            ->paginate(26);

//        dd($vod_list);
        return view('index.index.index',['vod_list'=>$vod_list]);
    }
}
