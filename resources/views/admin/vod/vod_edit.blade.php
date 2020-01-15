@include("admin.public.header")
@section("title","视频编辑")
<link rel="stylesheet" type="text/css" href="{{asset(__ADMIN__)}}/webuploader/webuploader.css">


<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>视频管理 <small>视频编辑</small></h5>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal" id="myForm">
                        <input type="hidden" value="{{$vod->id}}" name="id">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">名称：</label>
                                <div class="col-sm-9">
                                    <input type="text" placeholder="名称" class="form-control" name="name" value="{{$vod->name}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">别名：</label>
                                <div class="col-sm-9">
                                    <input type="text" placeholder="别名" class="form-control" name="alias" value="{{$vod->alias}}">
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
                                            <option value="{{$item->id}}" @if($item->id==$vod->pid) selected @endif>{{($item->level==0) ? "":"|"}}{{str_repeat("----",$item->level)}}{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">标签：</label>
                                <div class="col-sm-9">
                                    <input type="text" placeholder="标签" class="form-control" name="type" id="avalsss" value="{{$vod->type}}">
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
                                            <option value="{{$item->id}}" @if($item->id==$vod->ad) selected @endif>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">导演：</label>
                                <div class="col-sm-9">
                                    <input type="text" placeholder="导演" class="form-control" name="director" value="{{$vod->director}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">主演：</label>
                                <div class="col-sm-9">
                                    <input type="text" placeholder="主演" class="form-control" name="to_star" value="{{$vod->to_star}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">地区：</label>
                                <div class="col-sm-9">
                                    <input type="text" placeholder="地区" class="form-control" name="region" value="{{$vod->region}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">语言：</label>
                                <div class="col-sm-9">
                                    <input type="text" placeholder="语言" class="form-control" name="language" value="{{$vod->language}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">上映时间：</label>
                                <div class="col-sm-9">
                                    <input type="text" placeholder="上映时间" class="form-control" name="release_time" value="{{$vod->release_time}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">片长：</label>
                                <div class="col-sm-9">
                                    <input type="text" placeholder="片长" class="form-control" name="film_length" value="{{$vod->film_length}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">总播放量：</label>
                                <div class="col-sm-9">
                                    <input type="text" placeholder="总播放量" class="form-control" name="broadcast" value="{{$vod->broadcast}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">总评分数：</label>
                                <div class="col-sm-9">
                                    <input type="text" placeholder="总评分数" class="form-control" name="score"  value="{{$vod->score}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">评分次数：</label>
                                <div class="col-sm-9">
                                    <input type="text" placeholder="评分次数" class="form-control" name="count_score" value="{{$vod->count_score}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">状态：</label>
                                <div class="col-sm-9">
                                    <div class="radio radio-info radio-inline">
                                        <input type="radio" id="inlineRadio1" value="0" name="status" @if($vod->status==0) checked @endif>
                                        <label for="inlineRadio1"> 显示 </label>
                                    </div>
                                    <div class="radio radio-info radio-inline">
                                        <input type="radio" id="inlineRadio2" value="1" name="status" @if($vod->status==1) checked @endif>
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
                                        <input type="radio" id="stop1" value="0" name="stop" @if($vod->stop==0) checked @endif>
                                        <label for="stop1"> 否 </label>
                                    </div>
                                    <div class="radio radio-info radio-inline">
                                        <input type="radio" id="stop2" value="1" name="stop" @if($vod->stop==1) checked @endif>
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
                                        <input type="text" id="vod_douban_id" name="vod_douban_id" style="width: 100px; float: left;" class="form-control" value="{{$vod->vod_douban_id}}">
                                        <a href="javascript:;" id="vod_douban_caiji" style=" padding-top: 6px; margin-left: 4px; display: inline-block;">获取资料</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">视频封面：</label>
                                <div class="col-sm-9">
                                    <input type="text" id="thumb" name="thumb" value="{{$vod->thumb}}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-sm-1 control-label">剧情介绍：</label>
                                <div class="col-sm-11">
                                    <textarea name="desc" id="" cols="30" rows="3" placeholder="剧情介绍" class="form-control"><?php echo strip_tags(htmlspecialchars_decode($vod->desc));?></textarea>
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
                                            <option value="{{$item->id}}" @if($item->id ==$vod->domain) selected @endif>{{$item->domain}}</option>
                                        @endforeach
                                    </select>
                                    <label class=" control-label" style="float: left;">&nbsp;&nbsp;格式：<span style=" color: red">名称</span>$$<span style=" color: red">播放地址</span>，多个请用<span style=" color: red">&&</span>分隔，并按<span>回车键</span></label>
                                    <div style="clear: both"></div>
                                    <textarea name="play_list" id="" cols="30" rows="10" placeholder="播放地址" class="form-control" style="margin-top: 10px;">{{$vod->play_list}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-1 col-sm-1">
                                <button class="btn btn-sm btn-primary" type="button" onclick="save()">保存</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url:"{{route('admin.vod.vod_type')}}",
        type:'post',
        data:{'pid':$('#chang_seleced').val()},
        datatype: "json",
        success:function(msg){
            console.log(msg.data)
            var datas=msg.data
            var html='';
            for (var o in datas){
                // console.log("text:"+datas[o].id+" value:"+datas[o].name );
                html+='<a href="javascript:;" data-id="avalsss" class="dja">'+datas[o].name+'</a>&nbsp;&nbsp;';
            }
            $('#type').html(html);


        },
        error:function () {
            layer.msg('网络错误', { icon:2});
        }
    })

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
                console.log(msg)
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

            url:"{{route('admin.vod.vod_edit')}}",
            type:'post',
            data:formData,
            timeout:0,
            datatype:'text',
            processData: false,
            contentType: false,
            success:function(msg){
                console.log(msg)
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

</script>

