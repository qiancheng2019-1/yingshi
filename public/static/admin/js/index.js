$(function(){
    //菜单点击
    // J_iframe
    // $('#side-menu').find('#J_iframe').click(function() {
    //     // 为当前点击的导航加上高亮，其余的移除高亮
    //     $(this).addClass('nav-active').siblings('li').removeClass('nav-active');
    // });
    $(".J_menuItem").on('click',function(){
        var url = $(this).attr('href');
        $(".J_menuItem").each(function () {
            if($(this).attr('href') === url){
                if($('.nav-active')){
                    $(".J_menuItem").removeClass('nav-active');
                }
                $(this).addClass('nav-active');
            }
        })
        $("#J_iframe").attr('src',url);
        $("#J_iframe").attr('data-id',url);
        return false;
    });
});
