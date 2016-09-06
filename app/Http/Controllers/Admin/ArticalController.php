<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
use App\Model\Artical;
use App\Model\Category;
use Request,Validator;
//use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class ArticalController extends Controller
{
    public function artlist()
    {
        $artical = Artical::orderBy('art_id','desc')->paginate(5);
        return view('artical/artlist')->with('date',$artical);
    }

    public function artadd()
    {
        $categories = Category::all();
        if($request = Request::except('_token')) {

            $request['create_at'] = time();

            $rules = [
                'art_title' => 'required|between:2,100',
                'art_content' => 'required',
            ];
            $msg = [
                'art_title.required' => '栏目名不能为空',
                'art_title.between' => '字符数2-100个',
                'art_content.required' => '正文不能为空'
            ];

            $validator = Validator::make($request, $rules, $msg);

            if ($validator->passes()) {
                $re = Artical::create($request);
                if ($re) {
                    return redirect('admin/artical/artlist');
                } else {
                    return redirect('admin/artical/artadd')->withErrors('服务器错误');
                }

            } else {
                return view('artical/artadd',compact('categories'))->withErrors($validator);
            }
        }else{
            return view('artical/artadd',compact('categories'));
        }    
    }

    public function edit($art_id)
    {
        $art = Artical::find($art_id);
        $categories = Category::all();
        
        return view('artical/edit',compact('art','categories'));
    }

    public function update($art_id)
    {
        $request = Request::except('_token');
        $request['update_at'] = time();
        $rules = [
            'art_title' => 'required|between:2,100',
            'art_content' => 'required',
        ];
        $msg = [
            'art_title.required' => '栏目名不能为空',
            'art_title.between' => '字符数2-100个',
            'art_content.required' => '正文不能为空'
        ];
        $validator = Validator::make($request, $rules, $msg);
        if ($validator->passes()) {
            $re = Artical::where('art_id',$art_id)->update($request);
            if ($re) {
                return redirect('admin/artical/artlist');
            } else {
                return redirect('admin/artical/edit')->withErrors('服务器错误');
            }

        } else {
            $art = Artical::find($art_id);
            $categories = Category::all();

            return view('artical/edit',compact('art','categories'))->withErrors($validator);
            
        }
    }
    
    
    //处理图片上传的函数
    public function upload()
    {
        $file = Request::file('Filedata');

        if ($file->isValid()) {


            //$clientName = $file -> getClientOriginalName();  //获取文件名称
            //$tmpName = $file ->getFileName(); // 缓存在tmp文件夹中的文件名 例如 php9372.tmp 这种类型的.
            //$realPath = $file -> getRealPath();    //这个表示的是缓存在tmp文件夹下的文件的绝对路径，
            $entension = $file->getClientOriginalExtension(); //上传文件的后缀.
            //$mimeTye = file -> getMimeType();//大家对mimeType应该不陌生了. 我得到的结果是 image/jpeg.
            $newName = date('Y-m-d') . '-' . mt_rand(100, 999) . '.' . $entension;
            $file->move(base_path() . '\public\uploads', $newName);
            $filepath = 'uploads/' . $newName;

            return $filepath;
        }
    }

    public function artdel($art_id)
    {
        $re = Artical::where('art_id',$art_id)->delete();
        if($re){
            $date = [
                'status' => 0,
                'msg' => '文章删除成功^_^',
            ];
        }else{
            $date = [
                'status' => 1,
                'msg' => '文章删除失败^┭^',
            ];
        }
        return $date;
    }
}
