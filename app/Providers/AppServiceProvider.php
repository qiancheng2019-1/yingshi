<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        /*
         * 获取系统配置信息
         * */
        $config=$this->getconfig();
//        dd($config);
        View::share([
            'config'=>$config,
        ]);
//        友链
        $this->getfriend();
//        导航
        $this->getnav();
//        统计视频
        $this->countvod();
        //   统计今日更新视频
        $this->countnow_vod();
    }
    private function getconfig(){
        $config=DB::table('config')->where(array('name'=>'siteconfig'))->get();
        $arr=[];
        foreach ($config as $item){
            $arr[$item->name]=json_decode($item->config);
        }
        return $arr;
    }
//友链
    public function getfriend(){
        $friend=DB::table('friend')->where('status','=','0')->get();
//        dd($friend);
        View::share('friend',$friend);
    }
    /*
     * 导航
     * */
    public function getnav(){
        $columns=DB::table('columns')->where(array('pid'=>0,'status'=>0))->select('id','name','pid','sort')->OrderBy('sort','desc')->get();
        foreach ($columns as $k=>$v){
            $subcomns=DB::table('columns')->where(array('pid'=>$v->id,'status'=>0))->select('id','name','pid','sort')->OrderBy('sort','desc')->get();
            if($subcomns){
                $columns[$k]->sub=$subcomns;
            }

        }
//        dd($columns);
        View::share('columns',$columns);
    }
    /*
     * 统计视频
     * */
    public function countvod(){
        $countvod=DB::table('vod')->where(array('status'=>0))->count();
        View::share('countvod',$countvod);
    }
    /*
 * 今日更新
 * */
    public function countnow_vod(){
        $now=date('Y-m-d');
        $countnow_vod=DB::table('vod')
            ->where(array('status'=>0))
            ->whereDate('updated_at', $now)
            ->count();
        View::share('countnow_vod',$countnow_vod);
    }
}
