<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class GonggaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //公告列表
        // 查询数据
         $gonggao = DB::table("gonggao")->get();
        //  dd($gonggao);
        return view('Admin.Gonggao.index', ['gonggao'=>$gonggao] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       //加载添加模板
         return view("Admin.Gonggao.add");
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
         $data=$request->all(['gname','gcontent']);
        //  dd($data);
        if(DB::table("gonggao")->insert($data)){
            return redirect("/admingonggao")->with('success','添加成功');
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
        //  echo $a;die();
        //判断
        if($a==""){
            echo "请至少选中一条数据";exit;
        }
        //遍历
        foreach($a as $key=>$value){
            DB::table("gonggao")->where("gid",'=',$value)->delete();
        }
        echo 1;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $gid)
    {
       //获取需要修改的数据
        //加载修改模板
        $res = DB::table("gonggao")->where("gid",'=',$gid)->first();
        if ( $request->input('info') ) {
            return view( "Admin.Gonggao.info", ['res'=>$res] );
        }
        return view( "Admin.Gonggao.edit", ['res'=>$res] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $gid)
    {
       //执行修改
           $data=$request->all(['gname','gcontent']);
        if( DB::table("gonggao")->where("gid","=",$gid)->update($data) ){
            return redirect("/admingonggao")->with('success',"修改成功");
        }else{
            return redirect("/admingonggao")->with('error',"修改失败");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($gid)
    {
        //删除数据
           if(DB::table("gonggao")->where("gid",'=',$gid)->delete()){
            return redirect("/admingonggao")->with('success', '数据删除成功');
        }else{
            return redirect("/admingonggao")->with('error',  '数据删除失败');
        }
    }
}
