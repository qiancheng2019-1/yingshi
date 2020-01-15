<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('detail_title'){{isset($config['siteconfig']->seotitle) ? $config['siteconfig']->seotitle:''}}</title>
    <meta name="keywords" content="@yield('detail_title'){{$config['siteconfig']->keyword}}"/>
    <meta name="description" content="@yield('detail_title'){{$config['siteconfig']->desc}}"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{$config['siteconfig']->icon}}"/>
	<link rel="stylesheet" href="{{asset(__INDEX__)}}/css/style.css?v3">
	<script src="{{asset(__INDEX__)}}/js/jquery.min.js"></script>
	<script src="{{asset(__INDEX__)}}/js/min.js"></script>
    <!-- 播放器 -->
    <link rel="stylesheet" href="{{asset(__INDEX__)}}/dplayer/DPlayer.min.css"/>
    <script type="text/javascript" src="{{asset(__INDEX__)}}/dplayer/hls.min.js" charset="UTF-8"></script>
    <script src="{{asset(__INDEX__)}}/dplayer/DPlayer.min.js"></script>

    <!-- bbot -->
	<link href="{{asset(__INDEX__)}}/bootstrap/css/bootstrap.min.css?v1" rel="stylesheet">
	<script src="{{asset(__INDEX__)}}/bootstrap/js/bootstrap.min.js?v1"></script>
	<!-- HTML5 shim 和 Respond.js 是为了让 IE8 支持 HTML5 元素和媒体查询（media queries）功能 -->
    <!-- 警告：通过 file:// 协议（就是直接将 html 页面拖拽到浏览器中）访问页面时 Respond.js 不起作用 -->
    <!--[if lt IE 9]>
      <script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
    <![endif]-->
    <!-- bbnt -->
<body>
	<div class="dd">
	<!-- 头部 -->
		<!-- mc -->
	    <nav class="navbar navbar-inverse" style="background-color: #434343;">
	        <div class="container-fluid">

	            <div class="navbar-header">
	                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
	                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	                    <span class="sr-only">{{isset($config['siteconfig']->sitetitle) ? $config['siteconfig']->sitetitle:''}}</span>
	                    <span class="icon-bar"></span>
	                    <span class="icon-bar"></span>
	                    <span class="icon-bar"></span>
	                </button>
	                <a class="navbar-brand" href="/" style="color: #fff;">{{isset($config['siteconfig']->sitetitle) ? $config['siteconfig']->sitetitle:''}}</a>
	            </div>


	            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

	                <form class="navbar-form navbar-left" action="{{route('search.index')}}" method="get">
	                	@csrf
	                    <div class="form-group">
	                        <input type="text" class="form-control" placeholder="100万部影片任你搜索" name="search">
	                    </div>
	                    <button type="submit" class="btn btn-default" style="background-color: #d4d4d4;">搜索</button>
	                </form>
	                <ul class="nav navbar-nav navbar-right">
	                    <li><a href="/">首页</a></li>
	                    
                 	@foreach($columns as $item)
	                    <li class="dropdown">
	                     	@if($item->sub->isEmpty())
	                        <a href="{{route('vod.type',['id'=>$item->id])}}" class="dropdown-toggle" role="button" aria-haspopup="true"
	                            aria-expanded="false">{{$item->name}}</a>
	                        @else
                            <a href="{{route('vod.type',['id'=>$item->id])}}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                            aria-expanded="false">{{$item->name}} <span class="caret"></span></a>
	                        @endif    
	                        @if($item->sub)
	                        <ul class="dropdown-menu">
								@foreach($item->sub as $item2)
	                            <li><a href="{{route('vod.type',['id'=>$item2->id])}}">{{$item2->name}}</a></li>
	                            <li role="separator" class="divider"></li>
	                            @endforeach
	                        </ul>
	                        @endif
	                    </li>
	            	@endforeach;
	                </ul>
	            </div>
	        </div>
	    </nav>
		<!-- mc -->
		<div class="header">
			<div class="logo">
				<a href="/" title="{{isset($config['siteconfig']->sitetitle) ? $config['siteconfig']->sitetitle:''}}">
					<h1><img src="{{isset($config['siteconfig']->logo) ? $config['siteconfig']->logo:''}}" alt="{{isset($config['siteconfig']->sitetitle) ? $config['siteconfig']->sitetitle:''}}" style="width:175px; height:81px; margin-top:25px;"></h1>
				</a>
			</div>
			<form action="{{route('search.index')}}" class="search">
                @csrf
				<div class="search_L">
					<img src="{{asset(__INDEX__)}}/images/search_03.png" alt="">
					<input type="text" placeholder="100万部影片任你搜索" name="search">
				</div>
				<button type="submit">搜索</button>
			</form>
			<div class="header_R">
				<p>今日更新：<span>{{$countnow_vod}}</span></p>
				<p>本站影片共有：<span>{{$countvod}}</span></p>
			</div>
		</div>
		<!-- 头部 -->
		@include("index.public.nav")
