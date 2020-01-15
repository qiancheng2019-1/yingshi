@include("admin.public.header")
<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
<div id="wrapper">
    <!--左侧导航开始-->
    @include("admin.public.sidebar")
    <!--左侧导航结束-->
    <!--右侧部分开始-->
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include("admin.public.top")
        <div class="row J_mainContent" id="content-main">
            <iframe id="J_iframe" width="100%" height="100%" src="{{route("admin.console")}}" frameborder="0" data-id="{{route("admin.console")}}" seamless></iframe>
        </div>
    </div>
    <!--右侧部分结束-->
</div>

@include("admin.public.footer")
