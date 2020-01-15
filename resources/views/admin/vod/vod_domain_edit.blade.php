@include("admin.public.header")
@section("title","网站设置")
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>文视频资源域名管理 <small>文视频资源域名编辑</small></h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <form role="form" method="post" id="myForm">
                                <input type="hidden" value="{{$vod_domain_list->id}}" name="id">
                                <div class="form-group">
                                    <label>名称</label>
                                    <input type="text" name="name" placeholder="名称" class="form-control" style="width: 40%;" required aria-required="true" value="{{$vod_domain_list->name}}">
                                </div>
                                <div class="form-group">
                                    <label>URL</label>
                                    <input type="text" name="domain" placeholder="URL" class="form-control" style="width: 40%;" required aria-required="true" value="{{$vod_domain_list->domain}}">
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

            url:"{{route('admin.vod.vod_domain_edit')}}",
            type:'post',
            data:formData,
            timeout:0,
            datatype:'text',
            processData: false,
            contentType: false,
            success:function(msg){
                // console.log(msg)
                if(msg.code==200){
                    layer.msg(msg.msg,{icon:1,time:2000}, function() {
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
</script>
@include("admin.public.footer")
