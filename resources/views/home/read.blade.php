@extends('layouts.homemaster')
@section('content')


<article class="blogs">

  
    <h2 class="c_titile">{{$art->art_title}}</h2>
    <p class="box_c"><span class="d_time">发布时间：{{date('Y-m-d H:i:s',$art->create_at)}}</span><span>编辑：{{$art->auther}}</span><span>查看次数：{{$art->view_times}}</span><span>文章类别：{{$art->cate_name}}</a></span></p>
    <ul class="infos">
      {!! $art->art_content !!}
    </ul>
    
    <div class="nextinfo">
      @if($artical['pre'])
          <p>上一篇：<a href="{{url('read').'/'.$artical['pre']->art_id}}">{{$artical['pre']->art_title}}</a></p>
      @else
          <span>上一篇：已经是第一篇了</span>
      @endif
      @if($artical['next'])
          <p>下一篇：<a href="{{url('read').'/'.$artical['next']->art_id}}">{{$artical['next']->art_title}}</a></p>
      @else
          <span>下一篇：已经是最后一篇了</span>
      @endif
  </div>  
</article>

@endsection