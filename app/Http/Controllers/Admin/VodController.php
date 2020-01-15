<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CheckVod;
use App\Http\Requests\CheckVod_ad;
use App\Http\Requests\CheckVod_domain;
use App\Http\Requests\CheckVod_plot;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class VodController extends BaseController
{
    /*
     * 剧情分类
     * */
    public function vod_plot_list(){
        $vod_plot_list=DB::table('vod_plot')->OrderBy('pid','asc')->join('columns', 'vod_plot.pid', '=', 'columns.id')
            ->select('vod_plot.*','columns.name as pidname')->paginate(15);
        return view('admin.vod.vod_plot_list',['vod_plot_list'=>$vod_plot_list]);
    }
    /*
     * 剧情分类添加
     * */
    public function vod_plot_add(CheckVod_plot $request){
        $cloumns=DB::table('columns')->where('pid','=','0')->get();
        if($request->isMethod('POST')){
            $data=$request->except('_token');
            $data['created_at']=date('Y-m-d H:i:s');
            $data['updated_at']=date('Y-m-d H:i:s');

            $res=DB::table('vod_plot')->insert($data);
            if($res==true){
                return response()->json(['code'=>200,'msg'=>'添加成功','url'=>route('admin.vod.vod_plot_list')]);
            }else{
                return response()->json(['code'=>500,'msg'=>'添加失败']);
            }
        }

        return view('admin.vod.vod_plot_add',['cloumns'=>$cloumns]);
    }
    /*
* 视频分类编辑
* */
    public function vod_plot_edit(CheckVod_ad $request){
        $cloumns=DB::table('columns')->where('pid','=','0')->get();
        $vod_plot=DB::table('vod_plot')->where('id',$request->id)->first();
        if($request->isMethod('POST')){
            $data=$request->except('_token','id');
            $data['created_at']=date('Y-m-d H:i:s');
            $data['updated_at']=date('Y-m-d H:i:s');
            $res=DB::table('vod_plot')->where('id',$request->id)->update($data);

            if($res==true){
                return response()->json(['code'=>200,'msg'=>'修改成功','url'=>route('admin.vod.vod_plot_list')]);
            }else{
                return response()->json(['code'=>500,'msg'=>'修改失败']);
            }
        }
        return view('admin.vod.vod_plot_edit',['vod_plot'=>$vod_plot,'cloumns'=>$cloumns]);
    }
    /*
 * 剧情分类删除
 * */
    public function vod_plot_del(Request $request){
        $res=DB::table('vod_plot')->where('id',$request->id)->delete();
        if($res==true){
            return response()->json(['code'=>200,'msg'=>'删除成功']);
        }else{
            return response()->json(['code'=>500,'msg'=>'删除失败']);
        }
    }
    /*
     * 视频列表
     * */
    public function vod_list(){
//        获取视频分类
        $columns=DB::table('columns')->get();
        $columns=self::makecolumn($columns);
        $year=DB::table('vod')->distinct()->select('release_time')->OrderBy('release_time','desc')->get();
        $vod_list=DB::table('vod')
            ->join('columns', 'vod.pid', '=', 'columns.id')
            ->join('vod_ad', 'vod.ad', '=', 'vod_ad.id')
            ->join('vod_domain', 'vod.domain', '=', 'vod_domain.id')
            ->select('vod.*','columns.name as pidname','vod_ad.name as vod_adname','vod_domain.domain')
            ->OrderBy('id','desc')
            ->paginate(15);

        return view('admin.vod.vod_list',['vod_list'=>$vod_list,'columns'=>$columns,'year'=>$year]);
    }
    /*
     * 分组
     * */
    public function vod_group(Request $request){
//        $columns=DB::table('columns')->get();
//        $columns=self::makecolumn($columns);
//        $year=DB::table('vod')->distinct()->select('release_time')->get();
////        DB::connection()->enableQueryLog();  // 开启QueryLog
//        $vod_list=DB::table('vod')
//            ->leftJoin('columns', 'vod.pid', '=', 'columns.id')
//            ->Join('vod_ad', 'vod.ad', '=', 'vod_ad.id')
//            ->select('vod.*','columns.name as pidname','vod_ad.name as vod_adname')
//            ->get();

//        $vod_list=DB::select('select `lv_vod`.*, `lv_columns`.`name` as `pidname`, `lv_vod_ad`.`name` as `vod_adname` from `lv_vod` inner join `lv_columns` on `lv_vod`.`pid` = `lv_columns`.`id` inner join `lv_vod_ad` on `lv_vod`.`ad` = `lv_vod_ad`.`id`  WHERE `lv_vod`.`name` IN(SELECT `lv_vod`.`name` from lv_vod GROUP BY `lv_vod`.`name` HAVING COUNT(*) >1)');
//        dd($vod_list);
//        return view('admin.vod.vod_group',['vod_list'=>$vod_list,'columns'=>$columns,'year'=>$year]);

//        =---
        if($request->isMethod('POST')){
            $repeatlen=$request->repeat;
            $repeat_field = '  ';
            $tmptab=',tmptable as `tmp` ';
            $tmpsql='create table IF NOT EXISTS `tmptable1` as (SELECT ' . $repeat_field . ' FROM lv_vod GROUP BY d_name1 HAVING COUNT(d_name1)>1)';
            $res=DB::select($tmpsql);
            dd($res);
            if($repeatlen>0){
                $repeat_field = ' left(d_name,'.$repeatlen.') as `d_name1` ';
            }
            else{
                $where .= ' AND d_name=`tmp`.d_name1 ';
            }
        }
        return view('admin.vod.vod_group');
    }
    /*
     * 视频添加
     * */
    public function vod_add(CheckVod $request){
        $vod_type=DB::table('columns')->get();
        $vod_type=self::makecolumn($vod_type);
//        dd($vod_type);
        $vod_ad=DB::table('vod_ad')->get();
        $vod_domain= DB::table('vod_domain')->get();
        if($request->isMethod('POST')){
            $data=$request->except('_token');
            if(!empty($data['type'])){
                $data['type']=$request->input('type');
            }else{
                return response()->json(['code'=>500,'msg'=>'标签不能为空']);
            }
            $vod=DB::table('vod')->where(array('name'=>$data['name'],'region'=>$data['region']))->first();
            if($vod){
                return response()->json(['code'=>500,'msg'=>'该视频名称已经存在，请换一个']);
            }
            $columns=DB::table('columns')->where('id','=',$data['pid'])->select('pid','id')->first();
            if($columns->pid==0){
                $data['pids']=$columns->id;
            }else{

                $data['pids']=$columns->pid;
            };
            $data['created_at']=date('Y-m-d H:i:s');
            $data['updated_at']=date('Y-m-d H:i:s');

            $res=DB::table('vod')->insert($data);
            if($res==true){
                return response()->json(['code'=>200,'msg'=>'添加成功','url'=>route('admin.vod.vod_list')]);
            }else{
                return response()->json(['code'=>500,'msg'=>'添加失败']);
            }
        }
        return view('admin.vod.vod_add',['vod_type'=>$vod_type,'vod_ad'=>$vod_ad,'vod_domain'=>$vod_domain]);
    }
    /*
     * 无线级
     * */
    public function makecolumn($data,$pid=0,$level=0){
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
    /*
* 视频编辑
* */
    public function vod_edit(CheckVod $request){
        $vod_type=DB::table('columns')->get();
        $vod_type=self::makecolumn($vod_type);
        $vod_ad=DB::table('vod_ad')->get();
        $vod_domain= DB::table('vod_domain')->get();
        $vod=DB::table('vod')->where('id',$request->id)->first();
        if($request->isMethod('POST')){
            $data=$request->except('_token','id');
            if(!empty($data['type'])){
                $data['type']=$request->input('type');
            }else{
                return response()->json(['code'=>500,'msg'=>'标签不能为空']);
            }

//            $data['created_at']=date('Y-m-d H:i:s');
            $data['updated_at']=date('Y-m-d H:i:s');
            if($data['thumb']!=$vod->thumb){
                // 删除旧图片
                $files=base_path('public').$vod->thumb;
                if(file_exists($files)){//判断文件是否存在
                    @unlink($files);
                }
            }
            $columns=DB::table('columns')->where('id','=',$data['pid'])->select('pid','id')->first();
            if($columns->pid==0){
                $data['pids']=$columns->id;
            }else{

                $data['pids']=$columns->pid;
            };
            $res=DB::table('vod')->where('id',$request->id)->update($data);
            if($res==true){
                return response()->json(['code'=>200,'msg'=>'修改成功','url'=>route('admin.vod.vod_list')]);
            }else{
                return response()->json(['code'=>500,'msg'=>'修改失败']);
            }
        }
        return view('admin.vod.vod_edit',['vod'=>$vod,'vod_type'=>$vod_type,'vod_ad'=>$vod_ad,'vod_domain'=>$vod_domain]);
    }
    /*
     * 视频删除
     * */
    public function vod_del(Request $request){
        $find=DB::table('vod')->where('id',$request->id)->first();
//        删除旧图片
        $files=base_path('public').$find->thumb;
        if(file_exists($files)){//判断文件是否存在
            @unlink($files);
        }
        $res=DB::table('vod')->where('id',$request->id)->delete();
        if($res==true){
            return response()->json(['code'=>200,'msg'=>'删除成功']);
        }else{
            return response()->json(['code'=>500,'msg'=>'删除失败']);
        }
    }
    /*
     * 视频批量删除
     * */
    public function vod_alldel(Request $request){
        $allid=explode( ',',$request->ids);
        $res=DB::table('vod')->whereIn('id',$allid)->delete();
        if($res==true){
            return response()->json(['code'=>200,'msg'=>'删除成功']);
        }else{
            return response()->json(['code'=>500,'msg'=>'删除失败']);
        }
    }
        /*
     * 批量审核
     * */
    public function vod_allexamine(Request $request){
        $allid=explode( ',',$request->ids);
        $res=DB::table('vod')->whereIn('id',$allid)->update(['status'=>0]);
        if($res!==false){
            return response()->json(['code'=>200,'msg'=>'批量审核成功']);
        }else{
            return response()->json(['code'=>500,'msg'=>'批量审核失败']);
        }
    }
    /*
     * 视频重复判断
     * */
    public function vod_same(Request $request){
        $res=DB::table('vod')->where(array('name'=>$request->samename,'region'=>$request->region))->first();
        if($res==true){
            return response()->json(['code'=>200,'msg'=>'该视频已存在']);
        }else{
            return response()->json(['code'=>500,'msg'=>'']);
        }
    }
    /*
     * 视频搜素
     * */
    public function vod_search(Request $request){
        $columns=DB::table('columns')->get();
        $columns=self::makecolumn($columns);
        $year=DB::table('vod')->distinct()->select('release_time')->OrderBy('release_time','desc')->get();


        $where = [];
        if ($request->filled('name')) {
            $where[] = ['vod.name','like','%'.$request['name'].'%'];
        }
        if ($request->filled('pid')) {
            $col=DB::table('columns')->where(array('id'=>$request['pid']))->first();
            if($col->pid==0){
                $where[] = ['vod.pids','=',$request['pid']];
            }else{
                $where[] = ['vod.pid','=',$request['pid']];
            }

        }
        if ($request->filled('release_time')) {
            $where[] = ['vod.release_time','=',$request['release_time']];
        }
        if ($request->filled('pid')) {
            $col2=DB::table('columns')->where(array('id'=>$request['pid']))->first();
            if($col2->pid==0){
                $vod_list=DB::table('vod')
                    ->where($where)
                    ->join('columns', 'vod.pids', '=', 'columns.id')
                    ->join('vod_ad', 'vod.ad', '=', 'vod_ad.id')
                    ->join('vod_domain', 'vod.domain', '=', 'vod_domain.id')
                    ->select('vod.*','columns.name as pidname','vod_ad.name as vod_adname','vod_domain.domain')
                    ->OrderBy('id','desc')
                    ->paginate(15);
            }else{
                $vod_list=DB::table('vod')
                    ->where($where)
                    ->join('columns', 'vod.pid', '=', 'columns.id')
                    ->join('vod_ad', 'vod.ad', '=', 'vod_ad.id')
                    ->join('vod_domain', 'vod.domain', '=', 'vod_domain.id')
                    ->select('vod.*','columns.name as pidname','vod_ad.name as vod_adname','vod_domain.domain')
                    ->OrderBy('id','desc')
                    ->paginate(15);
            }

        }else{
            $vod_list=DB::table('vod')
                ->where($where)
                ->join('columns', 'vod.pid', '=', 'columns.id')
                ->join('vod_ad', 'vod.ad', '=', 'vod_ad.id')
                ->join('vod_domain', 'vod.domain', '=', 'vod_domain.id')
                ->select('vod.*','columns.name as pidname','vod_ad.name as vod_adname','vod_domain.domain')
                ->OrderBy('id','desc')
                ->paginate(15);
        }
        return view('admin.vod.vod_list',['vod_list'=>$vod_list,'columns'=>$columns,'year'=>$year]);
    }
    /*
     * 视频类别获取
     * */
    public function vod_type(Request $request){
        $vod_ty=DB::table('columns')->where('id','=',$request->pid)->first();
        if($vod_ty->pid==0){
            $ids=$vod_ty->id;
        }else{
            $ids=$vod_ty->pid;
        };
        $vod_type=DB::table('vod_plot')->where('pid','=',$ids)->get();
        return response()->json(['code'=>200,'data'=>$vod_type]);
    }
    //
    /*
     * 视频广告
     * */
    public function vod_ad_list(){
        $vod_ad_list=DB::table('vod_ad')->OrderBy('id','desc')->paginate(15);
        return view('admin.vod.vod_ad_list',['vod_ad_list'=>$vod_ad_list]);
    }
    /*
     * 视频广告添加
     * */
    public function vod_ad_add(CheckVod_ad $request){
        if($request->isMethod('POST')){
            $data=$request->except('_token');
            $data['created_at']=date('Y-m-d H:i:s');
            $data['updated_at']=date('Y-m-d H:i:s');

            $res=DB::table('vod_ad')->insert($data);
            if($res==true){
                return response()->json(['code'=>200,'msg'=>'添加成功','url'=>route('admin.vod.vod_ad_list')]);
            }else{
                return response()->json(['code'=>500,'msg'=>'添加失败']);
            }
        }
        return view('admin.vod.vod_ad_add');
    }
    /*
 * 视频广告编辑
 * */
    public function vod_ad_edit(CheckVod_ad $request){
        $vod_ad=DB::table('vod_ad')->where('id',$request->id)->first();
        if($request->isMethod('POST')){
            $data=$request->except('_token','id');
            $data['created_at']=date('Y-m-d H:i:s');
            $data['updated_at']=date('Y-m-d H:i:s');
            //        删除旧图片
            $files=base_path('public').$vod_ad->url;
            if(file_exists($files)){//判断文件是否存在
                @unlink($files);
            }
            $res=DB::table('vod_ad')->where('id',$request->id)->update($data);
            if($res==true){
                return response()->json(['code'=>200,'msg'=>'修改成功','url'=>route('admin.vod.vod_ad_list')]);
            }else{
                return response()->json(['code'=>500,'msg'=>'修改失败']);
            }
        }
        return view('admin.vod.vod_ad_edit',['vod_ad'=>$vod_ad]);
    }
    /*
     * 视频广告删除
     * */
    public function vod_ad_del(Request $request){
        $find=DB::table('vod_ad')->where('id',$request->id)->first();
//        删除旧图片
        $files=base_path('public').$find->url;
        if(file_exists($files)){//判断文件是否存在
            @unlink($files);
        }
        $res=DB::table('vod_ad')->where('id',$request->id)->delete();
        if($res==true){
            return response()->json(['code'=>200,'msg'=>'删除成功']);
        }else{
            return response()->json(['code'=>500,'msg'=>'删除失败']);
        }
    }
    /*
     * 图片上传接口
     * */
    public function imgupload(Request $request){
        // 设置超时时间为没有限制
        ini_set("max_execution_time", "0");
        $file = $request->file('file');

        $allowed_extensions = ["png", "jpg", "gif", "jpeg", "bmp"];
        if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
            return json_encode(['error' => '只能上载png、jpg或gif、jpeg或bmp.']);
        }

        $destinationPath = 'uploads/vod/'.date('Ymd'); //public 文件夹下面建 storage/uploads 文件夹
        $extension = $file->getClientOriginalExtension();
        $fileName = md5(microtime(true)).'.'.$extension;
        $file->move($destinationPath, $fileName);

        return json_encode(['type' => $extension , 'url' => '/'.$destinationPath.'/'.$fileName , 'name' => $fileName]);

    }
    /*
     * 文件上传接口
     * */
    public function fileupload(Request $request){
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Content-type: text/html; charset=gbk32");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        $folder = $request->folder;
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            exit; // finish preflight CORS requests here
        }
        if ( !empty($_REQUEST[ 'debug' ]) ) {
            $random = rand(0, intval($_REQUEST[ 'debug' ]) );
            if ( $random === 0 ) {
                header("HTTP/1.0 500 Internal Server Error");
                exit;
            }
        }
        // header("HTTP/1.0 500 Internal Server Error");
        // exit;
        // 5 minutes execution time
        set_time_limit(5 * 60);
        // Uncomment this one to fake upload time
        usleep(5000);
        // Settings
        $targetDir = './uploads/vod_ad'.DIRECTORY_SEPARATOR.'file_material_tmp';            //存放分片临时目录
        if($folder){
            $uploadDir = './uploads/vod_ad'.DIRECTORY_SEPARATOR.'file_material'.DIRECTORY_SEPARATOR.$folder.DIRECTORY_SEPARATOR.date('Ymd');
        }else{
            $uploadDir = './uploads/vod_ad'.DIRECTORY_SEPARATOR.'file_material'.DIRECTORY_SEPARATOR.date('Ymd');    //分片合并存放目录
        }

        $cleanupTargetDir = true; // Remove old files
        $maxFileAge = 5 * 3600; // Temp file age in seconds

        // Create target dir
        if (!file_exists($targetDir)) {
            mkdir($targetDir,0777,true);
        }
        // Create target dir
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir,0777,true);
        }
        // Get a file name
        if (isset($_REQUEST["name"])) {
            $fileName = $_REQUEST["name"];
        } elseif (!empty($_FILES)) {
            $fileName = $_FILES["file"]["name"];
        } else {
            $fileName = uniqid("file_");
        }
        $oldName = $fileName;

        $fileName = iconv('UTF-8','gb2312',$fileName);
        $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;
        // $uploadPath = $uploadDir . DIRECTORY_SEPARATOR . $fileName;
        // Chunking might be enabled
        $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
        $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 1;
        // Remove old temp files
        if ($cleanupTargetDir) {
            if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory111."}, "id" : "id"}');
            }
            while (($file = readdir($dir)) !== false) {
                $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;
                // If temp file is current file proceed to the next
                if ($tmpfilePath == "{$filePath}_{$chunk}.part" || $tmpfilePath == "{$filePath}_{$chunk}.parttmp") {
                    continue;
                }
                // Remove temp file if it is older than the max age and is not the current file
                if (preg_match('/\.(part|parttmp)$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
                    unlink($tmpfilePath);
                }
            }
            closedir($dir);
        }
        // Open temp file
        if (!$out = fopen("{$filePath}_{$chunk}.parttmp", "wb")) {
            die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream222."}, "id" : "id"}');
        }
        if (!empty($_FILES)) {
            if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file333."}, "id" : "id"}');
            }
            // Read binary input stream and append it to temp file
            if (!$in = fopen($_FILES["file"]["tmp_name"], "rb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream444."}, "id" : "id"}');
            }
        } else {
            if (!$in = fopen("php://input", "rb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream555."}, "id" : "id"}');
            }
        }
        while ($buff = fread($in, 4096)) {
            fwrite($out, $buff);
        }
        fclose($out);
        fclose($in);
        rename("{$filePath}_{$chunk}.parttmp", "{$filePath}_{$chunk}.part");
        $index = 0;
        $done = true;
        for( $index = 0; $index < $chunks; $index++ ) {
            if ( !file_exists("{$filePath}_{$index}.part") ) {
                $done = false;
                break;
            }
        }

        if ($done) {
            $pathInfo = pathinfo($fileName);
            $hashStr = substr(md5($pathInfo['basename']),8,16);
            $hashName = time() . $hashStr . '.' .$pathInfo['extension'];
            $uploadPath = $uploadDir . DIRECTORY_SEPARATOR .$hashName;
            if (!$out = fopen($uploadPath, "wb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream666."}, "id" : "id"}');
            }
            //flock($hander,LOCK_EX)文件锁
            if ( flock($out, LOCK_EX) ) {
                for( $index = 0; $index < $chunks; $index++ ) {
                    if (!$in = fopen("{$filePath}_{$index}.part", "rb")) {
                        break;
                    }
                    while ($buff = fread($in, 4096)) {
                        fwrite($out, $buff);
                    }
                    fclose($in);
                    unlink("{$filePath}_{$index}.part");
                }
                flock($out, LOCK_UN);
            }
            fclose($out);
            $response = [
                'success'=>true,
                'oldName'=>$oldName,
                'filePath'=>str_replace('\\','/',substr($uploadPath,1)),
//                'fileSize'=>$data['size'],
                'fileSuffixes'=>$pathInfo['extension'],          //文件后缀名
//                'file_id'=>$data['id'],
            ];
            return json_encode($response);
        }

        // Return Success JSON-RPC response
        die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');
    }
    /*
     * 视频资源域名
     * */
    /*
     * 视频资源域名
     * */
    public function vod_domain_list(){
        $vod_domain= DB::table('vod_domain')->paginate(15);
        return view('admin.vod.vod_domain_list',['vod_domain'=>$vod_domain]);
    }
    /*
     * 视频资源域名添加
     * */
    public function vod_domain_add(CheckVod_domain $request){
        if($request->isMethod('POST')){
            $data=$request->except('_token');
            $data['created_at']=date('Y-m-d H:i:s');
            $data['updated_at']=date('Y-m-d H:i:s');
            $res=DB::table('vod_domain')->insert($data);
            if($res==true){
                return response()->json(['code'=>200,'msg'=>'添加成功','url'=>route('admin.vod.vod_domain_list')]);
            }else{
                return response()->json(['code'=>500,'msg'=>'添加失败']);
            }
        }
        return view('admin.vod.vod_domain_add');
    }
    /*
     * 视频资源域名编辑
     * */
    public function vod_domain_edit(CheckVod_domain $request){

        $vod_domain_list=DB::table('vod_domain')->where('id',$request->vod_domain)->first();
        if($request->isMethod('POST')){
            $data=$request->except('_token');
            $data['updated_at']=date('Y-m-d H:i:s');
            $res=DB::table('vod_domain')->where('id',$request->id)->update($data);
            if($res==true){
                return response()->json(['code'=>200,'msg'=>'修改成功','url'=>route('admin.vod.vod_domain_list')]);
            }else{
                return response()->json(['code'=>500,'msg'=>'修改失败']);
            }
        }
        return view('admin.vod.vod_domain_edit',['vod_domain_list'=>$vod_domain_list]);
    }
    /*
     * 视频资源域名删除
     * */
    public function vod_domain_del(Request $request){
        $res=DB::table('vod_domain')->where('id',$request->id)->delete();
        if($res==true){
            return response()->json(['code'=>200,'msg'=>'删除成功']);
        }else{
            return response()->json(['code'=>500,'msg'=>'删除失败']);
        }
    }
}
