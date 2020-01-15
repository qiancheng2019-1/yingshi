@extends("index.public.default")
@section('detail_title', $detail->name.' '.explode( '$$',$detail->playUrl)[0].'-')
@section('content')
		<!-- 内容 -->
		<div class="content">
			<div class="content_c">
				<div class="min_nav">
					<p><span>当前位置</span><a href="/">首页</a> > <a href="{{route('vod.type',['id'=>$detail->pid])}}">{{$detail->pidname}}</a></p>
				</div>
				<div class="vodbox" style="position: relative">
					<div id="dplayer"></div>
				</div>
				<div class="clearboth"></div>
				<div class="vod_numlite">
					<h4>{{$detail->name}}在线播放：</h4>
					<div class="mumlist">
                        @foreach($play_list as $key=>$item)
                            <a href="{{route('vod.detail',['id'=>$detail->id,'p'=>$key])}}" @if($p==$key) class="active" @endif>{{explode("$$",$item)[0]}}</a>
                        @endforeach
{{--						<a href="" class="active">第1集</a>--}}
						<div class="clearboth"></div>
					</div>
					<div class="clearboth"></div>
				</div>
				<div class="clearboth"></div>
				<div class="vod_detail">
					<div class="detail_top">
						<div class="thumb">
							<img src="{{$detail->domain}}{{$detail->thumb}}00.jpg" alt="">
						</div>
						<div class="desc">
							<h2>{{$detail->name}} @if($detail->share==2)<span>更新至{{count($play_list)}}集</span> @endif</h2>
							<p>别名：{{$detail->alias}}</p>
							<p>导演：{{$detail->director}}</p>
							<p>主演 ：{{str_limit($detail->to_star,83,'...')}}</p>
							<p>类型：{{$detail->pidname}} {{$detail->type}}</p>
							<p>地区：{{$detail->region}}</p>
							<p>语言：{{$detail->language}}</p>
							<p>上映：{{$detail->release_time}}</p>
							<p>片长：{{$detail->film_length/60}}</p>
							<p>更新：{{$detail->updated_at}}</p>
							<p>总播放量：@if($detail->red >999999)99999+ @else {{$detail->red}} @endif　　总评分数：{{$detail->score}}　　评分次数：{{$detail->count_score}}</p>
                            <div class="clearboth"></div>
						</div>
                        <div class="pingfen">
                            <h3>{{$detail->score}}</h3>
                        </div>

					</div>
					<div class="detail_top1">
						<p><span>剧情介绍：</span><br><?php echo strip_tags($detail->desc);?></p>
						<div class="clearboth"></div>
					</div>
					<div class="detail_top2">
						<p class="help">备注：如有地址错误， 请点击→ <a href="">我要报错</a>向我们报错！我们将在第一时间处理！谢谢！</p>
						<div id="play_1">
							<h3>播放类型：zuidam3u8</h3>
							<ul class="m3u8list">
                                @foreach($play_list as $key=>$item)
								<li>
									<input type="checkbox" value="{{$detail->domain}}{{explode("$$",$item)[1]}}" checked>
                                    {{explode("$$",$item)[0]}}${{$detail->domain}}{{explode("$$",$item)[1]}}
								</li>
                                @endforeach
							</ul>
							<div class="m3u8footer">
								<label for="m3u8all" id="m3u8checkall">
									<input type="checkbox" id="m3u8all" onclick="checkAll('play_1',this.checked)" checked>
									<span>全选</span>
								</label>
								<button class="copy1">复制链接</button>
								<button class="copy2">复制名称$链接</button>
								<button class="copy3">复制名称$链接$后缀</button>
							</div>
						</div>
						<div class="clearboth"></div>
						<!-- -->
						<div  id="play_2">
							<h3 class="dplayer_all">播放类型：zuidall</h3>
							<ul class="dplayerlist">
                                @foreach($play_list as $key=>$item)
                                    <li>
                                        <input type="checkbox" value="http://{{$_SERVER['SERVER_NAME']}}/share/{{$detail->id}}/{{endecodevodId($key)}}" checked>
                                        {{explode("$$",$item)[0]}}$http://{{$_SERVER['SERVER_NAME']}}/share/{{$detail->id}}/{{endecodevodId($key)}}

                                    </li>
                                @endforeach

							</ul>
							<div class="dplayerfooter">
								<label for="dplayerall">
									<input type="checkbox" id="dplayerall" onclick="checkAll('play_2',this.checked)" checked>
									<span>全选</span>
								</label>
								<button class="copy1">复制链接</button>
								<button class="copy2">复制名称$链接</button>
								<button class="copy3">复制名称$链接$后缀</button>
							</div>
						</div>
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

	<div id="copyContent" style="opacity: 0; position: fixed; z-index: -9999;">ldg</div>
	<script>
        @if($config['siteconfig']->ad==0)
            // 播放器
            const dp = new DPlayer({
                element: document.getElementById('dplayer'),
                autoplay: true,
                video: {
                    url: '{{$detail->vod_adurl}}'
                },
                contextmenu: [
                    {
                        text: 'DPlayer',
                        link: '',
                    }
                ],
            });
                dp.on('ended', function() {
                    $('.adsafer').css('display','none')
                    dp.switchVideo(
                        {
                            url: '{{$detail->domain}}{{explode("$$",$detail->playUrl)[1]}}',
                            autoplay: true,
                        }
                    );
                    dp.play();
                });
                $('.vodbox').append('<p class="adsafer">视频广告</p>')
            @else
                const dp = new DPlayer({
                        element: document.getElementById('dplayer'),
                        autoplay: true,
                        video: {
                            url: '{{$detail->domain}}{{explode("$$",$detail->playUrl)[1]}}'
                        },
                        contextmenu: [
                            {
                                text: 'DPlayer',
                                link: '',
                            }
                        ],
                    });
            @endif
        </script>
        <style>
            .dbox{ position: relative;}
            .adsafer{ position: absolute; right: 13px; top: 22px;background: rgba(0,0,0,0.6);
                border-radius: 14px; color: #fff; padding: 4px 10px; font-size: 14px;}
        </style>
@endsection

<?php
    /**
     * 加密解密视频id,
     * @param unknown $string
     * @param string $action  encode|decode
     * @return string
     */
    function endecodevodId($string, $action = 'encode') {
        $startLen = 13;
        $endLen = 8;

        $coderes = '';
        #TOD 暂设定uid字符长度最大到9
        if ($action=='encode') {
            $uidlen = strlen($string);
            $salt = 'yourself_code';
            $codestr = $string.$salt;
            $encodestr = hash('md4', $codestr);
            $coderes = $uidlen.substr($encodestr, 5,$startLen-$uidlen).$string.substr($encodestr, -12,$endLen);
            $coderes = strtoupper($coderes);
        }elseif($action=='decode'){
            $strlen = strlen($string);
            $uidlen = $string[0];
            $coderes = substr($string, $startLen-$uidlen+1,$uidlen);
        }
        return  $coderes;
    }

?>
