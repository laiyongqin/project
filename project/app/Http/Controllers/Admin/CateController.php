<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class CateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getcates(){
        //获取列表数据
        // $cate=DB::select("select *,concat(path,',',id) as paths from cates order by paths");
        //连贯方法结合原始表达式 防止sql语句注入
        $cate=DB::table("cates")->select(DB::raw('*,concat(path,",",id) as paths'))->orderBy('paths')->get();
        //遍历
        foreach($cate as $key=>$value){
            // echo $value->path."<br>";
            //转换为数组
            $arr=explode(",",$value->path);
            // echo "<pre>";
            // var_dump($arr);
            //获取逗号个数
            $len=count($arr)-1;
            //字符串重复函数
            $cate[$key]->name=str_repeat("--|",$len).$value->name;
        }
        return $cate;
    }


    public function index(Request $request)
    {
        //获取列表数据
        // $cate=DB::select("select *,concat(path,',',id) as paths from cates order by paths");
        //连贯方法结合原始表达式 防止sql语句注入
        $cate=DB::table("cates")->select(DB::raw('*,concat(path,",",id) as paths'))->where('name','like',"%".$request->input('keywords')."%")->orderBy('paths')->paginate(3);
        //遍历
        foreach($cate as $key=>$value){
            // echo $value->path."<br>";
            //转换为数组
            $arr=explode(",",$value->path);
            // echo "<pre>";
            // var_dump($arr);
            //获取逗号个数
            $len=count($arr)-1;
            //字符串重复函数
            $cate[$key]->name=str_repeat("--|",$len).$value->name;
        }
        //加载模板 分配数据
        return view("Admin.Cate.index",['cate'=>$cate,'request'=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //获取所有分类信息
        $cate=$this->getcates();
        //加载添加模板
        return view("Admin.Cate.add",['cate'=>$cate]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        //获取需要添加的数据
        $data=$request->only(['name','pid']);
        //获取pid
        $pid=$request->input('pid');
        // dd($pid);
        //添加顶级分类信息
        if($pid==0){
            // dd($data);
            //拼接path
            $data['path']='0';
        }else{
            //添加子类信息
            // dd($data);
            //获取父类信息
            $info=DB::table("cates")->where('id','=',$pid)->first();
            //拼接path
            $data['path']=$info->path.",".$info->id;
        }

        // dd($data);
        //执行数据库的插入
        if(DB::table("cates")->insert($data)){
            // echo "ok";
            return redirect("/admincates")->with('success','分类添加成功');
        }else{
            return back()->with("error",'分类添加失败');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //获取id
        // echo $id;
        //获取删除分类的子类个数
        $res=DB::table("cates")->where('pid','=',$id)->count();
        // echo $res;
        //判断
        if($res>0){
            return back()->with('error','请先干掉孩子');
        }

        //直接删除当前分类信息
        if(DB::table("cates")->where("id",'=',$id)->delete()){
            return redirect("/admincates")->with("success",'删除成功');
        }else{
            return redirect("/admincates")->with("error",'删除失败');
        }
    }
}
