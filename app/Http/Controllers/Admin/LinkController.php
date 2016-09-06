<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Links;
//use Illuminate\Http\Request;
use Request,Validator;
use App\Http\Requests;

class LinkController extends Controller
{
    public function linklist()
    {
        $links = Links::orderBy('link_order','asc')->paginate(3);
        
        
        return view('links/linklist')->with('links',$links);
    }

    public function changeOrder()
    {
        $request = Request::all();

        $link = Links::find($request['link_id']);
        $link->link_order = $request['orig_order'];
        $re = $link->update();
        if($re){
            $date = [
                'status' => 0,
                'msg' => '修改成功wwwww',
            ];
        }else{
            $date = [
                'status' => 1,
                'msg' => '修改失败ccccc',
            ];
        }
        return $date;
    }

    public function addlink()
    {
        $links = Links::all();
        if($request = Request::except('_token')) {
            
            $rules = [
                'link_title' => 'required|between:2,30',
                'link_url' => 'required',
            ];
            $msg = [
                'link_title.required' => '栏目名不能为空',
                'link_title.between' => '字符数2-100个',
                'link_url.required' => '正文不能为空'
            ];

            $validator = Validator::make($request, $rules, $msg);

            if ($validator->passes()) {
                $re = Links::create($request);
                if ($re) {
                    return redirect('admin/link/list');
                } else {
                    return redirect('admin/link/addlink')->withErrors('服务器错误');
                }

            } else {
                return view('links/addlink')->withErrors($validator);
            }
        }else{
            return view('links/addlink');
        }
    }
    
    
    public function edit($link_id)
    {
        $link = Links::find($link_id);
        return view('links/edit',compact('link'));
    }

    public function update($link_id)
    {
        $request = Request::except('_token');
        $rules = [
            'link_title' => 'required|between:2,30',
            'link_url' => 'required',
        ];
        $msg = [
            'link_title.required' => '网站名称不能为空',
            'link_title.between' => '字符数2-30个',
            'link_url.required' => '请输入url'
        ];
        $validator = Validator::make($request, $rules, $msg);
        if ($validator->passes()) {
            $re = Links::where('link_id',$link_id)->update($request);
            if ($re) {
                return redirect('admin/link/list');
            } else {
                return view('links/edit')->withErrors('服务器错误');
            }

        } else {
            $link = Links::find($link_id);
            return view('links/edit',compact('link'))->withErrors($validator);

        }
    }

    public function del($link_id)
    {
        $re = Links::where('link_id',$link_id)->delete();
        if($re){
            $date = [
                'status' => 0,
                'msg' => '链接删除成功^_^',
            ];
        }else{
            $date = [
                'status' => 1,
                'msg' => '链接删除失败^┭^',
            ];
        }
        return $date;
    }
}
