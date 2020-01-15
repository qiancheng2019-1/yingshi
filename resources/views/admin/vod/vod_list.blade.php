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
                        <!--<a href="{{route('admin.vod.vod_group')}}" class="btn btn-success ">检测重复数据</a>-->
                         <a href="javascript:;" class="btn btn-success " onclick="allexamine()">批量审核</a>
                        <a href="javascript:;" class="btn btn-danger " onclick="alldel()">批量删除</a>
                    </div>
                    <form action="{{route('admin.vod.vod_search')}}" method="post">
                        @csrf
                    <div class="col-sm-2">
                        <div class="input-group">
                            <div class="input-group m-b"><span class="input-group-addon">视频分类</span>
                                <select name="pid" id=""class="form-control" style="padding-top: 0px; padding-bottom: 0px;">
                                    <option value="">选择视频分类</option>
                                    @foreach($columns as $item)
                                    <option value="{{$item->id}}">{{($item->level==0) ? "":"|"}}{{str_repeat("----",$item->level)}}{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="input-group">
                            <div class="input-group m-b"><span class="input-group-addon">上映时间</span>
                                <select name="release_time" id=""class="form-control" style="padding-top: 0px; padding-bottom: 0px;">
                                    <option value="">选择上映时间</option>
                                    @foreach($year as $item)
                                        <option value="{{$item->release_time}}">{{$item->release_time}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="input-group">
                            <input type="text" placeholder="请输入视频名称" class="input-sm form-control" name="name"> <span class="input-group-btn">
                            <button type="submit" class="btn btn-sm btn-primary"> 搜索</button> </span>
                        </div>
                    </div>
                    </form>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th><input type="checkbox" class="i-checks" id="allChecks"  onclick="ckAll()" ></th>
                            <th>编号</th>
                            <th>名称</th>
                            <th>别名</th>
                            <th>视频封面</th>
                            <th>类型</th>
                            <th>所属广告</th>
                            <th>总播放量</th>
                            <th>上映时间</th>
                            <th>添加时间</th>
                            <th>最近更新</th>
                            <th>完结</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($vod_list as $item)
                        <tr>
                            <td>
                                <input type="checkbox" class="i-checks" name="ids" value="{{$item->id}}">
                            </td>
                            <td width="50px">{{$item->id}}</td>
                            <td><a href="{{route('vod.detail',['id'=>$item->id,'p'=>0])}}" title="预览" target="_blank">{{$item->name}}</a></td>
                            <td>{{$item->alias}}</td>
                            <td><img src="{{$item->domain}}{{$item->thumb}}00.jpg" alt="" width="50px" height="70px"></td>
                            <td>{{$item->pidname}}</td>
                            <td>{{$item->vod_adname}}</td>
                            <td>{{$item->red}}</td>
                            <td>{{$item->release_time}}</td>
                            <td>{{$item->created_at}}</td>
                            <td>{{$item->updated_at}}</td>
                            <td>@if($item->stop==1)<button type="button" class="btn btn-warning btn-sm">是</button>@else<button type="button" class="btn btn-default btn-sm">否</button>@endif</td>
                            <td>@if($item->status==0)<button type="button" class="btn btn-success btn-sm">正常</button>@else<button type="button" class="btn btn-default btn-sm">隐藏</button>@endif</td>
                            <td width="200px">
                                <a href="{{route('admin.vod.vod_edit',['id'=>$item->id])}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> 编辑</a>
                                <a href="javascript:;" onclick="vod_del(this,'{{$item->id}}')" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> 删除</a>
                            </td>
                        </tr>
                        @endforeach
                        @if($vod_list->isEmpty())
                            <tr><td colspan="13" style="text-align: center">Oh no! 暂无数据</td></tr>
                        @endif
                        </tbody>
                    </table>
                    <div class="pull-right">
                    	<ul class="pagination">
                           <li> <span class="tottol">共  {{$vod_list->total()}} 条数据 </span></li>
                        </ul>
                        {{ $vod_list->appends(Request::all())->links() }}
                    </div>
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
    //批量审核
    function allexamine (){
        layer.confirm('确定要批量修改状态么？', {
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
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:"{{route('admin.vod.vod_allexamine')}}",
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
