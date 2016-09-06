@extends('layouts.homemaster')
@section('content')

<div class="banner">
  <section class="box">
    <ul class="texts">
      <p>打了死结的青春，捆死一颗苍白绝望的灵魂。</p>
      <p>为自己掘一个坟墓来葬心，红尘一梦，不再追寻。</p>
      <p>加了锁的青春，不会再因谁而推开心门。</p>
    </ul>
    <div class="avatar"><a href="{{url('admin/login')}}"><span>博客管理</span></a> </div>
  </section>
</div>
<div class="template">
    <div class="box">
    
    </div>
    
   
    
  
  
  <article>
      <style>
          .orderby{float:right;font-size: 25px;margin-right: 100px;}
      </style>
      <div class="orderby">
         <p> <a href="{{url('/')}}" class="readmore">按时间排序</a></p>
          <p><a href="{{url('orderbyview')}}" class="readmore">按热度排序</a></p>
      </div>
      
      
      
     <h2 class="title_tj"><p>文章<span>推荐</span></p></h2>
  
      @foreach($articals as $art)
      <div class="bloglist left">
    <h3>{{$art->art_title}}</h3>
    <figure><img src="{{$art->art_thumb}}"></figure>
    <ul>
      <p>{{$art->art_desc}}<h1>...</h1></p>
      <a title="/" href="{{url("read").'/'.$art->art_id}}" target="_blank" class="readmore">阅读全文>></a>
    </ul>
    <p class="dateview"><span>{{date('Y-m-d H:i:s',$art->create_at)}}</span><span>作者：{{$art->auther}}</span><span>浏览次数：{{$art->view_times}}</a></span><span>文章类别：{{$art->cate_name}}</a></span></p>
  </div>
    @endforeach
      
      <div class="page">

          {!! $articals->links() !!}

      </div>
</article>

    
    
    
    
@endsection
    