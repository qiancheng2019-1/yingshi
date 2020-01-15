<?php

namespace App\Http\Controllers\Admin;

use App\Column;
use App\Http\Requests\CheckManage;
use App\Http\Requests\ColumnAdd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ConfigController extends BaseController
{
    //网站设置
    public function site(){
        $res_config=DB::table('config')->where('name','=','siteconfig')->first();
        $config=[];
        if($res_config){
            $config = json_decode($res_config->config,true);
        }
        return view("admin.config.site")->with('config',$config);
    }
//    数据入库
    public function store(Request $request){
        $data=$request->only('name','title');
        $config=json_encode($request->except('name','title','_token'));
        $data['config']=$config;
        $data['created_at']=date("Y/m/d H:i:s",time());
        $data['updated_at']=date("Y/m/d H:i:s",time());
        $config=DB::table('config')->where('name','=',$request->name)->first();
        if($config){
            $result=DB::table('config')->update($data);
        }else{
            $result=DB::table('config')->insert($data);
        }
        if($result===true || $result>0){
//            return redirect(route('admin.config.site'));
            return response()->json(['code'=>200,'msg'=>'保存成功']);
        }else{
            return response()->json(['code'=>500,'msg'=>'保存失败']);
        }
    }
    /*
     * 图片上传接口
     * */
    public function fileupload(Request $request){
        // 设置超时时间为没有限制
        ini_set("max_execution_time", "0");
        $file = $request->file('file');

        $allowed_extensions = ["png", "jpg", "gif", "jpeg", "bmp"];
        if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
            return json_encode(['error' => '只能上载png、jpg或gif、jpeg或bmp.']);
        }

        $destinationPath = 'uploads/config/'.date('Ymd'); //public 文件夹下面建 storage/uploads 文件夹
        $extension = $file->getClientOriginalExtension();
        $fileName = md5(microtime(true)).'.'.$extension;
        $file->move($destinationPath, $fileName);

        return json_encode(['type' => $extension , 'url' => '/'.$destinationPath.'/'.$fileName , 'name' => $fileName]);

    }
//    网站栏目
    public function column_list(){
        $column_list = Column::OrderBy("sort","desc")->OrderBy("id","desc")->get();
        $column_list=Column::getcolumn();
        return view('admin.config.column_list',['column_list'=>$column_list]);
    }
//    网站栏目添加
    public function column_add(Request $request){
        if($request->isMethod("POST")){
            $validatedData = $request->validate([
                'name' => 'required',
            ],['name.required'=>'栏目不能为空']);

            $column = new Column();
            $column -> name=$request->name;
            $column -> sort=$request->sort;
            $column -> status=$request->status;
            $column -> pid=$request->pid;

            $result =$column->save();
            if($result==true){
                session()->flash('msg',"添加成功");
                return redirect(route('admin.config.column_list'));
            }else{
                session()->flash('msg',"添加失败");
            }
        }
        $column_list=Column::getcolumn();
        return view("admin.config.column_add")->with("column_list",$column_list);
    }
    /*
     * 栏目编辑
     */
    public function column_edit(Request $request,Column $id){
        if($request->isMethod("POST")){
            $validatedData = $request->validate([
                'name' => 'required',
            ],['name'=>'栏目不能为空']);

            $column = new Column();
            $id -> name=$request->name;
            $id -> sort=$request->sort;
            $id -> status=$request->status;
            $id -> pid=$request->pid;
            $result =$id->save();
            if($result==true){
                session()->flash('msg',"修改成功");
                return redirect(route('admin.config.column_list'));
            }else{
                session()->flash('msg',"修改失败");
            }
        }
        $column_list=Column::getcolumn();
        return view('admin.config.column_edit')->with("columns",$id)->with("column_list",$column_list);
    }
    /*
     * 栏目删除
     */
    public function column_del(Column $id){
        $result = $id->delete();
        if($result==true){
            session()->flash('msg',"删除成功");
            return redirect(route('admin.config.column_list'));
        }else{
            session()->flash('msg',"删除失败");
        }
    }
    /*
     * 管理员列表
     * */
    public function manage_list(){
        $manage_list=DB::table('admins')->orderBy("id", "desc")->paginate(10);
        return view('admin.config.manage_list',['manage_list'=>$manage_list]);
    }
    /*
     * 管理员添加
     * */
    public function manage_add(CheckManage $request){
        if($request->isMethod('POST')){
            $data=$request->except('_token','password_confirmation');
            $data['created_at']=date('Y-m-d H:i:s');
            $data['updated_at']=date('Y-m-d H:i:s');
            $data['password']=bcrypt($data['password']);
            $manages=DB::table('admin')->where('username',$request->username)->first();
            if($manages){
                return response()->json(['code'=>500,'msg'=>'该账号已存在，请换一个']);
            }
            $res=DB::table('admins')->insert($data);
            if($res==true){
                return response()->json(['code'=>200,'msg'=>'添加成功','url'=>route('admin.config.manage_list')]);
            }else{
                return response()->json(['code'=>500,'msg'=>'添加失败']);
            }

        }
        return view('admin.config.manage_add');
    }
    /**
     * 管理员编辑
     */
    public function manage_edit(CheckManage $request){
        $manage = DB::table('admins')
            ->where('id', $request->manage)
            ->first();
        if($request->isMethod('POST')){
            $data=$request->except('_token','id','password_confirmation');
            $data['updated_at']=date('Y-m-d H:i:s');
            $older = DB::table('admins')
                ->where('id', $request->id)
                ->first();
            if($request->password==''){
                $data['password']=$older->password;
            }else{
                $data['password']=bcrypt($data['password']);
            }

//            return response()->json(['code'=>500,'msg'=>$older]);
            $res=DB::table('admins')->where('id',$request->id)->update($data);

            if($res==true){
                return response()->json(['code'=>200,'msg'=>'修改成功','url'=>route('admin.config.manage_list')]);
            }else{
                return response()->json(['code'=>500,'msg'=>'修改失败']);
            }

        }
        return view('admin.config.manage_edit',['manage'=>$manage]);
    }
    /*
     * 管理删除
     * */
    public function manage_del(Request $manage){
        $res= DB::table('admins')
            ->where('id', '=',$manage->manage)
            ->delete();
        if($res){
            return response()->json(['code'=>200,'msg'=>'删除成功']);
        }else{
            return response()->json(['code'=>500,'msg'=>'删除成功']);
        }
    }

}
