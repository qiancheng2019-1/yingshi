@include("admin.public.header")
@section("title","视频分类")
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>视频管理</h5>
                </div>
                <div class="ibox-content">
                    <div class="col-sm-3">
                        <a href="{{route('admin.vod.vod_add')}}" class="btn btn-primary ">添加视频</a>
                        <a href="{{route('admin.vod.vod_group')}}" class="btn btn-success ">检测重复数据</a>
                        <a href="javascript:;" class="btn btn-danger " onclick="alldel()">批量删除</a>
                    </div>
                    <form action="{{route('admin.vod.vod_group')}}" method="post">
                        @csrf
                        <label for="">检测名称长度：</label>
                        <input type="text" name="repeat">
                        <button type="submit">检测重复数据</button>
                        <span>长度为0时检测全字匹配</span>
                    </form>

                    <div style="clear: both"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function vod_del(obj,objid) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        layer.confirm('确定要删除么？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.ajax({
                url:"{{route('admin.vod.vod_del')}}",
                type:'post',
                data:{"id":objid},
                timeout:0,
                datatype:'text',
                success:function(msg){
                    if(msg.code==200){
                        layer.msg(msg.msg,{icon:1,time:2000},function () {
                            location.reload();
                        });
                    }else{
                        layer.msg(msg.msg, { icon:2});
                    }
                }
            });
        }, function(){

        });

    }
</script>
<script>
    //全选
    function ckAll(){
        var flag=document.getElementById("allChecks").checked;
        var cks=document.getElementsByName("ids");
        for(var i=0;i<cks.length;i++){
            cks[i].checked=flag;
        }
    }
    function alldel(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        layer.confirm('确定要删除么？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            var cks=document.getElementsByName("ids");
            var str="";
            //拼接所有的图书id
            for(var i=0;i<cks.length;i++){
                if(cks[i].checked){
                    str+=cks[i].value+",";
                }
            }
            //去掉字符串末尾的‘&'
            var strs=str.substring(0, str.length-1);
            $.ajax({
                url:"{{route('admin.vod.vod_alldel')}}",
                type:'post',
                data:{"ids":strs},
                timeout:0,
                datatype:'text',
                success:function(msg){
                    if(msg.code==200){
                        layer.msg(msg.msg,{icon:1,time:2000},function () {
                            location.reload();
                        });
                    }else{
                        layer.msg(msg.msg, { icon:2});
                    }
                }
            });
        }, function(){

        });
    }
</script>
@include("admin.public.footer")
