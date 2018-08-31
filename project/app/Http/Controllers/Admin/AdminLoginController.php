<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
class AdminLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
             // 判断session
            if (   session('name') ) {
                //跳到后台路由
                return redirect("/admin")->with('success','登录成功');
            } else {
            //  跳到后台登陆路由
            return redirect("/adminlogin/create");
         } 
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        //加载后台登录模板
        return view("Admin.Login.login");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //根据输入的用户名获取用户信息
        $user=DB::table("admin_users")->where( "name",'=',$request->input('name') )->first();
       
        //检测用户名
        if($user){
           //检测密码
           if( Hash::check( $request->input('password'), $user->password ) ){
                // 记录session
                session( ['id'=>$user->id] );
                session( ['name'=>$user->name] );
                return redirect("/admin")->with('success','登录成功');
           }else{
            return back()->with('perror','密码有误');
           }
        }else{
            return back()->with('uerror',"用户名有误");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //销毁session
        // 退出登录 
        $request->session()->pull('id');
        $request->session()->pull('name');
        return redirect("/adminlogin/create");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //获取需要修改的数据
        //加载修改模板
          $user=DB::table("admin_users")->where( "id",'=',session('id') )->first();
        return view("Admin.Login.edit",['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //执行修改
         $data=$request->except(['_token','_method']);
        //密码加密
        $data['password']=Hash::make($data['password']);
        if( DB::table("admin_users")->where("id","=", session('id') )->update($data) ){
            return back()->with('success',"修改成功");
        }else{
            return back()->with('error',"修改失败");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
