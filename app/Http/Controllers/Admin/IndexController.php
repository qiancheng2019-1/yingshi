<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class IndexController extends BaseController
{
    public function console(){
        $laravel = app();

        $v = "version()";
        $DB=DB::select("select version()")[0]->$v;
        $info = array(
            'Laravel版本'=>$laravel::VERSION ,
            'PHP版本'=>PHP_VERSION,
            '数据库版本'=>$DB,
            '运行平台'=>PHP_OS,
            '运行环境'=>$_SERVER ['SERVER_SOFTWARE'],
            '上传附件限制'=>get_cfg_var ("upload_max_filesize")?get_cfg_var ("upload_max_filesize"):"不允许上传附件",
            '执行时间限制'=>get_cfg_var("max_execution_time")."秒 ",
            '内存限制值'=>get_cfg_var ("memory_limit")?get_cfg_var("memory_limit"):"无",
            '服务器时间'=>date("Y-m-d G:i:s"),
        );
        $cound=array(
            'vod'=>DB::table('vod')->count(),
            'vod_ad'=>DB::table('vod_ad')->count(),
            'article'=>DB::table('article')->count(),
            'friend'=>DB::table('friend')->count(),
        );
//        dd($cound['vod']);
        return view("admin.index.console",['info'=>$info,'cound'=>$cound]);
    }
    //后台首页
    public function index(){
//        dd($info);
        return view('admin.index.index');
    }
}
