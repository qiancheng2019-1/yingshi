@include("admin.public.header")
@section("title","网站设置")
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>栏目管理 <small>栏目编辑</small></h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12">
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-warning alert-dismissable">
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                        {{ $error }}.
                                    </div>
                                @endforeach
                            @endif
                            @if(session()->has("msg"))
                                <div class="alert alert-warning alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    {{ session("msg") }}.
                                </div>
                            @endif
                            <form role="form" method="post" action="">
                                @csrf
                                <div class="form-group">
                                    <label>栏目名称</label>
                                    <input type="text" name="name" placeholder="栏目名称" class="form-control" style="width: 40%;" required aria-required="true" value="{{$columns->name}}">
                                </div>
                                <div class="form-group">
                                    <label>所属栏目</label>
                                    <div class="input-group">
                                        <select  class="form-control" style=" width: 400px; height: 40px;" tabindex="2" name="pid">
                                            <option value="0">顶级栏目</option>
                                            @foreach($column_list as $item)
                                            <option value="{{$item->id}}" hassubinfo="true" {{($item->id == $columns->pid) ? "selected='selected'":""}}>{{($item->level==0) ? "":"|"}}{{str_repeat("----",$item->level)}}{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>栏目排序</label>
                                    <input type="text" name="sort" placeholder="排序" class="form-control" style="width: 40%;" required aria-required="true" value="{{$columns->sort}}">
                                </div>
                                <div class="form-group">
                                    <label>状态</label>
                                    <div class="radio radio-info radio-inline">
                                        <input type="radio" id="inlineRadio1" value="0" name="status" {{($columns->status==0) ? "checked":""}}>
                                        <label for="inlineRadio1"> 显示 </label>
                                    </div>
                                    <div class="radio radio-info radio-inline">
                                            <input type="radio" id="inlineRadio2" value="1" name="status" {{($columns->status==1) ? "checked":""}}>
                                        <label for="inlineRadio2"> 隐藏 </label>
                                    </div>
                                </div>
                                <div>
                                    <button class="btn btn-sm btn-primary pull-left m-t-n-xs" type="submit"><strong>保存</strong>
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
@include("admin.public.footer")
