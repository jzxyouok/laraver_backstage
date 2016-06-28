@extends('Backstage.Common.base')


@section('sidebar')
    <div class="crumbs">
        <span>
            <a>系统</a> /
            <a>微信</a> /
            <a>文章列表</a>
            <a href="/weixin/addArticle">添加</a>
        </span>
    </div>
    <table>
        <thead>
        <tr>
            <th colspan="2" style="width:5%">操作</th>
            <th>标题</th>
            <th>阅读量</th>
            <th>点赞数</th>
            <th>文章时间</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($info as $vo)
            <tr>
                <td><i class="fa fa-trash"  data-id="{{$vo->id}}"></i></td>
                <td><i class="fa fa-pencil"></i></td>
                <td>{!!$vo->title!!}</td>
                <td>{{$vo->readNum}}</td>
                <td>{{$vo->startNum}}</td>
                <td>{{$vo->time}}</td>
            </tr>

        @endforeach


        </tbody>
    </table>
    <div class="page">

        {{$info->links()}}
    </div>

@endsection

@section('script')
    <script>
$(".fa-trash").bind("click",function(){
    var id = $(this).attr("data-id");
    if(confirm("是否确认删除？"))
    {
        $.ajax({
            url:"/weixin/delete",
            type:"post",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{
                'id': id
            },
            success:function(data){
                if(data.status == 1)
                {
                    window.history.go(0);
                }

            },
            error:function(){
                alert("网络出现问题");
            }

        });
    }

})

    </script>
@endsection