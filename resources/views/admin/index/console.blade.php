@include("admin.public.header")
@section("title","主页")
<body class="gray-bg">
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row row-sm text-center">
                            <div class="col-xs-3">
                                <div class="panel padder-v item">
                                    <div class="h1 text-info font-thin h1">{{$cound['vod']}}</div>
                                    <span class="text-muted text-xs">视频</span>
                                    <div class="top text-right w-full">
                                        <i class="fa fa-caret-down text-warning m-r-sm"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="panel padder-v item bg-info">
                                    <div class="h1 text-fff font-thin h1">{{$cound['vod_ad']}}</div>
                                    <span class="text-muted text-xs">视频广告</span>
                                    <div class="top text-right w-full">
                                        <i class="fa fa-caret-down text-warning m-r-sm"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="panel padder-v item">
                                    <div class="font-thin h1">{{$cound['article']}}</div>
                                    <span class="text-muted text-xs">文章</span>
                                    <div class="bottom text-left">
                                        <i class="fa fa-caret-up text-warning m-l-sm"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="panel padder-v item bg-primary">
                                    <div class="h1 text-fff font-thin h1">{{$cound['friend']}}</div>
                                    <span class="text-muted text-xs">友情链接</span>
                                    <div class="top text-right w-full">
                                        <i class="fa fa-caret-down text-warning m-r-sm"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title" style="border-bottom:none;background:#fff;">
                                <h5>网站信息</h5>
                            </div>
                            <div class="ibox-content" style="border-top:none;">
                                <div id="flot-line-chart-moving" >
                                    <table class="table table-bordered">
                                        <tbody>
                                        @foreach($info as $k=>$v)
                                        <tr>
                                            <td>{{$k}}</td>
                                            <td>{{$v}}</td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 全局js -->
@include("admin.public.footer")
