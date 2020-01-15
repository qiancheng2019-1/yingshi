@include("admin.public.header")
@section("title","视频添加")
<link rel="stylesheet" type="text/css" href="{{asset(__ADMIN__)}}/webuploader/webuploader.css">


<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>视频管理 <small>视频添加</small></h5>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal" id="myForm">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">名称：</label>
                                <div class="col-sm-9">
                                    <input type="text" placeholder="名称" class="form-control samename" name="name" >
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">别名：</label>
                                <div class="col-sm-9">
                                    <input type="text" placeholder="别名" class="form-control" name="alias">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">视频分类：</label>
                                <div class="col-sm-9">
                                    <select class="form-control" style="padding-top: 0px; padding-bottom: 0px;" id="chang_seleced" name="pid">
                                        <option value="">选择分类</option>
                                        @foreach($vod_type as $item)
                                            <option value="{{$item->id}}">{{($item->level==0) ? "":"|"}}{{str_repeat("----",$item->level)}}{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-sm-1 control-label">标签：</label>
                                <div class="col-sm-3">
                                    <input type="text" placeholder="标签" class="form-control" name="type" id="avalsss">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-sm-1 control-label"></label>
                                <div class="col-sm-11" id="type">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">视频广告：</label>
                                <div class="col-sm-9">
                                    <select class="form-control" style="padding-top: 0px; padding-bottom: 0px;" id="chang_seleced" name="ad">
                                        @foreach($vod_ad as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">导演：</label>
                                <div class="col-sm-9">
                                    <input type="text" placeholder="导演" class="form-control" name="director">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">主演：</label>
                                <div class="col-sm-9">
                                    <input type="text" placeholder="主演" class="form-control" name="to_star">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">地区：</label>
                                <div class="col-sm-9">
                                    <input type="text" placeholder="地区" class="form-control region" name="region">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">语言：</label>
                                <div class="col-sm-9">
                                    <input type="text" placeholder="语言" class="form-control" name="language">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">上映时间：</label>
                                <div class="col-sm-9">
                                    <input type="text" placeholder="上映时间" class="form-control" name="release_time">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">片长：</label>
                                <div class="col-sm-9">
                                    <input type="text" placeholder="片长" class="form-control" name="film_length">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">总播放量：</label>
                                <div class="col-sm-9">
                                    <input type="text" placeholder="总播放量" class="form-control" name="broadcast" value="0">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">总评分数：</label>
                                <div class="col-sm-9">
                                    <input type="text" placeholder="总评分数" class="form-control" name="score" value="0">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">评分次数：</label>
                                <div class="col-sm-9">
                                    <input type="text" placeholder="评分次数" class="form-control" name="count_score" value="0">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">状态：</label>
                                <div class="col-sm-9">
                                    <div class="radio radio-info radio-inline">
                                        <input type="radio" id="inlineRadio1" value="0" name="status" checked>
                                        <label for="inlineRadio1"> 显示 </label>
                                    </div>
                                    <div class="radio radio-info radio-inline">
                                        <input type="radio" id="inlineRadio2" value="1" name="status">
                                        <label for="inlineRadio2"> 隐藏 </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">完结：</label>
                                <div class="col-sm-9">
                                    <div class="radio radio-info radio-inline">
                                        <input type="radio" id="stop1" value="0" name="stop" checked>
                                        <label for="stop1"> 否 </label>
                                    </div>
                                    <div class="radio radio-info radio-inline">
                                        <input type="radio" id="stop2" value="1" name="stop">
                                        <label for="stop2"> 是 </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="clear: both"></div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">豆瓣ID值：</label>
                                <div class="col-sm-9">
                                        <input type="text" id="vod_douban_id" name="vod_douban_id" style="width: 100px; float: left;" class="form-control">
                                        <a href="javascript:;" id="vod_douban_caiji" style=" padding-top: 6px; margin-left: 4px; display: inline-block;">获取资料</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">视频封面：</label>
                                <div class="col-sm-9">
                                    <input type="text" id="thumb" name="thumb" class="form-control" placeholder="视频封面">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-sm-1 control-label">剧情介绍：</label>
                                <div class="col-sm-11">
                                    <textarea name="desc" id="desc" cols="30" rows="7" placeholder="剧情介绍" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-sm-1 control-label">播放地址：</label>
                                <div class="col-sm-11">
                                    <select name="domain" class="form-control" style=" width: 300px; float: left; padding-top: 0px; padding-bottom: 0px;">
                                        <option value="">选择资源域名</option>
                                        @foreach($vod_domain as $item)
                                        <option value="{{$item->id}}">{{$item->domain}}</option>
                                        @endforeach
                                    </select>
                                    <label class=" control-label" style="float: left;">&nbsp;&nbsp;格式：<span style=" color: red">名称</span>$$<span style=" color: red">播放地址</span>，多个请用<span style=" color: red">&&</span>分隔，并按<span>回车键</span></label>
                                    <div style="clear: both"></div>
                                    <textarea name="play_list" id="" cols="30" rows="10" placeholder="播放地址" class="form-control" style="margin-top: 10px;"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-1 col-sm-1">
                                <button class="btn btn-sm btn-primary" type="button" onclick="save()">添加</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#chang_seleced').change(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({

            url:"{{route('admin.vod.vod_type')}}",
            type:'post',
            data:{'pid':$('#chang_seleced').val()},
            timeout:0,
            datatype:'text',
            success:function(msg){
                // console.log(msg)
                var datas=msg.data
                var html='';
                for(var o in datas){
                    html+='<a href="javascript:;" data-id="avalsss" class="dja">'+datas[o].name+'</a>&nbsp;&nbsp;';
                }
                $('#type').html(html);

            },error:function () {
                layer.msg('网络错误', { icon:2});
            }
        });
    })

    function save() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // 获取页面已有的一个form表单
        var form = document.getElementById("myForm");
        // 用表单来初始化
        var formData = new FormData(form);

        $.ajax({

            url:"{{route('admin.vod.vod_add')}}",
            type:'post',
            data:formData,
            timeout:0,
            datatype:'text',
            processData:false,
            contentType:false,
            success:function(msg){
                // console.log(msg)
                if(msg.code==200){
                    layer.msg(msg.msg,{icon:1,time:3000}, function() {
                        window.location.href=msg.url
                    });

                }else{
                    layer.msg(msg.msg, { icon:2});
                }
            },error:function () {
                layer.msg('网络错误', { icon:2});
            }
        });

    }
