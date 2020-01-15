@include("admin.public.header")
@section("title","视频资源域名")
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>视频资源域名</h5>
                </div>
                <div class="ibox-content">
                    <div class="">
                        <a href="{{route('admin.vod.vod_domain_add')}}" class="btn btn-primary ">视频资源域名</a>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>编号</th>
                            <th>名称</th>
                            <th>域名</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($vod_domain as $item)
                            <tr>
                                <td width="50px">{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->domain}}</td>
                                <td width="200px">
                                    <a href="{{route('admin.vod.vod_domain_edit',['vod_domain'=>$item->id])}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> 编辑</a>
                                    <a href="javascript:;" onclick="vod_domain_del(this,'{{$item->id}}')" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> 删除</a>
                                </td>
                            </tr>
                        @endforeach
                        @if($vod_domain->isEmpty())
                            <tr><td colspan="3" style="text-align: center">Oh no! 暂无数据</td></tr>
                        @endif
                        </tbody>
                    </table>
                    <div class="pull-right">
                        {{ $vod_domain->links() }}
                    </div>
                    <div style="clear: both"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function vod_domain_del(obj,objid) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        layer.confirm('确定要删除么？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.ajax({
                url:"{{route('admin.vod.vod_domain_del')}}",
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
@include("admin.public.footer")
