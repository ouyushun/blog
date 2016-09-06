﻿<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>BLOG</title>
<meta name="keywords" content="blog" />
<meta name="description" content="" />
<link href="{{asset('homestyle/css/base.css')}}" rel="stylesheet">
<link href="{{asset('homestyle/css/index.css')}}" rel="stylesheet">
  <link href="{{asset('homestyle/css/new.css')}}" rel="stylesheet">
  <link href="{{asset('homestyle/css/style.css')}}" rel="stylesheet">
<!--[if lt IE 9]>
<script src="{{asset('homestyle/js/modernizr.js')}}"></script>
  
<![endif]-->
</head>
<body>
<header>
  <div id="logo"><a href="/"></a></div>
  <nav class="topnav" id="topnav">
    <a href="index.html"><span>首页</span><span class="en">Protal</span></a>
    <a href="about.html"><span>关于我</span><span class="en">About</span></a>
    <a href="newlist.html"><span>慢生活</span><span class="en">Life</span></a>
    <a href="moodlist.html"><span>碎言碎语</span><span class="en">Doing</span></a>
    <a href="knowledge.html"><span>学无止境</span><span class="en">Learn</span></a>
    <a href="book.html"><span>留言版</span><span class="en">Gustbook</span></a></nav>
  </nav>
</header>

@yield('content')

<footer>
  
</footer>
</body>
</html>
