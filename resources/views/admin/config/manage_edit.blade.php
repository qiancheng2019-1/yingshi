@include("admin.public.header")
@section("title","网站设置")
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>管理员管理 <small>管理员编辑</small></h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <form role="form" method="post" id="myForm">
                                <input type="hidden" value="{{$manage->id}}" name="id">
                                <div class="form-group">
                                    <label>账号</label>
                                    <input type="text" name="username" placeholder="账号" class="form-control" style="width: 40%;" required aria-required="true" value="{{$manage->username}}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>真实姓名</label>
                                    <input type="text" name="realname" placeholder="真实姓名" class="form-control" style="width: 40%;" required aria-required="true" value="{{$manage->realname}}">
                                </div>
                                <div class="form-group">
                                    <label>密码</label>
                                    <input type="password" name="password" placeholder="密码" class="form-control" style="width: 40%;" required aria-required="true">
                                </div>
                                <div class="form-group">
                                    <label>确认密码</label>
                                    <input type="password" name="password_confirmation" placeholder="确认密码" class="form-control" style="width: 40%;" required aria-required="true">
                                </div>
                                <div class="form-group">
                                    <label>状态</label>
                                    <div class="radio radio-info radio-inline">
                                        <input type="radio" id="inlineRadio1" value="0" name="status" @if($manage->status==0) checked @endif>
                                        <label for="inlineRadio1"> 显示 </label>
                                    </div>
                                    <div class="radio radio-info radio-inline">
                                        <input type="radio" id="inlineRadio2" value="1" name="status" @if($manage->status==1) checked @endif>
                                        <label for="inlineRadio2"> 隐藏 </label>
                                    </div>
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

            url:"{{route('admin.config.manage_edit')}}",
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
