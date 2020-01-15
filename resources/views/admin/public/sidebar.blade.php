<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="nav-close"><i class="fa fa-times-circle"></i>
    </div>
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">
                                    <span class="block m-t-xs" style="font-size:20px;">
                                        <i class="fa fa-area-chart"></i>
                                        <strong class="font-bold">{{isset($config['siteconfig']->cmstitle) ? $config['siteconfig']->cmstitle:''}}</strong>
                                    </span>
                                </span>
                    </a>
                </div>
                <div class="logo-element">{{isset($config['siteconfig']->cmstitle) ? $config['siteconfig']->cmstitle:''}}
                </div>
            </li>
            <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
                <span class="ng-scope">控制台</span>
            </li>
            <li>
                <a class="" href="{{ url('/') }}" target="_blank">
                    <i class="fa fa-life-buoy"></i>
                    <span class="nav-label">访问首页</span>
                </a>
            </li>
            <li>
                <a class="J_menuItem nav-active" href="{{route("admin.console")}}">
                    <i class="fa fa-home"></i>
                    <span class="nav-label">主页</span>
                </a>
            </li>
            <li class="line dk"></li>
            <li>
                <a href="#"><i class="fa fa-desktop"></i> <span class="nav-label">系统设置</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a class="J_menuItem" href="{{route("admin.config.site")}}">网站设置</a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="{{route("admin.config.column_list")}}">栏目管理</a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="{{route("admin.config.manage_list")}}">管理员管理</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-desktop"></i> <span class="nav-label">文章中心</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a class="J_menuItem" href="{{route("admin.article.article_list")}}">文章管理</a></li>
                    <li><a class="J_menuItem" href="{{route("admin.article.article_cate")}}">文章分类</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-desktop"></i> <span class="nav-label">视频中心</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a class="J_menuItem" href="{{route("admin.vod.vod_plot_list")}}">剧情分类</a></li>
                    <li><a class="J_menuItem" href="{{route("admin.vod.vod_list")}}">视频管理</a></li>
                    <li><a class="J_menuItem" href="{{route("admin.vod.vod_ad_list")}}">视频广告</a></li>
                    <li><a class="J_menuItem" href="{{route("admin.vod.vod_domain_list")}}">视频资源域名</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-desktop"></i> <span class="nav-label">友情链接</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a class="J_menuItem" href="{{route("admin.friend.friend_list")}}">友情链接管理</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-desktop"></i> <span class="nav-label">网站地图</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a class="J_menuItem" href="{{route("admin.sitemap.index")}}">更新网站地图</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
