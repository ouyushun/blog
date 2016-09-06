@extends('layouts.master')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 栏目列表
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
                        <th class="tc">ID</th>
                        <th>栏目</th>
                        <th>文章标题</th>
                        <th>查看次数</th>
                        <th>创建时间</th>
                        <th>更新时间</th>
                        <th>发布时间</th>
                        <th>操作</th>
                        
                    </tr>
                    @foreach($date as $cate)
                        
                    <tr>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <td class="tc">
                            <input type="text" onchange="changeOrder(this,{{$cate->cate_id}})" name="ord[]" value ='{{$cate->cate_order}}'>
                        </td>
                        <td class="tc">{{$cate->cate_id}}</td>
                        <td>
                            <a href="#">{{$cate->cate_name}}</a>
                        </td>
                        <td>{{$cate->cate_title}}</td>
                        <td>{{$cate->cate_view}}</td>
                        <td>{{$cate->create_at}}</td>
                        <td>{{$cate->update_at}}</td>
                        <td>{{$cate->publish_at}}</td>
                        <td>
                            <a href="{{url("admin/cateedit/$cate->cate_id")}}">修改</a><pre> </pre><a href="javascript:;" onclick="delcate({{$cate->cate_id}})">删除</a>
                        </td>
                    </tr>
                    
                    @endforeach
                </table>


<div class="page_nav">
<div>
<a class="first" href="/wysls/index.php/Admin/Tag/index/p/1.html">第一页</a> 
<a class="prev" href="/wysls/index.php/Admin/Tag/index/p/7.html">上一页</a> 
<a class="num" href="/wysls/index.php/Admin/Tag/index/p/6.html">6</a>
<a class="num" href="/wysls/index.php/Admin/Tag/index/p/7.html">7</a>
<span class="current">8</span>
<a class="num" href="/wysls/index.php/Admin/Tag/index/p/9.html">9</a>
<a class="num" href="/wysls/index.php/Admin/Tag/index/p/10.html">10</a> 
<a class="next" href="/wysls/index.php/Admin/Tag/index/p/9.html">下一页</a> 
<a class="end" href="/wysls/index.php/Admin/Tag/index/p/11.html">最后一页</a> 
<span class="rows">11 条记录</span>
</div>
</div>



                <div class="page_list">
                    <ul>
                        <li class="disabled"><a href="#">&laquo;</a></li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#">&raquo;</a></li>
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
            function changeOrder(obj,cate_id) {
                var orig_order = $(obj).val();
                $.ajax({
                    'url': "{{url('admin/changeOrder')}}",
                    'type':"POST",
                    'dateType':"json",
                    'data': { 'orig_order':orig_order ,'cate_id':cate_id},
                    success:function(date){
                        layer.msg('修改成功', {icon: 6});
                    },error:function(date){
                        layer.msg('不开心。。', {icon: 5});
                    }
                }); //end of ajax
            }
            
            function delcate(cate_id) {
                layer.confirm('确定删除此分类？',{
                    btn:['确定','取消']
                },function(){
                    $.ajax({
                        'url': "{{url('admin/delcate')}}"+'/'+cate_id,
                        'type':"POST",
                        'dateType':"json",
                        'data': { 'cate_id':cate_id},
                        
                        success:function(date){
                            location.href = location.href;
                            layer.msg(date.msg, {icon: 6});
                        },error:function(date){
                            layer.msg(date.msg, {icon: 5});
                        }
                    }); //end of ajax
                },function(){
                    
                })
            }
            
            
    </script>
@endsection   