</script>
@include("admin.public.footer")
<script>
    var $list = $("#fileList");   //这几个初始化全局的百度文档上没说明，好蛋疼
    var thumbnailWidth = 100;   //缩略图高度和宽度 （单位是像素），当宽高度是0~1的时候，是按照百分比计算，具体可以看api文档
    var thumbnailHeight = 100;
    var uploader = WebUploader.create({
        // 选完文件后，是否自动上传。
        auto: true,
        formData: {
            // 这里的token是外部生成的长期有效的，如果把token写死，是可以上传的。
            _token:'{{ csrf_token() }}'
        },
        // swf文件路径
        swf: '{{asset(__ADMIN__)}}/webuploader/Uploader.swf', //加载swf文件，路径一定要对
        // 文件接收服务端。
        server: '{{route("admin.vod.imgupload")}}',
        // 选择文件的按钮。可选。
        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
        pick: {
            id : '#filePicker',
            multiple : false
        },
        // 只允许选择图片文件。
        accept: {
            title: 'Images',
            extensions: 'gif,jpg,jpeg,bmp,png',
            mimeTypes: 'image/'
        }
    });
    // 文件上传过程中创建进度条实时显示。
    uploader.on( 'uploadProgress', function( file, percentage ) {
        var $li = $( '#'+file.id ),$percent = $li.find('.progress span');

        // 避免重复创建
        if ( !$percent.length ) {
            $percent = $('<p class="progress"><span></span></p>').appendTo( $li ).find('span');
        }

        $percent.css( 'width', percentage * 100 + '%' );
    });

    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
    uploader.on( 'uploadSuccess', function(file,response) {
        var imgurl = response.url;
        $('#thumb_img').attr('src',imgurl);
        $('#thumb').val(imgurl);
        $('#show_img').css('display','block');

        $( '#'+file.id ).addClass('upload-state-done');
    });

    // 文件上传失败，显示上传出错。
    uploader.on( 'uploadError', function(file,response) {
        var fileerror = response.error;

        var $li = $( '#'+file.id ),$error = $li.find('div.error');

        // 避免重复创建
        if ( !$error.length ) {
            $error = $('<div class="error"></div>').appendTo( $li );
        }

        $error.text('上传失败'+fileerror);
    });

    // 完成上传完了，成功或者失败，先删除进度条。
    uploader.on( 'uploadComplete', function( file ) {
        $( '#'+file.id ).find('.progress').remove();
    });
