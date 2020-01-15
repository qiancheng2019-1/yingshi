<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ArticleController extends BaseController
{
    //

    /*
     * 文章详情
     * */
    public function detail(Request $request){
        $article=DB::table('article')
            ->join('article_cate', 'article.article_cate', '=', 'article_cate.id')
            ->where(array('article.id'=>$request->id,'status'=>0))
            ->select('article.*', 'article_cate.name')
            ->first();
//        dd($article);
        DB::table('article')->increment('red');
        return view('index.article.detail',['article'=>$article]);
    }
}
