<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{!! csrf_token() !!}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <link href="{{asset("backstage/css/base.css")}}"  type="text/css" rel="stylesheet" />

    {{--<link href="//cdn.bootcss.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">--}}
    <link href="{{asset('common/css/font-awesome.min.css')}}" type="text/css" rel="stylesheet">

</head>
<style>
    .nav-vertical-item li:hover,.theme-black-bg,.nav li:hover,body{
        background-color: #2a313b;
    }
    #mainBody{
        color:#fff;
    }

</style>
<body>

<div id="mainBody" class="theme-black-bg ">

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