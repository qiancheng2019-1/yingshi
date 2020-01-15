
		<!-- 导航 -->
		<div class="pcnav">
			<ul class="parent">
				<li class="parent_item">
					<a href="/" class="parent_a">首页</a>
				</li>
                @foreach($columns as $item)
				<li class="parent_item">
					<a href="{{route('vod.type',['id'=>$item->id])}}" class="parent_a">{{$item->name}}</a>
                    @if($item->sub)
					<ol class="child">
                        @foreach($item->sub as $item2)
                        <li>
							<a href="{{route('vod.type',['id'=>$item2->id])}}">{{$item2->name}}</a>
						</li>
                        @endforeach
					</ol>
                    @endif
				</li>
                @endforeach;
			</ul>
		</div>
		<!-- 导航 -->
