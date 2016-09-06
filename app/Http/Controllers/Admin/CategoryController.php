<?php

namespace App\Http\Controllers\Admin;

use App\Model\Category;
//use Illuminate\Http\Request;
//use Illuminate\Validation\Validator;
use Validator;
use Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class CategoryController extends Controller
{
    public function catelist()
    {
        $categorys =  Category::orderBy('cate_order','asc')->paginate(5);
        return view('category.cate_list')->with('date',$categorys);
    }

    public function changeOrder()
    {
        $request = Input:: all();
        $cate = Category::find($request['cate_id']);
        $cate->cate_order = $request['orig_order'];
        $re = $cate->update();
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

    public function cateadd()
    {
        if ($request = Request::except('_token')) {
            $rules = [
                'newcategory' => 'required|between:2,10',
            ];
            $msg = [
                'newcategory.required' => '栏目名不能为空',
                'newcategory.between' => '字符数2-10个',
            ];

            $validator = Validator::make($request, $rules, $msg);

            if ($validator->passes()) {
                $category = new Category();
                $newcategory = $request['newcategory'];
                $re = $category->create(['cate_name'=> $newcategory]);
                if($re){
                    return redirect('admin/catelist');
                }else{
                    return redirect('admin/cateadd')->withErrors('出现错误');
                }

            } else {
                return view('category/cateadd')->withErrors($validator);
            }
        }else{
            return view('category/cateadd');
        }
    }

    public function cateedit($cate_id)
    {
        $category = Category::find($cate_id);
        //$name = $category->cate_name;

        return view('category/cateedit',compact('category'));
    }


    public function cateupdate($cate_id)
    {
        $request = Request::all();
        $rules = [
            'newcategory' => 'required|between:2,10',
        ];
        $msg = [
            'newcategory.required' => '栏目名不能为空',
            'newcategory.between' => '字符数2-10个',
        ];
        $validator = Validator::make($request, $rules, $msg);
        if ($validator->passes()) {
            $category = Category::find($cate_id);
            $newname = $request['newcategory'];
            $re = $category->update(['cate_name'=>$newname]);
            if($re){
                return redirect('admin/catelist');
            }else{
                return redirect('admin/cateedit')->withErrors('出现错误');
            }

        } else {
            return view('category/cateadd')->withErrors($validator);
        }
    }

    public function delCate($cate_id)
    {
        $re = Category::where('cate_id',$cate_id)->delete();
        if($re){
            $date = [
                'status' => 0,
                'msg' => '修改成功chengg',
            ];
        }else{
            $date = [
                'status' => 1,
                'msg' => '修改失败sssbbb',
            ];
        }
        return $date;
    }


}
