@extends('layouts.master')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 文章列表
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
                        <th class="tc">ID</th>
                        <th>标题</th>
                        <th>作者</th>
                        <th>查看次数</th>
                        <th>缩略图</th>
                        <th>创建时间</th>
                        <th>更新时间</th>
                        <th>发布时间</th>
                        <th>操作</th>
                        
                    </tr>
                    @foreach($date as $art)
                        
                    <tr>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <td class="tc">{{$art->art_id}}</td>
                        <td>
                            <a href="#">{{$art->art_title}}</a>
                        </td>
                        <td>{{$art->auther}}</td>
                        <td>{{$art->view_times}}</td>
                        <td><img src="/{{$art->art_thumb}}" alt="" id="art_thumb_img" style="max-width: 350px; max-height:100px;"></td>
                        
                        <td>{{date('Y-m-d H:i:s',$art->create_at)}}</td>
                        <td>{{date('Y-m-d H:i:s',$art->update_at)}}</td>
                        <td>{{$art->published_at}}</td>
                       
                        <td>
                            <a href="{{url("admin/artical/edit/$art->art_id")}}">修改</a><pre> </pre><a href="javascript:;" onclick="del({{$art->art_id}})"  >删除</a>
                        </td>
                    </tr>
                    
                    @endforeach
                </table>
                
                <div class="page_list">
                    <ul>
                        {!! $date->links() !!}
                    </ul>
                </div>
            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->
    <style>
        .result_content ul li span{
            font-size: 15px;
            padding: 6px 12px;
        }
        </style>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        function del(art_id) {
            layer.confirm('确定删除此分类？',{
                btn:['确定','取消']
            },function(){
                $.ajax({
                    'url': "{{url("admin/artical/artdel")}}/"+art_id,
                    'type':"POST",
                    'dateType':"json",
                    'data': { 'art_id':art_id},

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

