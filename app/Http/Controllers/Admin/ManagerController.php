<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;


//use Illuminate\Http\Request;
//instead of  use App\Http\Requests\Request;
use App\Model\Manager;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
//use Illuminate\Validation\Validator;
//use \Validator;
use Illuminate\Support\Facades\Validator;
class ManagerController extends Controller
{
    public function login(){
        $input = Input::all();
        
        if($input){
            $password = $input['password'];
            $username = $input['username'];
            $code = strtolower($input['code']);
            $getcode = session('code');
            //$getcode = $_SESSION['code'];
            if($code != $getcode){
                return back()->with('msg','验证码错误');
            }
            
            $manager = Manager::where('user_name',$username)->first();
            
           /* if($manager->user_name != $username || Crypt::decrypt($manager->password) != $password){
                return back()->with('msg','用户名或密码错误！');
            }
            return '登陆成功';*/
            
            if( $manager == null){
                return back()->with('msg','用户名不存在');
            }
            if(Crypt::decrypt($manager->password) != $password){
                return back()->with('msg','用户名或密码不正确');
            }
            /*
             * 将登录信息保存至session
             */
            
            session(['manager'=>$manager]);
            return redirect('admin/index');
            
        }else{
            return view('admin/login');
        }
      
       
    }

    public function validateCode(){
        $validatecode = new \App\Tool\Validate\ValidateCode;
        $pic = $validatecode -> doimg();
        $code = $validatecode->getCode();
        session(['code'=>$code]);
        
        /*
         * 将生成的验证码先存入session中，以便验证时使用
         * 如果使用原生$_SESSION时，需要在入口文件开启   session_start();
         * */
        //$_SESSION['code'] = $code;
        return  $pic;
    }
    
    public function logout()
    {
        session(['manager'=>null]);
        return redirect(url('admin/login'));
    }
    
    /*
     * 展示表单
     */
    public function modifypassword()
    {
        if ($input = Input::all()) {
            $rules = [
                'newpassword' => 'required|between:6,20|confirmed',
            ];
            $msg = [
                'newpassword.required' => '新密码不能为空',
                'newpassword.between' => '密码在6至20位之间',
                'newpassword.confirmed' => '新密码与确认密码不一致',
            ];
            $validator = Validator::make($input, $rules, $msg);
            if ($validator->passes()) {
                $sess_manager = session('manager');
                $sess_name = $sess_manager->user_name;
                $sess_pass = $sess_manager->password;
                $manager = Manager::where('user_name',$sess_name)->where('password',$sess_pass)->first();
                $orig_password = Crypt::decrypt($manager->password);
                $_pass = $input['oldpassword'];
                if($orig_password == $_pass){
                    $manager->password = Crypt::encrypt($input['newpassword']);
                    $manager->update();
                    return redirect('admin/index');
                }else{
                    return view('admin.modifypassword')->withErrors('原密码错误');
                }
            } else { 
                return view('admin.modifypassword')->withErrors($validator);
            }
        }else{
                return view('admin.modifypassword');
            }
    }
    /*
     * 修改密码表单数据提交至此。
     */
    /*public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'newpassword' => 'required|between:6,20|confirmed',
        ]);
        // 验证通过,存储到数据库...
        
    }*/
}
