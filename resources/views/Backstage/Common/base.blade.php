<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{!! csrf_token() !!}"/>
    <link href="{{asset("backstage/css/base.css")}}"  type="text/css" rel="stylesheet" />
    {{--<link href="//cdn.bootcss.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">--}}
    <link href="{{asset('common/css/font-awesome.min.css')}}" type="text/css" rel="stylesheet">

</head>
<style>
    .nav-vertical-item li:hover,.theme-black-bg,.nav li:hover{
        background-color: #2a313b;
    }
    #mainBody{
        color:#fff;
    }

</style>
<body>

<nav class="nav-vertical base-bg">

    <ul class="nav-vertical-item">
        <li class="height-60 black-bg"><a><i class="fa fa-bars"></i></a></li>
        <li class="height-60"><a href="/admin"><i class="fa fa-laptop"></i></a></li>
        <li class="height-60"><a href="/weixin"><i class="fa fa-weixin"></i></a></li>
        <li class="height-60"><a><i class="fa fa-user"></i></a></li>
        <li class="height-60"><a><i class="fa fa-laptop"></i></a></li>
        <li class="height-60"><a><i class="fa fa-laptop"></i></a></li>
    </ul>
</nav>

<div id="mainBody" class="theme-black-bg ">
    <div class="height-60 base-bg">
        <span class="col-2 padding-10 verti-padding-0">Jandou</span>
        <ul class="nav right-box">
            <li ><a><i class="fa fa-laptop"></i></a></li>
            <li ><a><i class="fa fa-laptop"></i></a></li>
            <li ><a><i class="fa fa-laptop"></i></a></li>
        </ul>
    </div>
    @section('sidebar')
        {{--这是主要的侧边栏。--}}
    @show
</div>

<footer>

</footer>
<script src="{{asset('common/js/zepto/zepto.min.js')}}"></script>

@section('script')
    {{--这是js代码。--}}
@show
</body>
</html>