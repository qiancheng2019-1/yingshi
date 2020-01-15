@include("admin.public.header")
@section("title","剧情分类添加")
<link rel="stylesheet" type="text/css" href="{{asset(__ADMIN__)}}/webuploader/webuploader.css">


<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>剧情分类管理 <small>剧情分类添加</small></h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <form role="form" method="post" id="myForm">
                                <div class="form-group">
                                    <label>剧情名称</label>
                                    <input type="text" name="name" placeholder="剧情名称" class="form-control" style="width: 40%;" required aria-required="true">
                                </div>
                                <div class="form-group">
                                    <label>所属分类</label>
                                    <div class="input-group">
                                        <select  class="form-control" style=" width: 400px; padding-bottom: 0px; padding-top: 0px;" tabindex="2" name="pid">
                                            <option value="">请选择分类</option>
                                            @foreach($cloumns as $item)
                                                <option value="{{$item->id}}" hassubinfo="true">{{$item->name}}</option>
                                            @endforeach
                                        </select>
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

            url:"{{route('admin.vod.vod_plot_add')}}",
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
