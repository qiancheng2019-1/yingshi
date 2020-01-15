@include("admin.public.header")
@section("title","网站地图")
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>网站地图 <small>更新网站地图</small></h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <form role="form" method="post" action="" id="myForm">
                                <div>
									<div style="clear:both"></div>
									<p><a href="" target="blank" class="sitemaolink"></a></p>
									<div style="clear:both"></div>
                                    <button class="btn btn-sm btn-primary pull-left m-t-n-xs" type="button" onclick="save()"><strong>一键更新</strong>
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

           url:"{{route('admin.sitemap.sore')}}",
           type:'post',
           data:formData,
           timeout:0,
           datatype:'text',
           processData: false,
           contentType: false,
           success:function(msg){
               // alert(msg.msg)
               if(msg.code==200){
				   $('.sitemaolink').attr('href',msg.data)
				   $('.sitemaolink').text(msg.data)
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
