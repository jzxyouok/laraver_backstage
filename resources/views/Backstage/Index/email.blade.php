
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{!! csrf_token() !!}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <link href="{{asset("backstage/css/base.css")}}"  type="text/css" rel="stylesheet" />
    <link href="//cdn.bootcss.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
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

    <table style="margin: 20px 0; width:100%" border="1">
        <thead>
        <tr>
            <th>公众号</th>
            <th>标题</th>
            <th style="width:20%;">阅读量</th>
        </thead>
        <tbody>

        @foreach ($info as $vo)
            <tr>
                <td>{{$vo->belong}}</td>
                <td>{!!$vo->title!!}</td>
                <td style="text-align: center">{{$vo->readNum}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<footer>

</footer>


</body>
</html>



