@include("admin.public.header")
@section("title","网站设置")
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>栏目管理</h5>
                </div>
                <div class="ibox-content">
                    @if(session()->has("msg"))
                        <div class="alert alert-warning alert-dismissable">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            {{ session("msg") }}.
                        </div>
                    @endif
                    <div class="">
                        <a href="{{route('admin.config.column_add')}}" class="btn btn-primary ">添加栏目</a>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>编号</th>
                            <th>名称</th>
                            <th>排序</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($column_list as $item)
                                <tr>
                                    <td width="50px">{{$item->id}}</td>
                                    <td>{{($item->level==0) ? "":"|"}}{{str_repeat("----",$item->level)}}{{$item->name}}</td>
                                    <td width="50px">{{$item->sort}}</td>
                                    <td width="50px">@if($item->status==0)<button type="button" class="btn btn-success btn-sm">正常</button>@else<button type="button" class="btn btn-default btn-sm">隐藏</button>@endif</td>
                                    <td width="200px">
                                        <a href="{{route('admin.config.column_edit',['id'=>$item->id])}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> 编辑</a>
                                        <a href="{{route('admin.config.column_del',['id'=>$item->id])}}" onclick="return confirm('你确定要删除么？');"  class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> 删除</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

@include("admin.public.footer")