</script>
<script>
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
</script>
<script>
    // 豆瓣资料获取
    $('#vod_douban_caiji').on('click', function(){
        $id = $('#vod_douban_id').val();
        if($id > 10000){
            // $(this).html('请稍等...');
            $.ajax({
                type: "get",
                async: false,
                url: "http://cdn.feifeicms.co/server/v3/douban.php?key=&id="+$id,
                dataType: "jsonp",
                jsonp: "callback",
                jsonpCallback:"DouBan",
                timeout: 5000,
                success: function(json){
                    console.log(json)
                    if(json.status == 200){
                        $(this).html('重新获取');
                        if(json.data.vod_name){
                            $('input[name="name"]').val(json.data.vod_name);
                        }
                        if(json.data.vod_title){
                            $('input[name="alias"]').val(json.data.vod_title);
                        }
                        if(json.data.vod_year){
                            $('input[name="release_time"]').val(json.data.vod_year);
                        }
                        if(json.data.vod_language){
                            $('input[name="language"]').val(json.data.vod_language);
                        }
                        if(json.data.vod_area){
                            $('input[name="region"]').val(json.data.vod_area);
                        }
                        if(json.data.vod_type){
                            $('#avalsss').val(json.data.vod_type);
                        }
                        if(json.data.vod_actor){
                            $('input[name="to_star"]').val(json.data.vod_actor);
                        }
                        if(json.data.vod_director){
                            $('input[name="director"]').val(json.data.vod_director);
                        }
                        if(json.data.vod_length){
                            $('input[name="film_length"]').val(json.data.vod_length*60);
                        }
                        if(json.data.vod_content){
                            $('#desc').val(json.data.vod_content);
                        }
                        if(json.data.vod_douban_score){
                            $('input[name="score"]').val(json.data.vod_douban_score);
                        }
                    }else{
                        alert(json.error);
                    }
                },
                error: function(){
                    alert('请求解析服务器失败。');
                }
            });
        }else{
            alert('请先填写该视频对应的豆瓣的ID。');

        }
    });


    $('.region').blur(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({

            url:"{{route('admin.vod.vod_same')}}",
            type:'post',
            data:{'samename':$('.samename').val(),'region':$('.region').val()},
            timeout:0,
            datatype:'text',
            success:function(msg){
                // console.log(msg)
                if(msg.code==200){
                    layer.tips(msg.msg, '.region', {
                        tips: [1, '#3595CC'],
                        time: 4000
                    });
                }
            },error:function () {
                layer.msg('网络错误', { icon:2});
            }
        });
    })

    //默认选项点击选择
    $(document).on("click", ".dja", function(){
            $id = $(this).attr('data-id');
            $val = $("input[id='"+$id+"']").val();
            if($val == ''){
                $val = $(this).text();
            }else{
                $val = $val+','+$(this).text();
                $val = $val.split(',')
                $val = unique($val);//排重
            }

            $("input[id='"+$id+"']").val($val);
    });
    // 数组去重
    function unique(arr){
        var arr2 = arr.sort();
        var res = [arr2[0]];

        for(var i=1;i<arr2.length;i++){
            if(arr2[i] !== res[res.length-1]){
                res.push(arr2[i]);
            }
        }
        return res;
    }
</script>
