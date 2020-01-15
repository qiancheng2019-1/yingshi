@include("admin.public.header")
@section("title","视频广告添加")
<link rel="stylesheet" type="text/css" href="{{asset(__ADMIN__)}}/webuploader/webuploader.css">


<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>视频广告管理 <small>视频广告添加</small></h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <form role="form" method="post" id="myForm">
                                @csrf
                                <div class="form-group">
                                    <label>名称</label>
                                    <input type="text" name="name" placeholder="名称" class="form-control" style="width: 40%;" required aria-required="true">
                                </div>
                                <div class="form-group">
                                    <label>描述</label>
                                    <input type="text" name="desc" placeholder="描述" class="form-control" style="width: 40%;" required aria-required="true">
                                </div>
                                <style>
                                    .webuploader-container {
                                        display: inline-block;
                                        float: left;
                                        margin-right: 10px;
                                        position: relative;
                                    }
                                    .webuploader-element-invisible {
                                        position: absolute !important;
                                        clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
                                        clip: rect(1px,1px,1px,1px);
                                    }
                                    .webuploader-pick {
                                        position: relative;
                                        display: inline-block;
                                        cursor: pointer;
                                        background: #00b7ee;
                                        padding: 6px 15px;
                                        color: #fff;
                                        text-align: center;
                                        border-radius: 3px;
                                        overflow: hidden;
                                    }
                                    .webuploader-pick-hover {
                                        background: #00a2d4;
                                    }

                                    .webuploader-pick-disable {
                                        opacity: 0.6;
                                        pointer-events:none;
                                    }


                                </style>
                                <div class="form-group">
                                    <label>广告文件</label>
                                    <div id="uploadfile" class="layui-input-inline">
                                        <div id="the_2655" class="uploader-list btns"></div>
                                        <div id="pick_2655">选择文件</div>
                                        <a id="Btn_2655" class="btn btn-default">开始上传</a>
                                    </div>
                                </div>
                                <div>
                                    <button class="btn btn-sm btn-primary pull-left m-t-n-xs" type="button" onclick="save()"><strong>添加</strong>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
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

            url:"{{route('admin.vod.vod_ad_add')}}",
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
    uploadfiles(2655,"files");
    //上传文件函数
    //ids唯一ID
    //folder文件保存目录
    function uploadfiles(ids,folder) {
        $(function(){
            var $list = $("#the_"+ids);
            $btn = $("#Btn_"+ids);
            var uploader = WebUploader.create({
                resize: false, // 不压缩image
                swf: '{{asset(__ADMIN__)}}/webuploader/Uploader.swf', // swf文件路径
                server: '{{route("admin.vod.fileupload")}}', // 文件接收服务端。
                pick: "#pick_"+ids, // 选择文件的按钮。可选
                chunked: true, //是否要分片处理大文件上传
                chunkSize:5*1024*1024, //分片上传，每片2M，默认是5M
                //fileSizeLimit: 6*1024* 1024 * 1024,    // 所有文件总大小限制 6G
                fileSingleSizeLimit: 10*1024* 1024 * 1024,    // 单个文件大小限制 5 G
                formData: {
                    _token:'{{ csrf_token() }}',
                    folder:folder  //自定义参数
                },
                fileNumLimit:1, //上传文件数量限制
                auto: false, //选择文件后是否自动上传
                chunkRetry : 2, //如果某个分片由于网络问题出错，允许自动重传次数
                runtimeOrder: 'html5,flash',
                accept: {
                  title: '视频文件',
                  extensions: 'm3u8,mp4',
                  mimeTypes: 'video/*'
                }
            });
            // 当有文件被添加进队列的时候
            uploader.on( 'fileQueued', function( file ) {
                $list.append( '<div id="' + file.id + '" class="item">' +
                    '<h4 class="info">' + file.name + '</h4>' +
                    '<p class="state">等待上传...</p>' +
                    '</div>' );
            });
            // 文件上传过程中创建进度条实时显示。
            uploader.on( 'uploadProgress', function( file, percentage ) {
                var $li = $( '#'+file.id ),
                    $percent = $li.find('.progress .progress-bar');

                // 避免重复创建
                if ( !$percent.length ) {
                    $percent = $('<div class="progress progress-striped active">' +
                        '<div class="progress-bar" role="progressbar" style="width: 0%">' +
                        '</div>' +
                        '</div>').appendTo( $li ).find('.progress-bar');
                }

                $li.find('p.state').text('上传中');

                $percent.css( 'width', percentage * 100 + '%' );
            });
            // 文件上传成功
            uploader.on( 'uploadSuccess', function( file,response) {
                $( '#'+file.id ).find('p.state').text('已上传');
                $list.append('<input type="hidden" name="url" value="'+response.filePath+'" />');
                console.log(response.filePath);
            });

            // 文件上传失败，显示上传出错
            uploader.on( 'uploadError', function( file ) {
                $( '#'+file.id ).find('p.state').text('上传出错');
            });
            // 完成上传完
            uploader.on( 'uploadComplete', function( file ) {
                $( '#'+file.id ).find('.progress').fadeOut();
            });

            $btn.on('click', function () {
                if ($(this).hasClass('disabled')) {
                    return false;
                }
                uploader.upload();
                // if (state === 'ready') {
                //     uploader.upload();
                // } else if (state === 'paused') {
                //     uploader.upload();
                // } else if (state === 'uploading') {
                //     uploader.stop();
                // }
            });
        });
    }

</script>
