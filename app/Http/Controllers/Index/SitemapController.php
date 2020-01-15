<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SitemapController extends BaseController
{
    //
    public function index() {
        $xml = $this->sitemap();
        $file = fopen('sitemap.xml', 'w');
        fwrite($file, $xml);
        fclose($file);
//        return redirect()->action('xxx@index')->with('success', __('common.success'));
    }

    private function sitemap() {
        $xml = '<?xml version="1.0" encoding="utf-8"?>'."\n";
        $xml .= '<urlset>'."\n";

        // 视频
        $vod=DB::table('Vod')->get();
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
