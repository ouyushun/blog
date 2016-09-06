<?php

namespace App\Http\Controllers\Home;

use App\Model\Artical;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $articals = Artical::leftjoin('category','artical.cate_id','=','category.cate_id')->orderBy('art_id','asc')->paginate(2);
        
        return view('home/index',compact('articals'));
    }

    public function orderbyview()
    {
        $articals = Artical::orderBy('view_times','desc')->paginate(2);

        return view('home/index',compact('articals'));
    }

    public function read($art_id)
    {
        $art = Artical::leftjoin('category','artical.cate_id','=','category.cate_id')->find($art_id);
        Artical::where('art_id',$art_id)->increment('view_times');
        $artical['pre'] = Artical::where('art_id','<',$art_id)->orderBy('art_id','desc')->first();
        $artical['next'] = $pre = Artical::where('art_id','>',$art_id)->orderBy('art_id','asc')->first();
        return view('home.read',compact('art','artical'));
    }

    
}
