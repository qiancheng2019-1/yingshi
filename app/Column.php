<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    //获取栏目列表
    static public function getcolumn(){
        $column_list = self::OrderBy("sort","desc")->OrderBy("id","desc")->get();
        $column_list = self::makecolumn($column_list);
        return $column_list;
    }

    /**
     * 组织栏目数据
     */
    static function makecolumn($data,$pid=0,$level=0){
        static $arr=array();
        foreach ($data as $item){
            if($item->pid==$pid){
                $item->level=$level;
                $arr[] = $item;
                self::makecolumn($data,$item->id,$level+1);
            }
        }
        return $arr;
    }
}
