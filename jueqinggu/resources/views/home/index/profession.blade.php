<!DOCTYPE html>
<!-- saved from url=(0070)https://www.boxuegu.com/web/html/payCourseDetailPage.html?id=76&free=0 -->
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:bd="http://www.baidu.com/2010/xbdml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!--[if IE 9]>
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE9">
    <![endif]-->
    <meta http-equiv="X-UA-Compatible" content="IEedge">
    
    <title>{{$professionInfo->pro_name}}</title>
    {{--<link rel="shortcut icon" href="https://www.boxuegu.com/favicon.ico">--}}
    {{--<meta name="keywords" content="Java培训,Android培训,安卓培训,PHP培训,C++培训,iOS培训,网页设计培训,平面设计培训,UI设计培训,游戏开发培训,移动开发培训,网络营销培训,web前端培训">--}}
    {{--<meta name="description" content="it教育云课堂为like it旗下在线教育品牌，将积累10年的实体班线下课程和教学方法引到线上。课程大纲全新优化，内容有广度、有深度，顶尖讲师全程直播授课。专注整合like it优势教学资源、打造适合在线学习并能保证教学结果的优质教学产品，同时打造和运营一整套教育生态软件体系，为用户提供满足自身成长和发展要求的有效服务。">--}}
    {{--<meta name="renderer" content="webkit">--}}

    <link rel="stylesheet" href="{{asset('home')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('home')}}/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="{{asset('home')}}/css/mylogin.css">
    <link rel="stylesheet" href="{{asset('home')}}/css/myprofile.css">
    <link rel="stylesheet" href="{{asset('home')}}/css/componet.css">
    <link rel="stylesheet" href="{{asset('home')}}/css/header.css">
    <link rel="stylesheet" href="{{asset('home')}}/css/iconfont.css">
    <link rel="stylesheet" href="{{asset('home')}}/css/payCourseDetailPage.css">
    <link rel="stylesheet" href="{{asset('home')}}/css/footer.css">
    <link rel="stylesheet" href="{{asset('home')}}/css/iconfont.css">
    {{--<script src="{{asset('home')}}/js/hm.js"></script>--}}
    <script src="{{asset('home')}}/js/jquery.min.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" src="{{asset('home')}}/js/ZeroClipboard.js"></script>
    <script src="{{asset('home')}}/js/ajax.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" src="{{asset('home')}}/js/artTemplate.js"></script>
    <script type="text/javascript" src="{{asset('home')}}/js/jquery.dotdotdot.js"></script>
    <script type="text/javascript" src="{{asset('home')}}/js/layer.js"></script><link rel="stylesheet" href="{{asset('home')}}/css/layer.css" id="layui_layer_skinlayercss">
    <script src="{{asset('home')}}/js/jquery.pagination.js"></script>
    <script src="{{asset('home')}}/js/bootstrap.js" type="text/javascript" charset="utf-8"></script>
    <script src="{{asset('home')}}/js/jquery.form.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="{{asset('home')}}/js/helpers.js" type="text/javascript" charset="utf-8"></script>
    <script src="{{asset('home')}}/js/html5.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
<div class="webSiteNotice" style="display:none;">
    <div class="innerBox clearfix">
        <i class="iconfont icon-xiaoxilaba xiaoxilaba">
        </i>
        <span class="noticeInfo">
        </span>
        <i class="iconfont icon-guanbi noticeClose">
        </i>
    </div>
