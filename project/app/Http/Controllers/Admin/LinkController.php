<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //友情链接列表
        // 查询数据
         $link = DB::table("youqin")->get();
        return view('Admin.Link.index', ['link'=>$link] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //加载添加模板
         return view("Admin.Link.add");

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //执行添加
        dd($request);
         $data=$request->all(['yqname','yq_url']);
        if(DB::table("youqin")->insert($data)){
            return redirect("/adminlink")->with('success','添加成功');
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
         //Ajax 批量删除
         $a=$request->input('a');
        //判断
        if($a==""){
            echo "请至少选中一条数据";exit;
        }
        //遍历
        foreach($a as $key=>$value){
            DB::table("youqin")->where("id",'=',$value)->delete();
        }
        echo 1;

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
        $link=DB::table("youqin")->where("id",'=',$id)->first();
        return view("Admin.Link.edit",['link'=>$link]);

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
           $data=$request->all(['yqname','yq_url','status']);
        //密码加密
        if ( DB::table("youqin")->where("id","=",$id)->update($data) ){
            return redirect("/adminlink")->with('success',"修改成功");
        }else{
            return redirect("/adminlink/$id",'数据修改失败');
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
        //删除数据
           if( DB::table( "youqin" )->where( "id", '=', $id )->delete() ){
            return redirect("/adminlink")->with('success','数据删除成功');
        }else{
            return redirect("/adminlink")->with('error','数据删除失败');
        }
    }
}
