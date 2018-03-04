$(function () {
    // jQuery.support.transition
    // 检查浏览器是否支持CSS3的transition动画
    $.support.transition = (function () {
        var thisBody = document.body || document.documentElement,
            thisStyle = thisBody.style,
            support = thisStyle.transition !== undefined || thisStyle.WebkitTransition !== undefined || thisStyle.MozTransition !== undefined || thisStyle.MsTransition !== undefined || thisStyle.OTransition !== undefined;

        return support;
    })();
    //如果支持，那么在html上添加表示支持的类，使transition动画生效
    var issupporttranstion = $.support.transition;
    if (issupporttranstion) {
        $("html").addClass('supporttranstion');
    }

    //课程 JSON静态化
    $.ajax({
        url: "/json/banner1.json",
        type: "get",
        dataType: "json",
        async: false,
        success: function (json) {
            if (json != null) {
                for (var i = 0; i < json.length; i++) {
                    $(".mainpage-slideshow-top .banner").append("<a href=\""+json[i].url+"\"><img src=\""+json[i].pic+"\" alt=\""+json[i].title+"\"></a>");
                }
            }
        },
        error: function () {
            console.log("AJAX fail");
        }
    });
    //首页的轮播图
    //需要jquery.slideshow.js，可更改轮播间隔和主题颜色
    $(".mainpage-slideshow-top").slideShow({color: "#f10823"});

    //给“秒杀”一栏的图片添加类，使鼠标悬浮时图片产生向上的动画效果
    $(".seckill-content li:lt(5)").addClass('moveup');

    //轮播图右侧的新闻中心的标签页效果
    (function () {
        var newstabnav = $(".mainpage-quickentry-news-title li");
        var newstabcontent = $(".mainpage-quickentry-news-content ul");
        newstabnav.hover(function () {
            $(this).find('span').addClass('active').parent().siblings().find('span').removeClass('active');
            //同样利用索引号显示对应的内容栏
            var idx = newstabnav.index(this);
            newstabcontent.eq(idx).show().siblings().hide();
        });
    })();


});