</div>
<header>
    <div class="header_body">
        <div class="header_left">
            <a href="https://www.boxuegu.com/index.html">
                <img src="{{asset('home')}}/img/logo.png" alt="">
            </a>
            {{--<div class="path">--}}
                {{--<a href="https://www.boxuegu.com/index.html" class="select">--}}
                    {{--云课堂--}}
                {{--</a>--}}
                {{--<a href="https://www.boxuegu.com/web/html/ansAndQus.html">--}}
                    {{--问答精灵--}}
                {{--</a>--}}
                {{--<a href="https://www.boxuegu.com/web/html/forum.html">--}}
                    {{--博学社--}}
                {{--</a>--}}
                {{--<a href="http://www.itheima.com/" target="_blank">--}}
                    {{--线下学院--}}
                {{--</a>--}}
            {{--</div>--}}
        </div>
        <div class="header_right">
            <a href="javascript:;" class="studentCenterBox">
                学习中心
            </a>
            <span class="lineBetween">
                |
            </span>
            <div class="loginGroup">
                <div class="login" style="display:none;">
                    <div class="dropdown" id="myDropdown">
                        <div class="userPic">
                        </div>
                        <div id="dLabel" data-target="#" role="button" aria-haspopup="true">
                            <span class="name">
                            </span>
                            <span class="caret">
                            </span>
                        </div>
                        <ul class="dropdownmenu" aria-labelledby="dLabel">
                            <div class="pointer">
                            </div>
                            <li>
                                <a data-id="mydata">
                                    <i class="iconfont icon-xueyuan">
                                    </i>
                                    我的资料
                                </a>
                            </li>

                            <li>
                                <a data-exit="exit">
                                    <i class="iconfont icon-tuichu">
                                    </i>
                                    安全退出
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="logout" style="display: block;">
                    <a class="btn-login btn-link" data-toggle="modal" data-target="#login"
                       data-backdrop="static">
                        登录
                    </a>
                    <a class="btn-register btn-link" href="">
                        注册
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="login" data-backdrop="static" style="display: none;">
        <div class="modal-dialog login-module" role="document">
            <div class="cymylogin">
                <div class="cymylogin-top clearfix">
                    <div class="cymyloginclose" data-dismiss="modal" aria-label="Close" data-backdrop="static">
                    </div>
                    <div class="cymyloginlogo">
                        欢迎登录&nbsp;&nbsp;it教育云课堂
                    </div>
                    <div class="cymyloginhint cymlogin" style="top: 221px; display: block;">
                        请输入6-18位密码
                    </div>
                </div>
                <div class="cymylogin-bottom form-login">
                    <input type="text" class="cyinput1 form-control" maxlength="30" placeholder="请输入手机号或邮箱"
                           autocomplete="off">
                    <div class="cymyloginclose1">
                    </div>
                    <input type="password" class="cyinput2 form-control" maxlength="18" placeholder="请输入6-18位密码"
                           autocomplete="off" style="border: 1px solid rgb(255, 64, 18);">
                    <div class="cymyloginclose2">
                    </div>
                    <button class="cymyloginbutton">
                        登
                        <em>
                        </em>
                        录
                    </button>
                    <div class="cymyloginpassword">
                        <a class="atOnceRegister" href="">
                            立即注册
                        </a>
                        <a class="atOnceResetPassword" href="">
                            忘记密码?
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<input type="hidden" id="fe_text" class="sharUrl" value="">

<div class="rTips"></div>
<div id="payCourseSlider" style="">
    <div class="payCourseItems clearfix">
        <ul class="clearfix" style="display:inline-block">
            <li class="cu-shou course-details notpointer">课程详情</li>
            <li class="cu-shou course-outline noClick">课程大纲</li>
            <li class="cu-shou course-teacher notpointer">授课老师</li>
            <li class="cu-shou course-problem notpointer">常见问题</li>
            <li class="cu-shou course-evaluate notpointer">学员评价</li>
        </ul>
        <a href="" class="purchase" style="display: block;">立即报名</a>
        <a href="" class="studyImmed" style="display: none;">立即学习</a>
    </div>
