<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BaseController extends Controller
{
    //
    public function __construct()
    {
        $config=$this->getconfig();
        if($config['siteconfig']->status==1){
            abort(404);
        }

    }
    private function getconfig(){
        $config=DB::table('config')->where(array('name'=>'siteconfig'))->get();
        $arr=[];
        foreach ($config as $item){
            $arr[$item->name]=json_decode($item->config);
        }
        return $arr;
    }
}
