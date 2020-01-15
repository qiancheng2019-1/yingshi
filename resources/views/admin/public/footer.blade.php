<!-- 全局js -->
<script src="{{asset(__ADMIN__)}}/js/bootstrap.min.js?v=3.3.6"></script>
<script src="{{asset(__ADMIN__)}}/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="{{asset(__ADMIN__)}}/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="{{asset(__ADMIN__)}}/js/plugins/layer/layer.min.js"></script>

<!-- 自定义js -->
<script src="{{asset(__ADMIN__)}}/js/hAdmin.js?v=4.1.0"></script>
<script type="text/javascript" src="{{asset(__ADMIN__)}}/js/index.js"></script>



{{--baidu--}}
<script src="{{asset(__ADMIN__)}}/webuploader/webuploader.js"></script>

<div style="text-align:center;">
    <p>版权所有:<a href="/" target="_blank">{{isset($config['siteconfig']->cmstitle) ? $config['siteconfig']->cmstitle:''}}</a></p>
</div>
</body>

</html>
