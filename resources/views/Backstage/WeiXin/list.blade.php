@extends('Backstage.Common.base')


@section('sidebar')
    <div class="crumbs">
        <span>
            <a>系统</a> /
            <a>微信</a> /
            <a>微信列表</a>

        </span>
    </div>
    <table>
        <thead>
        <tr>
            <th colspan="2" style="width:5%">操作</th>
            <th>公众号名称</th>
            <th>URL</th>
            <th>状态</th>

        </tr>
        </thead>
        <tbody>
        @foreach ($info as $vo)
            <tr>
                <td><i class="fa fa-trash"  data-id="{{$vo->id}}"></i></td>
                <td><i class="fa fa-pencil"></i></td>

                <td>{{$vo->name}}</td>
                <td>{{$vo->url}}</td>
                <td>
                   @if($vo->status == 1)
                       开启
                    @else
                       禁用
                    @endif
                </td>
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