<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
//导入Hash类
use Hash;
//导入校验类
use App\Http\Requests\UserInsert;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //获取搜索关键词
        $k=$request->input('keywords');
        //获取列表数据
        $user=DB::table("users")->where("uname",'like',"%".$k."%")->paginate(3);
        //加载模板
        return view("Admin.Users.index",['user'=>$user,'request'=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //添加界面
        // echo "this is add";
        return view("Admin.Users.add");
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserInsert $request)
    {
        // dd($request->all());
        $data=$request->except(['repassword','_token']);
        //对密码做加密
        $data['password']=Hash::make($data['password']);
        $data['status']=1;
        $data['token']=str_random(50);
        // dd($data);
        if(DB::table("users")->insert($data)){
            return redirect("/adminusers")->with('success','数据添加成功');
        }else{
            return redirect("/adminusers/create")->with('error','数据添加失败');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // echo "这是修改数据的id:".$id;
        //获取需要修改的数据
        $user=DB::table("users")->where("id",'=',$id)->first();
        return view("Admin.Users.edit",['user'=>$user]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //执行修改
    public function update(Request $request, $id)
    {
       // dd($request->all());
        $data=$request->except(['_token','_method']);
        //密码加密
        $data['password']=Hash::make($data['password']);
        if(DB::table("users")->where("id","=",$id)->update($data)){
            return redirect("/adminusers")->with('success',"修改成功");
        }else{
            return redirect("/adminusers/$id",'数据修改失败');
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
        // echo $id;
        if(DB::table("users")->where("id",'=',$id)->delete()){
            return redirect("/adminusers")->with('success','数据删除成功');
        }else{
            return redirect("/adminusers")->with('error','数据删除失败');
        }
    }

    //删除
    public function del(Request $request){
        $id=$request->input('id');
        // echo $id;
        if(DB::table("users")->where("id",'=',$id)->delete()){
            echo 1;
        }else{
            echo 0;
        }
    }
}
