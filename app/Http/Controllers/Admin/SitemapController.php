<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SitemapController extends BaseController
{
    //
    /*
     * 更新网站地图
*/
    public function index(){
        return view('admin.sitemap.index');
    }
    /*
     * 一键更新
     * */
    public function sore(){

        $xml = $this->sitemap();
        $file = fopen('sitemap.xml', 'w');
        fwrite($file, $xml);
        fclose($file);
        $server='http://'.$_SERVER['SERVER_NAME'].'/sitemap.xml';
        return response()->json(['code'=>200,'msg'=>'成功生成网站地图','url'=>route('admin.sitemap.index'),'data'=>$server]);
    }
    private function sitemap() {
        $xml = '<?xml version="1.0" encoding="utf-8"?>'."\n";
        $xml .= '<urlset>'."\n";

        // 视频
        $vod=DB::table('vod')->get();
        foreach($vod as $data) {
            $xml .= $this->execute_xml('/vod/detail/'.$data->id)."\n";
        }

        $xml .= '</urlset>'."\n";
        return $xml;
    }


    private function execute_xml($url) {
        $xml_url = '<url>'."\n";
        $xml_url .= '<loc>http://'. $_SERVER['SERVER_NAME'] . $url.'.html' .'</loc>'."\n";
        $xml_url .= '<lastmod>'. date("Y-m-d", time()) .'</lastmod>'."\n";
        $xml_url .= '<changefreq>weekly</changefreq>'."\n";
        $xml_url .= '<priority>0.8</priority>'."\n";
        $xml_url .= '</url>'."\n";
        return $xml_url;
    }
}