</div>
<div id="course-list">
    <div class="nav" id="NoShowIntroduct" style="display: block;">
        <a href="https://www.boxuegu.com/index.html">云课堂</a><span> &gt; </span><span class="myClassName" style="margin-left:0px" href="/web/html/courseIntroductionPage.html?id=76&amp;courseType=0&amp;free=undefined">{{$professionInfo->pro_name}}</span>
    </div>
    <div class="nav" id="showIntroduct">
        <a href="https://www.boxuegu.com/index.html">云课堂</a><span> &gt; </span><a class="myClassName" href="https://www.boxuegu.com/web/html/courseIntroductionPage.html?id=76&amp;courseType=0&amp;free=undefined">微信小程序实战开发</a><span> &gt; </span><span style="margin-left:0px">课程详情</span>
    </div>
    <div class="bigpic">
        <div class="bigpic-title">
            <div class="bigpic-img">
                <img src="{{asset('home')}}/img/2e58d1b8496349aeb059846637061b92.jpg"></div>
            <div class="bigpic-body">
      <span class="bigpic-body-title">
        <span class="bigpic-body-title-nav">{{$professionInfo->pro_name}}</span></span>
                <p class="bigpic-body-text dot-ellipsis" title="{{$professionInfo->pro_desc}}">{{$professionInfo->pro_desc}}</p>
                <p class="bigpic-body-list">
                    <span class="body-list-right">主讲：
                        @foreach($professionInfo->teacher_ids as $teacher)
                        {{$teacher->nickname}}
                        @endforeach
                    </span>
                    <span class="body-list-right myTimes" title="课程时长" style="cursor:default">学习时长：{{$professionInfo->duration}}小时</span>
                    <span title="学习人数" style="cursor:default">学习人数：{{$professionInfo->click}}人已学习</span>
                    <span title="有效期" style="cursor:default;color:#333;" class="youxiaoqi">有效期：{{$professionInfo->expired_at}}天
          <span class="yibaoming" style="display:none">
            <img src="{{asset('home')}}/img/baoming.png"></span></span>
                </p>
                <p class="bigpic-body-money">
                    <span class="bigpic-body-redmoney">￥{{$professionInfo->price}}</span>
                    <del class="bigpic-body-notmoney">￥{{$professionInfo->market_price}}</del></p>
                <div class="bigpic-body-btn">
                    <a href="/order/{{$professionInfo->id}}/sure" class="gotengxun purchase">立即报名</a>
                    <a class="free-try-to-lean">免费试学</a></div>
            </div>
        </div>
    </div>
    <div id="introductBox">
        <div id="introduct">
            <div class="course" id="detail-course">
                <!--<div class="classgrand"></div>
                <div class="course-time">开课时间：<span>11111</span></div>
                 <div class="baoming storpHot"><em></em><span style="color:#333;">报名已结束</span></div>
                 <div class="daojishi daojishi' + index + '">距离开班<span>00</span>天<span>00</span>时<span>00</span>分<span>00</span>秒</div>
                <div class="online"><a style="background-color: #ccc;">在线报名</a></div>-->
            </div>
        </div>
    </div>

    <div class="zhanwei">

    </div>
    <div class="background-big"></div>
    <div id="sign-up-modal">

    </div>
    <div class="table-body clearfix">
        <div class="sidebar-body">
            <div class="sidebar-body-details">
                <div class="details-title">
                    <!--<div class="shu"></div>-->
                    <p class="sidebar-body-details-title">云课堂</p>
                </div>
                <p class="details-body">
                    it教育是like it旗下的在线教育平台。整合线下优质课程和纯熟的教学经验，开展在线教育，突破空间、地域、时间、费用的限制，让优质教育资源平等化。
                </p>
            </div>
            <div class="sidebar-body-QQ">
                <div class="details-title">
                    <!--<div class="shu"></div>-->
                    <p class="sidebar-body-details-title">资料申领</p>
                    <p style="color:#333;margin-left: 20px;font-size: 14px;margin-top: 58px;">更多课程视频资料免费领取</p>
                </div>

            </div>
            <div class="relative-course">
                <div class="relative-course-top clearfix">
                    <span>推荐课程</span>
                    <span class="by-the-arrow">
      <span class="curCount currentLunbo">1</span>
      <span class="curCount">/</span>
      <span class="curCount allLunbo">4</span>
      <span class="prev" id="prev"></span>
      <span class="next" id="next"></span>
    </span>
                </div>
                <div class="relativeAnsNoData" style="display: none;">
                    <img src="{{asset('home')}}/img/my_nodata.png">
                    <p>暂无数据</p>
                </div>
                <div class="relative-course-bottom slide-box clearfix">
                    <div id="box" class="slideBox clearfix">
                        <ul class="course boxContent clearfix">
                            <li class="diyiye">
                                <a href="https://www.boxuegu.com/web/html/payCourseDetailPage.html?id=77&amp;courseType=1&amp;free=0" target="_blank">
                                    <div class="img">
                                        <img src="{{asset('home')}}/img/336eb94512234e20b26490661f666cf2.jpg"></div>
                                    <span class="classCategory">点播</span>
                                    <div class="detail">
                                        <p class="title" data-text="Web前端开发就业班" title="Web前端开发就业班">Web前端开发就业班</p>
                                        <p class="info clearfix">
                <span>
                  <i>￥</i>
                  <span class="price">7000.00</span>
                  <del>
                    <i class="price1">￥</i>9900.00</del></span>
                                            <span class="stuCount">
                  <img src="{{asset('home')}}/img/studentCount.png" alt="">
                  <span class="studentCou">62</span></span>
                                        </p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.boxuegu.com/web/html/payCourseDetailPage.html?id=125&amp;courseType=1&amp;free=0" target="_blank">
                                    <div class="img">
                                        <img src="{{asset('home')}}/img/035ff49cca614aa5ad1c61358efe98ae.png"></div>
                                    <span class="classCategory">点播</span>
                                    <div class="detail">
                                        <p class="title" data-text="HTML5 + CSS3" title="HTML5 + CSS3">HTML5 + CSS3</p>
                                        <p class="info clearfix">
                <span>
                  <i>￥</i>
                  <span class="price">299.00</span>
                  <del>
                    <i class="price1">￥</i>499.00</del></span>
                                            <span class="stuCount">
                  <img src="{{asset('home')}}/img/studentCount.png" alt="">
                  <span class="studentCou">44</span></span>
                                        </p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.boxuegu.com/web/html/payCourseDetailPage.html?id=124&amp;courseType=1&amp;free=0" target="_blank">
                                    <div class="img">
                                        <img src="{{asset('home')}}/img/9a7a45f22f4c4dd19752a486cc8a57ec.png"></div>
                                    <span class="classCategory">点播</span>
                                    <div class="detail">
                                        <p class="title" data-text="AngularJS" title="AngularJS">AngularJS</p>
                                        <p class="info clearfix">
                <span>
                  <i>￥</i>
                  <span class="price">299.00</span>
                  <del>
                    <i class="price1">￥</i>499.00</del></span>
                                            <span class="stuCount">
                  <img src="{{asset('home')}}/img/studentCount.png" alt="">
                  <span class="studentCou">44</span></span>
                                        </p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.boxuegu.com/web/html/payCourseDetailPage.html?id=123&amp;courseType=1&amp;free=0" target="_blank">
                                    <div class="img">
                                        <img src="{{asset('home')}}/img/ebfa979d098848b6bd3c7b0bd9317568.jpg"></div>
                                    <span class="classCategory">点播</span>
                                    <div class="detail">
                                        <p class="title" data-text="Web前端开发基础班" title="Web前端开发基础班">Web前端开发基础班</p>
                                        <p class="info clearfix">
                <span>
                  <i>￥</i>
                  <span class="price">299.00</span>
                  <del>
                    <i class="price1">￥</i>800.00</del></span>
                                            <span class="stuCount">
                  <img src="{{asset('home')}}/img/studentCount.png" alt="">
                  <span class="studentCou">1275</span></span>
                                        </p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-title">
            <div class="table-title-inset">
                <span class="cu-shou course-details noClick">课程详情</span>
                <span class="cu-shou course-outline notpointer">课程大纲</span>
                <span class="cu-shou course-teacher notpointer">授课老师</span>
                <span class="cu-shou course-problem notpointer">常见问题</span>
                <span class="cu-shou course-evaluate notpointer">学员评价</span>
                <span class="table-zhanwei"></span>
            </div>
        </div>
        <div class="pagesBox clearfix">
            <div class="table-modal">
                <div class="table-school">
                    {!!$professionInfo->detail!!}
                    {{--<div class="table-school-body">--}}
                        {{--<p class="school-chapter">--}}
                            {{--<span class="bcg"></span>--}}
                            {{--<span class="school-chapter-text">--}}
            {{--<span>微信小程序背景介绍</span></span>--}}
                        {{--</p>--}}
                        {{--<div class="details-div">--}}
                            {{--<p class="details-div-title">微信小程序背景介绍</p>--}}
                            {{--<div class="details-div-body">--}}
                                {{--<p title="1-课程说明">1-课程说明</p>--}}

                                {{--<p>--}}
                                {{--</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<p class="school-chapter">--}}
                            {{--<span class="bcg"></span>--}}
                            {{--<span class="school-chapter-text">--}}
            {{--<span>准备工作</span></span>--}}
                        {{--</p>--}}
                        {{--<div class="details-div">--}}
                            {{--<p class="details-div-title">微信小程序开发准备工作</p>--}}
                            {{--<div class="details-div-body">--}}
                                {{--<p title="1-开发环境的搭建">1-开发环境的搭建</p>--}}
                                {{--<p title="2-微信web开发者工具更新说明">2-微信web开发者工具更新说明</p></div>--}}
                        {{--</div>--}}

                    {{--</div>--}}
                </div>
            </div>
            <div class="pages" style="display: none;">
                <div id="Pagination"></div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('home')}}/js/payCourseDetailPage.js" type="text/javascript" charset="utf-8"></script>
<script src="{{asset('home')}}/js/footer.js" type="text/javascript"></script><div class="footerDT"><footer><div class="content"><div class="content-item footer-bodys"><div class="content-item content-footer-link about-us"><ul class="gate"><li data-id="first" data-url="../html/aboutUs.html">关于我们<span>|</span></li><li data-id="two" data-url="../html/aboutUs.html">人才招聘<span>|</span></li><li data-id="three" data-url="../html/aboutUs.html">联系我们<span>|</span></li><li data-id="four" data-url="../html/aboutUs.html" class="noline">常见问题</li></ul></div><div class="trademark">京ICP备08001421号 京公网安备110108007702 Copyright @ 2016 it教育 All Rights Reserved<span style="margin-right:5px;"></span><span id="cnzz_stat_icon_1260713417"><a href="http://www.cnzz.com/stat/website.php?web_id=1260713417" target="_blank" title="站长统计"><img border="0" hspace="0" vspace="0" src="{{asset('home')}}/img/pic1.gif"></a></span></div></div></div></footer></div>
<script src="{{asset('home')}}/js/placeHolder.js"></script>
<script type="text/javascript">
    $(function(){ $('input').placeholder(); });
</script>

</body></html>