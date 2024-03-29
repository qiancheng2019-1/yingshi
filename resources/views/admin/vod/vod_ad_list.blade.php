@include("admin.public.header")
@section("title","视频广告分类")
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>视频广告管理</h5>
                </div>
                <div class="ibox-content">
                    <div class="">
                        <a href="{{route('admin.vod.vod_ad_add')}}" class="btn btn-primary ">添加视频广告</a>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>编号</th>
                            <th>名称</th>
                            <th>描述</th>
                            <th>地址</th>
                            <th>添加时间</th>
                            <th>最近更新</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($vod_ad_list as $item)
                        <tr>
                            <td width="50px">{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->desc}}</td>
                            <td>{{$item->url}}</td>
                            <td>{{$item->created_at}}</td>
                            <td>{{$item->updated_at}}</td>
                            <td width="200px">
                                <a href="{{route('admin.vod.vod_ad_edit',['id'=>$item->id])}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> 编辑</a>
                                <a href="javascript:;" onclick="vod_ad_del(this,'{{$item->id}}')" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> 删除</a>
                            </td>
                        </tr>
                        @endforeach
                        @if($vod_ad_list->isEmpty())
                            <tr><td colspan="7" style="text-align: center">Oh no! 暂无数据</td></tr>
                        @endif
                        </tbody>
                    </table>
                    <div class="pull-right">
                    	<ul class="pagination">
                           <li> <span class="tottol">共  {{$vod_ad_list->total()}} 条数据 </span></li>
                        </ul>
                        {{ $vod_ad_list->links() }}
                    </div>
                    <div style="clear: both"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function vod_ad_del(obj,objid) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        layer.confirm('确定要删除么？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.ajax({
                url:"{{route('admin.vod.vod_ad_del')}}",
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
