@extends("index.public.default")
@section('detail_title', '搜索结果'.'-')
@section('content')
		<!-- 内容 -->
		<div class="content">
			<div class="content_c">
				<div class="min_nav">
					<p><span>当前位置</span><a href="/">首页</a> > <a href="javascript:;">搜索结果</a></p>
				</div>
				<div class="vod_list">
					<ol>
						<li>影片名称</li>
						<li>地区</li>
						<li>影片类别</li>
						<li>更新时间</li>
					</ol>
                        @foreach($vod_list as $item)
                            <ul class="item">
                                <li><a href="{{route('vod.detail',['id'=>$item->id,'p'=>0])}}">{{$item->name}}</a></li>
                                <li>{{$item->region}}</li>
                                <li>{{$item->pidname}}</li>
                                <li>{{$item->created_at}}</li>
                            </ul>
                        @endforeach
                        @if($vod_list->isEmpty())
                        <p style="font-size: 16px; text-align: center;padding-top: 100px; padding-bottom: 100px;">Oh no! 无任何搜索结果</p>
                        @endif

					<div class="page">
                        {{ $vod_list->appends(Request::all())->links('vendor.pagination.default') }}
						<div class="clearboth"></div>
					</div>
					<div class="clearboth"></div>
				</div>
				<div class="clearboth"></div>
			</div>
			<div class="clearboth"></div>
		</div>
		<div class="clearboth"></div>
		<!-- 内容 -->

@endsection
