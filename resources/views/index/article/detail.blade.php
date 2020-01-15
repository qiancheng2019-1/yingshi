@extends("index.public.default")
@section('detail_title', $article->title.'-')
@section('content')
		<!-- 内容 -->
		<div class="content">
			<div class="content_c">
				<div class="article_header">
                    <h2>{{$article->title}}</h2>
                    <h3>{{$article->name}}　时间：{{$article->created_at}}　<span>阅读：{{$article->red}}</span></h3>
                </div>
                <div class="article_content">
                    {!! $article->content !!}
                    <div class="clearboth"></div>
                </div>
				<div class="clearboth"></div>
			</div>
			<div class="clearboth"></div>
		</div>
		<div class="clearboth"></div>
		<!-- 内容 -->

@endsection
