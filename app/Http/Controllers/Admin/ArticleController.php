<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CheckArticle;
use App\Http\Requests\CheckArticleCate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ArticleController extends BaseController
{
    /*
     * 文章分类
     * */
    public function article_cate(){
        $article_cate= DB::table('article_cate')->paginate(15);
        return view('admin.article.article_cate',['article_cate'=>$article_cate]);
    }
    /*
     * 文章分类添加
     * */
    public function article_cate_add(CheckArticleCate $request){
        if($request->isMethod('POST')){
            $data=$request->except('_token');
            $data['created_at']=date('Y-m-d H:i:s');
            $data['updated_at']=date('Y-m-d H:i:s');
            $res=DB::table('article_cate')->insert($data);
            if($res==true){
                return response()->json(['code'=>200,'msg'=>'添加成功','url'=>route('admin.article.article_cate')]);
            }else{
                return response()->json(['code'=>500,'msg'=>'添加失败']);
            }
        }
        return view('admin.article.article_cate_add');
    }
    /*
     * 文章分类编辑
     * */
    public function article_cate_edit(CheckArticleCate $request){

        $article_cate=DB::table('article_cate')->where('id',$request->article)->first();
        if($request->isMethod('POST')){
            $data=$request->except('_token');
            $data['updated_at']=date('Y-m-d H:i:s');
            $res=DB::table('article_cate')->where('id',$request->id)->update($data);
            if($res==true){
                return response()->json(['code'=>200,'msg'=>'修改成功','url'=>route('admin.article.article_cate')]);
            }else{
                return response()->json(['code'=>500,'msg'=>'修改失败']);
            }
        }
        return view('admin.article.article_cate_edit',['article_cate'=>$article_cate]);
    }
    /*
     * 文章分类删除
     * */
    public function article_cate_del(Request $request){
        $res=DB::table('article_cate')->where('id',$request->id)->delete();
        if($res==true){
            return response()->json(['code'=>200,'msg'=>'删除成功']);
        }else{
            return response()->json(['code'=>500,'msg'=>'删除失败']);
        }
    }
    /*
     * 文章列表
     * */
    public function article_list(){
        $article_list=DB::table('article')
            ->leftJoin('article_cate', function ($join) {
                $join->on('article_cate.id', '=', 'article.article_cate');
            })
            ->select('article.*','article_cate.name')
            ->OrderBy('id', 'desc')
            ->paginate(15);
        return view('admin.article.article_list',['article_list'=>$article_list]);
    }
    /*
     * 文章添加
     * */
    public function article_add(CheckArticle $request){
        $article_cate=DB::table('article_cate')->OrderBy('id','desc')->get();
        if($request->isMethod('POST')){
            $data=$request->except('_token');
            $data['created_at']=date('Y-m-d H:i:s');
            $data['updated_at']=date('Y-m-d H:i:s');

            $res=DB::table('article')->insert($data);
            if($res==true){
                return response()->json(['code'=>200,'msg'=>'添加成功','url'=>route('admin.article.article_list')]);
            }else{
                return response()->json(['code'=>500,'msg'=>'添加失败']);
            }
        }
        return view('admin.article.article_add',['article_cate'=>$article_cate]);
    }
    /*
     * 文章编辑
     * */
    public function article_edit(CheckArticle $request){
        $article=DB::table('article')->where('id',$request->id)->first();
        if($request->isMethod('POST')){
            $data=$request->except('_token','id');
            $data['created_at']=date('Y-m-d H:i:s');
            $data['updated_at']=date('Y-m-d H:i:s');
            //        删除旧图片
            //$files=base_path('public').$article->thumb;
           if($data['thumb'] != $article->thumb){
                $files=base_path('public').$article->thumb;
                if(file_exists($files)){//判断文件是否存在
                    @unlink($files);
                }
            }
            $res=DB::table('article')->where('id',$request->id)->update($data);
            if($res==true){
                return response()->json(['code'=>200,'msg'=>'修改成功','url'=>route('admin.article.article_list')]);
            }else{
                return response()->json(['code'=>500,'msg'=>'修改失败']);
            }
        }
        $article_cate=DB::table('article_cate')->OrderBy('id','desc')->get();
        return view('admin.article.article_edit',['article_cate'=>$article_cate,'article'=>$article]);
    }
    /*
     * 文章删除
     * */
    public function article_del(Request $request){
        $find=DB::table('article')->where('id',$request->id)->first();
//        删除旧图片
        $files=base_path('public').$find->thumb;
        if(file_exists($files)){//判断文件是否存在
            @unlink($files);
        }
        $res=DB::table('article')->where('id',$request->id)->delete();
        if($res==true){
            return response()->json(['code'=>200,'msg'=>'删除成功']);
        }else{
            return response()->json(['code'=>500,'msg'=>'删除失败']);
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

        $destinationPath = 'uploads/article/'.date('Ymd'); //public 文件夹下面建 storage/uploads 文件夹
        $extension = $file->getClientOriginalExtension();
        $fileName = md5(microtime(true)).'.'.$extension;
        $file->move($destinationPath, $fileName);

        return json_encode(['type' => $extension , 'url' => '/'.$destinationPath.'/'.$fileName , 'name' => $fileName]);

    }
}
