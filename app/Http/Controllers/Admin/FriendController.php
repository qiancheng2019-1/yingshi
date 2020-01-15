<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CheckFriend;
use App\Http\Requests\FriendAdd;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class FriendController extends BaseController
{
    //友链列表
    public function friend_list(){
        $friend_list=DB::table('friend')->orderBy("id", "desc")->paginate(10);
        return view('admin.friend.friend_list', ['friend_list' => $friend_list]);
    }
    //    友链添加
    public function friend_add(CheckFriend $request){
        if($request->isMethod('POST')){
            $data=$request->except('_token');
            $res=DB::table('friend')->insert($data);
            if($res==true){
                return response()->json(['code'=>200,'msg'=>'添加成功','url'=>route('admin.friend.friend_list')]);
            }else{
                return response()->json(['code'=>500,'msg'=>'添加失败']);
            }

        }
        return view('admin.friend.friend_add');
    }
    /**
     * 编辑
     */
    public function friend_edit(CheckFriend $request){
        $friend = DB::table('friend')
            ->where('id', $request->friend)
            ->first();
        if($request->isMethod('POST')){
            $data=$request->except('_token','id');
            $res=DB::table('friend')->where('id',$request->id)->update($data);

            if($res==true){
                return response()->json(['code'=>200,'msg'=>'修改成功','url'=>route('admin.friend.friend_list')]);
            }else{
                return response()->json(['code'=>500,'msg'=>'修改失败']);
            }

        }
        return view('admin.friend.friend_edit',['friend'=>$friend]);
    }
    /*
     * 删除
     * */
    public function friend_del(Request $friend){
        $res= DB::table('friend')
            ->where('id', '=',$friend->friend)
            ->delete();
        if($res){
            return response()->json(['code'=>200,'msg'=>'删除成功']);
        }else{
            return response()->json(['code'=>500,'msg'=>'删除成功']);
        }
    }

}
