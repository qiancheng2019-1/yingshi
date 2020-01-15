<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::get('/', function () {
//    return view('welcome');
//});
//前台路由
Route::get("/","Index\IndexController@index")->name("index");
Route::group(['prefix'=>'vod'],function(){
    Route::get("/type/{id}.html","Index\VodController@type")->name("vod.type"); //视频类型
    Route::get("/detail/{id}.html","Index\VodController@detail")->name("vod.detail"); //视频详情
});
//播放链接
Route::get("/share/{id}/{p}","Index\ShareController@index")->name("share.index"); //播放链接
Route::get("/open.html","Index\OpenController@index")->name("open.index");//视频采集接口
Route::get("/search.html","Index\SearchController@index")->name("search.index");//视频采集接口
Route::get("/article/detail/{id}.html","Index\ArticleController@detail")->name("article.detail");//文章详情
Route::get("/sitemap.html","Index\SitemapController@index")->name("sitemap.index");//网站地图
Route::get("/m3u8.html","Index\M3u8Controller@index")->name("m3u8.index"); //m3u8播放链接


//后台路由
Route::prefix("f_cadmin")->name("admin.")->middleware('auth')->group(function (){
//    后台首页
    Route::get("/index.html","Admin\IndexController@index")->name("index");
//    控制台
    Route::get("/console.html","Admin\IndexController@console")->name("console");
//    后台登录
    Route::get("/logout.html","Admin\LoginController@logout")->name("login.logout");
//    网站设置
    Route::group(['prefix'=>'config'],function(){
        Route::get("/site.html","Admin\ConfigController@site")->name("config.site");
        Route::post("/store.html","Admin\ConfigController@store")->name("config.sore");
        Route::post("/fileupload.html","Admin\ConfigController@fileupload")->name("config.fileupload");
        Route::get("/column_list.html","Admin\ConfigController@column_list")->name("config.column_list");
        Route::match(["get","post"],"/column_add.html","Admin\ConfigController@column_add")->name("config.column_add");
        Route::match(["get","post"],"/column_edit{id}.html","Admin\ConfigController@column_edit")->name("config.column_edit");
        Route::get("/column_del{id}.html","Admin\ConfigController@column_del")->name("config.column_del");
//        管理员管理
        Route::get("/manage_list.html","Admin\ConfigController@manage_list")->name("config.manage_list");
        Route::match(["get","post"],"/manage_add.html","Admin\ConfigController@manage_add")->name("config.manage_add");
        Route::match(["get","post"],"/manage_edit.html","Admin\ConfigController@manage_edit")->name("config.manage_edit");
        Route::post("/manage_del.html","Admin\ConfigController@manage_del")->name("config.manage_del");
    });
//    友情链接
    Route::group(['prefix'=>'friend'],function(){
        Route::get("/friend_list.html","Admin\FriendController@friend_list")->name("friend.friend_list");
        Route::match(["get","post"],"/friend_add.html","Admin\FriendController@friend_add")->name("friend.friend_add");
        Route::match(["get","post"],"/friend_edit.html","Admin\FriendController@friend_edit")->name("friend.friend_edit");
        Route::post("/friend_del.html","Admin\FriendController@friend_del")->name("friend.friend_del");
    });
//    文章管理
    Route::group(['prefix'=>'article'],function(){
//        文章分类
        Route::get("/article_cate.html","Admin\ArticleController@article_cate")->name("article.article_cate");
        Route::match(["get","post"],"/article_cate_add.html","Admin\ArticleController@article_cate_add")->name("article.article_cate_add");
        Route::match(["get","post"],"/article_cate_edit.html","Admin\ArticleController@article_cate_edit")->name("article.article_cate_edit");
        Route::post("/article_cate_del.html","Admin\ArticleController@article_cate_del")->name("article.article_cate_del");
//        文章列表
        Route::get("/article_list.html","Admin\ArticleController@article_list")->name("article.article_list");
        Route::match(["get","post"],"/article_add.html","Admin\ArticleController@article_add")->name("article.article_add");
        Route::match(["get","post"],"/article_edit.html","Admin\ArticleController@article_edit")->name("article.article_edit");
        Route::post("/article_del.html","Admin\ArticleController@article_del")->name("article.article_del");
        Route::post("/fileupload.html","Admin\ArticleController@fileupload")->name("article.fileupload");

    });
//    视频管理
    Route::group(['prefix'=>'vod'],function(){
//        视频广告
        Route::get("/vod_ad_list.html","Admin\VodController@vod_ad_list")->name("vod.vod_ad_list");
        Route::match(["get","post"],"/vod_ad_add.html","Admin\VodController@vod_ad_add")->name("vod.vod_ad_add");
        Route::match(["get","post"],"/vod_ad_edit.html","Admin\VodController@vod_ad_edit")->name("vod.vod_ad_edit");
        Route::post("/vod_ad_del.html","Admin\VodController@vod_ad_del")->name("vod.vod_ad_del");
//        剧情分类
        Route::get("/vod_plot_list.html","Admin\VodController@vod_plot_list")->name("vod.vod_plot_list");
        Route::match(["get","post"],"/vod_plot_add.html","Admin\VodController@vod_plot_add")->name("vod.vod_plot_add");
        Route::match(["get","post"],"/vod_plot_edit.html","Admin\VodController@vod_plot_edit")->name("vod.vod_plot_edit");
        Route::post("/vod_plot_del.html","Admin\VodController@vod_plot_del")->name("vod.vod_plot_del");
//        视频列表
        Route::get("/vod_list.html","Admin\VodController@vod_list")->name("vod.vod_list");
        Route::match(["get","post"],"/vod_add.html","Admin\VodController@vod_add")->name("vod.vod_add");
        Route::post("/vod_type.html","Admin\VodController@vod_type")->name("vod.vod_type");
        Route::post("/imgupload.html","Admin\VodController@imgupload")->name("vod.imgupload");
        Route::match(["get","post"],"/vod_edit.html","Admin\VodController@vod_edit")->name("vod.vod_edit");
        Route::post("/vod_del.html","Admin\VodController@vod_del")->name("vod.vod_del");
        Route::post("/vod_alldel.html","Admin\VodController@vod_alldel")->name("vod.vod_alldel");
        Route::post("/vod_allexamine.html","Admin\VodController@vod_allexamine")->name("vod.vod_allexamine"); //批量审核
        Route::post("/fileupload.html","Admin\VodController@fileupload")->name("vod.fileupload");
        Route::match(["get","post"],"/vod_search.html","Admin\VodController@vod_search")->name("vod.vod_search");
        Route::match(["post"],"/vod_same.html","Admin\VodController@vod_same")->name("vod.vod_same");
        Route::match(["get","post"],"/vod_group.html","Admin\VodController@vod_group")->name("vod.vod_group");
//        视频资源域名
        Route::get("/vod_domain_list.html","Admin\VodController@vod_domain_list")->name("vod.vod_domain_list");
        Route::match(["get","post"],"/vod_domain_add.html","Admin\VodController@vod_domain_add")->name("vod.vod_domain_add");
        Route::match(["get","post"],"/vod_domain_edit.html","Admin\VodController@vod_domain_edit")->name("vod.vod_domain_edit");
        Route::post("/vod_domain_del.html","Admin\VodController@vod_domain_del")->name("vod.vod_domain_del");


    });
    Route::group(['prefix'=>'sitemap'],function(){
        Route::match(["get","post"],"/index.html","Admin\SitemapController@index")->name("sitemap.index");
        Route::match(["get","post"],"/sore.html","Admin\SitemapController@sore")->name("sitemap.sore");
    });
});
Route::get("f_cadmin/login.html","Admin\LoginController@login")->name("admin.login.login");
Route::post("f_cadmin/dologin.html","Admin\LoginController@dologin")->name("admin.login.dologin");

