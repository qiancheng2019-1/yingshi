@include("admin.public.header")
@section("title","文章添加")
<!-- 配置文件 -->
<script type="text/javascript" src="{{asset(__ADMIN__)}}/ueditor/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="{{asset(__ADMIN__)}}/ueditor/ueditor.all.js"></script>
<link rel="stylesheet" type="text/css" href="{{asset(__ADMIN__)}}/webuploader/webuploader.css">


<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>文章管理 <small>文章添加</small></h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <form role="form" method="post" id="myForm">
                                @csrf
                                <div class="form-group">
                                    <label>标题</label>
                                    <input type="text" name="title" placeholder="标题" class="form-control" style="width: 40%;" required aria-required="true">
                                </div>
                                <div class="form-group">
                                    <label>所属分类</label>
                                <select class="form-control" name="article_cate" style=" width: 200px; height: 40px;">
                                    @foreach($article_cate as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                                </div>
                                <div class="form-group">
                                    <label>缩略图</label>
                                    <div id="uploader-demo">
                                        <div id="fileList" class="uploader-list"></div>
                                        <div id="filePicker">选择图片</div>
                                    </div>
                                    <div id="show_img" style="display:none;">
                                        <img id="thumb_img" src="" alt="图片" height="100px" width="100px">
                                    </div>
                                    <input type="hidden" id="thumb" name="thumb">
                                </div>
                                <div class="form-group">
                                    <label>状态</label>
                                    <div class="radio radio-info radio-inline">
                                        <input type="radio" id="inlineRadio1" value="0" name="status" checked>
                                        <label for="inlineRadio1"> 显示 </label>
                                    </div>
                                    <div class="radio radio-info radio-inline">
                                            <input type="radio" id="inlineRadio2" value="1" name="status">
                                        <label for="inlineRadio2"> 隐藏 </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>内容</label>
                                    <script id="content" type="text/plain" style="width:100%;height:500px;" name="content"></script>
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
<!-- 实例化编辑器 -->
<script type="text/javascript">
    var ue = UE.getEditor('content');
</script>
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

            url:"{{route('admin.article.article_add')}}",
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
        server: '{{route("admin.article.fileupload")}}',
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
