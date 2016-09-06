@extends('layouts.master')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/index')}}">首页</a> &raquo; <a href="{{url('admin/catelist')}}">栏目列表</a> &raquo; 添加栏目
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
        <form action="" method="post" enctype="multipart/form-data">
            <table class="add_tab">
                <tbody>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <tr>
                        <th><i class="require">*</i>文章标题：</th>
                        <td>
                            <input type="text" size="20" class="lg" name="art_title">
                            <p>栏目名称最多为20个字符</p>
                        </td>
                    </tr>

                <tr>
                    <th><i class="require">*</i>作者：</th>
                    <td>
                        <input type="text" class="lg" name="auther">
                    </td>
                </tr>

                <tr>
                    <th><i class="require">*</i>文章分类：</th>
                    <td>
                        <select name="cate_id" class="require">
                            <option value="0">--文章分类--</option>
                            @foreach($categories as $cate)
                                <option value="{{$cate->cate_id}}"   > {{$cate->cate_name}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>

                <tr>
                    <th>缩略图：</th>
                    <td>
                        <input type="text" size="50" name="art_thumb">
                        <input id="file_upload" name="file_upload" type="file" multiple="true">
                        <script src="{{asset('uploadify/jquery.uploadify.min.js')}}" type="text/javascript"></script>
                        <link rel="stylesheet" type="text/css" href="{{asset('uploadify/uploadify.css')}}">
                        <script type="text/javascript">
                            <?php $timestamp = time();?>
                            $(function() {
                                $('#file_upload').uploadify({
                                    'buttonText' : '图片上传',
                                    'formData'     : {
                                        'timestamp' : '<?php echo $timestamp;?>',
                                        '_token'     : "{{csrf_token()}}"
                                    },
                                    'swf'      : "{{asset('uploadify/uploadify.swf')}}",
                                    'uploader' : "{{url('admin/artical/upload')}}",
                                    'onUploadSuccess' : function(file, data, response) {
                                        $('input[name=art_thumb]').val(data);
                                        $('#art_thumb_img').attr('src','/'+data);

                                    }
                                });
                            });
                        </script>
                        <style>
                            .uploadify{display:inline-block;}
                            .uploadify-button{border:none; border-radius:5px; margin-top:8px;}
                            table.add_tab tr td span.uploadify-button-text{color: #FFF; margin:0;}
                        </style>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <img src="" alt="" id="art_thumb_img" style="max-width: 350px; max-height:100px;">
                    </td>
                </tr>
                
                <tr>
                    <th><i class="require">*</i>描述：</th>
                    <td>
                        <textarea name="art_desc"></textarea> 
                        <p>描述最多为50个字符</p>
                    </td>
                </tr>

                <tr>
                    <th>文章内容：</th>
                    <td>
                        <script type="text/javascript" charset="utf-8" src="{{asset('ueditor/ueditor.config.js')}}"></script>
                        <script type="text/javascript" charset="utf-8" src="{{asset('ueditor/ueditor.all.min.js')}}"> </script>
                        <script type="text/javascript" charset="utf-8" src="{{asset('ueditor/lang/zh-cn/zh-cn.js')}}"></script>
                        <script id="editor" name="art_content" type="text/plain" style="width:860px;height:500px;"></script>
                        <script type="text/javascript">
                            var ue = UE.getEditor('editor');
                        </script>
                        <style>
                            .edui-default{line-height: 28px;}
                            div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
                            {overflow: hidden; height:20px;}
                            div.edui-box{overflow: hidden; height:22px;}
                        </style>
                    </td>
                </tr>
                    
                    <tr>
                        <th></th>
                        <td>
                            <input type="submit" id="sub" value="提交">
                            <input type="button" class="back" onclick="history.go(-1)" value="返回">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

    
@endsection


