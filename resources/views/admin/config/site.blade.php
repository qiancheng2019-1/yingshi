@include("admin.public.header")
@section("title","网站设置")
<link rel="stylesheet" type="text/css" href="{{asset(__ADMIN__)}}/webuploader/webuploader.css">
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>系统设置 <small>网站设置</small></h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <form role="form" method="post" action="" id="myForm">
                                <input type="hidden" name="name" value="siteconfig">
                                <input type="hidden" name="title" value="网站配置">
                                <div class="form-group">
                                    <label>网站logo（175px*81px）</label>
                                    <div id="uploader-demo">
                                        <div id="fileList" class="uploader-list"></div>
                                        <div id="filePicker">选择图片</div>
                                    </div>
                                    <div id="show_img" @if(isset($config['logo'])) style="display: block" @else style="display: none" @endif>
                                        <img id="logo_img" src="{{isset($config['logo']) ? $config['logo']:''}}" alt="图片" height="50px" width="100px">
                                    </div>
                                    <input type="hidden" id="logo" name="logo" value="{{isset($config['logo']) ? $config['logo']:''}}">
                                </div>
                                <div class="form-group">
                                    <label>网站icon（81px*81px）</label>
                                    <div id="uploader-demo">
                                        <div id="iconList" class="icon-list"></div>
                                        <div id="iconPicker">选择图片</div>
                                    </div>
                                    <div id="show_icon" @if(isset($config['icon'])) style="display: block" @else style="display: none" @endif>
                                        <img id="icon_img" src="{{isset($config['icon']) ? $config['icon']:''}}" alt="图片" height="40px" width="40px">
                                    </div>
                                    <input type="hidden" id="icon" name="icon" value="{{isset($config['icon']) ? $config['icon']:''}}">
                                </div>
                                <div class="form-group">
                                    <label>系统名称</label>
                                    <input type="text" name="cmstitle" placeholder="系统名称" class="form-control" style="width: 40%;" required aria-required="true" value="{{isset($config['cmstitle']) ? $config['cmstitle']:''}}">
                                </div>
                                <div class="form-group">
                                    <label>网站名称</label>
                                    <input type="text" name="sitetitle" placeholder="网站名称" class="form-control" style="width: 40%;" required aria-required="true" value="{{isset($config['sitetitle']) ? $config['sitetitle']:''}}">
                                </div>
                                <div class="form-group">
                                    <label>网站SEO标题</label>
                                    <input type="text" name="seotitle" placeholder="网站SEO标题" class="form-control" style="width: 40%;" required aria-required="true" value="{{isset($config['seotitle']) ? $config['seotitle']:''}}">
                                </div>
                                <div class="form-group">
                                    <label>网站SEO关键词</label>
                                    <input type="text" name="keyword" placeholder="网站SEO关键词" class="form-control" style="width: 40%;" required aria-required="true" value="{{isset($config['keyword']) ? $config['keyword']:''}}">
                                </div>
                                <div class="form-group">
                                    <label>网站SEO描述</label>
                                    <textarea name="desc" id="" class="form-control" placeholder="网站SEO描述" required aria-required="true" style="width: 40%;" >{{isset($config['desc']) ? $config['desc']:''}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>版权信息</label>
                                    <input type="text" name="copyright" placeholder="版权信息" class="form-control" style="width: 40%;" value="{{isset($config['copyright']) ? $config['copyright']:''}}">
                                </div>
                                <div class="form-group">
                                    <label>备案信息</label>
                                    <input type="text" name="icp" placeholder="备案信息" class="form-control" style="width: 40%;" value="{{isset($config['icp']) ? $config['icp']:''}}">
                                </div>
                                <div class="form-group">
                                    <label>联系方式</label>
                                    <input type="text" name="tel" placeholder="联系方式" class="form-control" style="width: 40%;"value="{{isset($config['tel']) ? $config['tel']:''}}" >
                                </div>
                                <!--<div class="form-group">-->
                                <!--    <label>资源域名</label>-->
                                <!--    <input type="text" name="domain" placeholder="资源域名" class="form-control" style="width: 40%;"value="{{isset($config['domain']) ? $config['domain']:''}}" >-->
                                <!--</div>-->
                                <div class="form-group">
                                    <label>站点状态</label>
                                    <div class="radio radio-info radio-inline">
                                        @if(isset($config['status']))
                                        <input type="radio" id="inlineRadio1" value="0" name="status" {{($config['status']==0) ? 'checked':''}}>
                                        @else
                                        <input type="radio" id="inlineRadio1" value="0" name="status" checked>
                                        @endif
                                        <label for="inlineRadio1"> 开启 </label>
                                    </div>
                                    <div class="radio radio-info radio-inline">
                                        @if(isset($config['status']))
                                            <input type="radio" id="inlineRadio2" value="1" name="status" {{($config['status']==1) ? 'checked':''}}>
                                        @else
                                            <input type="radio" id="inlineRadio2" value="1" name="status">
                                        @endif
                                        <label for="inlineRadio2"> 关闭 </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>接口调用</label>
                                    <div class="radio radio-info radio-inline">
                                        @if(isset($config['api']))
                                            <input type="radio" id="api1" value="0" name="api" {{($config['api']==0) ? 'checked':''}}>
                                        @else
                                            <input type="radio" id="api1" value="0" name="api" checked>
                                        @endif
                                        <label for="api1"> 开启 </label>
                                    </div>
                                    <div class="radio radio-info radio-inline">
                                        @if(isset($config['api']))
                                            <input type="radio" id="api2" value="1" name="api" {{($config['api']==1) ? 'checked':''}}>
                                        @else
                                            <input type="radio" id="api2" value="1" name="api">
                                        @endif
                                        <label for="api2"> 关闭 </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>视频广告</label>
                                    <div class="radio radio-info radio-inline">
                                        @if(isset($config['ad']))
                                            <input type="radio" id="ad1" value="0" name="ad" {{($config['ad']==0) ? 'checked':''}}>
                                        @else
                                            <input type="radio" id="ad1" value="0" name="ad" checked>
                                        @endif
                                        <label for="ad1"> 开启 </label>
                                    </div>
                                    <div class="radio radio-info radio-inline">
                                        @if(isset($config['ad']))
                                            <input type="radio" id="ad2" value="1" name="ad" {{($config['ad']==1) ? 'checked':''}}>
                                        @else
                                            <input type="radio" id="ad2" value="1" name="ad">
                                        @endif
                                        <label for="ad2"> 关闭 </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>统计代码</label>
                                    <textarea name="cnzz" id="" class="form-control" style="width: 40%;" >{{isset($config['sitetitle']) ? $config['cnzz']:''}}</textarea>
                                </div>
                                <div>
                                    <button class="btn btn-sm btn-primary pull-left m-t-n-xs" type="button" onclick="save()"><strong>保存</strong>
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

           url:"{{route('admin.config.sore')}}",
           type:'post',
           data:formData,
           timeout:0,
           datatype:'text',
           processData: false,
           contentType: false,
           success:function(msg){
               // alert(msg.msg)
               if(msg.code==200){
                   layer.msg(msg.msg,{icon:1,time:3000});
               }else{
                   layer.msg(msg.msg, { icon:2});
               }
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
        server: '{{route("admin.config.fileupload")}}',
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
        $('#logo_img').attr('src',imgurl);
        $('#logo').val(imgurl);
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
    var $list = $("#iconList");   //这几个初始化全局的百度文档上没说明，好蛋疼
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
        server: '{{route("admin.config.fileupload")}}',
        // 选择文件的按钮。可选。
        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
        pick: {
            id : '#iconPicker',
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
        $('#icon_img').attr('src',imgurl);
        $('#icon').val(imgurl);
        $('#show_icon').css('display','block');

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
