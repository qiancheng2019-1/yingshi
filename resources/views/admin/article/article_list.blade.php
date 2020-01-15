@include("admin.public.header")
@section("title","文章分类")
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>文章管理</h5>
                </div>
                <div class="ibox-content">
                    <div class="">
                        <a href="{{route('admin.article.article_add')}}" class="btn btn-primary ">添加文章</a>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>编号</th>
                            <th>标题</th>
                            <th>缩略图</th>
                            <th>所属分类</th>
                            <th>添加时间</th>
                            <th>最近更新</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($article_list as $item)
                        <tr>
                            <td width="50px">{{$item->id}}</td>
                            <td><a href="{{route('article.detail',['id'=>$item->id])}}" target="_blank">{{$item->title}}</a></td>
                            <td><img src="{{$item->thumb}}" alt="" width="50px" height="50px"></td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->created_at}}</td>
                            <td>{{$item->updated_at}}</td>
                            <td>@if($item->status==0)<button type="button" class="btn btn-success btn-sm">正常</button>@else<button type="button" class="btn btn-default btn-sm">隐藏</button>@endif</td>
                            <td width="200px">
                                <a href="{{route('admin.article.article_edit',['id'=>$item->id])}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> 编辑</a>
                                <a href="javascript:;" onclick="article_del(this,'{{$item->id}}')" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> 删除</a>
                            </td>
                        </tr>
                        @endforeach
                        @if($article_list->isEmpty())
                            <tr><td colspan="8" style="text-align: center">Oh no! 暂无数据</td></tr>
                        @endif
                        </tbody>
                    </table>
                    <div class="pull-right">
                        {{ $article_list->links() }}
                    </div>
                    <div style="clear: both"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function article_del(obj,objid) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        layer.confirm('确定要删除么？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.ajax({
                url:"{{route('admin.article.article_del')}}",
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
