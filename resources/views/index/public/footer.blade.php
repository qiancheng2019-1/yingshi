
		<!-- 底部 -->
		<div class="footer">
			<div class="footer_c">
				<p>
					@foreach($friend as $item)<a href="{{$item->url}}" title="{{$item->name}}">{{$item->name}}</a> | @endforeach <a href="">{{$config['siteconfig']->tel}}</a> <br>{{$config['siteconfig']->copyright}}<br>
                    {{$config['siteconfig']->icp}}
				</p>
			</div>
		</div>
		<!-- 底部 -->
	</div>
        <div class="cnzz" style="display: none">{{$config['siteconfig']->cnzz}}</div>
</body>
</html>
