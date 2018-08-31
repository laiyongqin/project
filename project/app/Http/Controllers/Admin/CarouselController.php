<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class CarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //轮播图列表
        // 查询数据
         $res = DB::table("carousel")->get();
        return view('Admin.Carousel.index', ['res'=>$res] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            //加载添加模板
         return view("Admin.Carousel.add");
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
        // 验证文件是否上传成功 
         if ( ! $request->file('pic1')->isValid()  ) {
            //  上传失败
            return back()->with('success','上传失败');
         }
        // 上传文件被移动后的相对路径
        $res1 = $request->pic1->store('images');
        $res2 = $request->pic2->store('images');
        $res3 = $request->pic3->store('images');
        $res4 = $request->pic4->store('images');
        if ( $res1 ) {
            $data= array (
                 'pic1'=>'/app/'.$res1,
                  'pic2'=>'/app/'.$res2, 
                  'pic3'=>'/app/'.$res3 , 
                  'pic4'=>'/app/'.$res4 
                );
            if( DB::table("carousel")->insert($data) ){
                // 插入数据成功
                $res = '/app/'.$res1;
                return redirect("carousel")->with('success','添加成功');
             }
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
        //   dd($a);
        //判断
        if($a==""){
            echo "请至少选中一条数据";exit;
        }
        //遍历
        foreach($a as $key=>$value){
            DB::table("carousel")->where("id",'=',$value)->delete();
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
        $res = DB::table("carousel")->where("id",'=',$id)->first();
        return view("Admin.Carousel.edit", ['res'=>$res] );
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
        // 验证文件是否上传成功 
        // $res= $request->all();
        // dd($res);
         if ( ! $request->file('pic1')->isValid()  ) {
            //  上传失败
            return back()->with('success','上传失败');
         }
        // 上传文件被移动后的相对路径
        $res1 = $request->pic1->store('images');
        $res2 = $request->pic2->store('images');
        $res3 = $request->pic3->store('images');
        $res4 = $request->pic4->store('images');
        if ( $res1 ) {
            $data= array (
                 'pic1'=>'/app/'.$res1,
                  'pic2'=>'/app/'.$res2, 
                  'pic3'=>'/app/'.$res3 , 
                  'pic4'=>'/app/'.$res4 
                );
            if( DB::table("carousel")->where('id','=',$id)->update($data) ){
                // 跟新数据成功
                $res = '/app/'.$res1;
                return back()->with('imgurl',$res )->with('success','修改成功');
             }
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
           if( DB::table( "carousel" )->where( "id", '=', $id )->delete() ){
            return redirect("/carousel")->with('success','数据删除成功');
        }else{
            return redirect("/carousel")->with('error','数据删除失败');
        }
    }

  
}
