<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="{{asset(__INDEX__)}}/css/style.css">
	<script src="{{asset(__INDEX__)}}/js/jquery.min.js"></script>
	<!-- 播放器 -->
	<link rel="stylesheet" href="{{asset(__INDEX__)}}/dplayer/DPlayer.min.css"/>
	<script type="text/javascript" src="{{asset(__INDEX__)}}/dplayer/hls.min.js" charset="UTF-8"></script>
	<script src="{{asset(__INDEX__)}}/dplayer/DPlayer.min.js"></script>
<body style="width:100%;
	height:100%;">
<style>
    #dplayer{
        position: absolute;
        left: 0px;
        right: 0px;
        top: 0px;
        bottom: 0px;
        width: 100%;
        height: 100%;
    }
    /*.dbox{ position: relative;}*/
    .adsafer{ position: absolute; right: 13px; top: 22px;background: rgba(0,0,0,0.6);
        border-radius: 14px; color: #fff; padding: 4px 10px; font-size: 14px;}
</style>
<div class="dbox">
    <div id="dplayer"></div>
</div>

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
        $('.dbox').append('<p class="adsafer">视频广告</p>')
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
</body>
</html>
