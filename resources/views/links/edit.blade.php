@extends('layouts.master')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/index')}}">首页</a> &raquo;  友情链接编辑
    </div>
    <!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<div>
        <div class="result_title">
            <h3>快捷操作</h3>
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/artical/artadd')}}"><i class="fa fa-plus"></i>新增文章</a>
                <a href="{{url('admin/artical/artlist')}}"><i class="fa fa-refresh"></i>文章列表</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->

    <div class="result_wrap">
        <div class="result_title">
            @if(count($errors) > 0)
                <div class="mark">
                    @foreach($errors->all() as $error)
                        <p> {{$error}}</p>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    
    
    <div>
        <form action="{{url("admin/link/update/$link->link_id")}}" method="post">
            <table class="add_tab">
                <tbody>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <tr>
                        <th><i class="require">*</i>网站名称：</th>
                        <td>
                            <input type="text" size="30" class="lg" name="link_title" value="{{$link->link_title}}">
                            <p>栏目名称最多为30个字符</p>
                        </td>
                    </tr>

                <tr>
                    <th><i class="require">*</i>URL：</th>
                    <td>
                        <input type="text" class="lg" name="link_url" value="{{$link->link_url}}">
                    </td>
                </tr>

                <tr>
                    <th><i class="require">*</i>排序：</th>
                    <td>
                        <input type="text" class="lg" name="link_order" value="{{$link->link_order}}">
                    </td>
                </tr>
                
                    
                    <tr>
                        <th></th>
                        <td>
                            <input type="submit" id="sub" value="确认修改">
                            <input type="button" class="back" onclick="history.go(-1)" value="返回">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

    
@endsection


