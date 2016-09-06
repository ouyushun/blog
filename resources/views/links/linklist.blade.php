@extends('layouts.master')
@section('content')
    <style>
        .result_content ul li span{
            font-size: 15px;
            padding: 6px 12px;
        }
    </style>
   
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 友情链接列表
    </div>
    <!--面包屑导航 结束-->
	<!--结果页快捷搜索框 开始-->
	
    <!--结果页快捷搜索框 结束-->

    <!--搜索结果页面 列表 开始-->
    <form action="" method="post">
        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/artical/artadd')}}"><i class="fa fa-plus"></i>新增文章</a>
                    <a href="{{url('admin/artical/artlist')}}"><i class="fa fa-refresh"></i>文章列表</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc">排序</th>
                        <th>ID</th>
                        <th>名称</th>
                        <th>url</th>
                        <th>点击次数</th>
                        <th>操作</th>
                        
                    </tr>
                    @foreach($links as $link)
                        
                    <tr>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <td class="tc">
                            <input type="text" onchange="changeOrder(this,{{$link->link_id}})" name="ord[]" value ='{{$link->link_order}}'>
                        </td> 
                        <td class="tc">{{$link->link_id}}</td>
                        <td><a href="#">{{$link->link_title}}</a></td>
                        <td>{{$link->link_url}}</td>
                        <td>{{$link->view_times}}</td>
                        <td>
                            <a href="{{url("admin/link/edit/$link->link_id")}}">修改</a><pre> </pre>
                            <a href="javascript:;" onclick="del({{$link->link_id}})"  >删除</a>
                        </td>
                    </tr>
                    
                    @endforeach
                </table>
                
                <div class="page_list">
                    <ul>
                        {!! $links->links() !!}
                    </ul>
                </div>
            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function changeOrder(obj,link_id) {
            var orig_order = $(obj).val();
            $.ajax({
                'url': "{{url('admin/link/changeOrder')}}",
                'type':"POST",
                'dateType':"json",
                'data': { 'orig_order':orig_order ,'link_id':link_id},
                success:function(date){
                    layer.msg(date.msg, {icon: 6});
                },error:function(date){
                    layer.msg(date.msg, {icon: 5});
                }
            }); //end of ajax
        }
        
        
        function del(link_id) {
            layer.confirm('确定删除此链接？',{
                btn:['确定','取消']
            },function(){
                $.ajax({
                    'url': "{{url("admin/link/del")}}/"+link_id,
                    'type':"POST",
                    'dateType':"json",
                    'data': { 'link_id':link_id},

                    success:function(date){
                        location.href = location.href;
                        layer.msg(date.msg, {icon: 6});
                    },
                    error:function(date){
                        layer.msg(date.msg, {icon: 5});
                    }
                }); //end of ajax
            },function(){

            })
        }

    </script>
@endsection   

