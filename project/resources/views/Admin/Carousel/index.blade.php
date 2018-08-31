@extends('Admin.AdminPublic.public')
@section("admin")


 <script type="text/javascript" src="/static/admin/js/libs/jquery-1.9.1.min.js"></script>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span><i class="icon-table"></i></span>
   </div> 
   <div class="btn-toolbar">
      <div class="btn-group">
          <a  href="javascript:void(0)" class="btn btn-success allchoose"><i class="icol-accept "></i>全选</a>
          <a  href="javascript:void(0)" class="btn btn-success nochoose"><i class="icol-cross "></i>全不选 </a>
          <a  href="javascript:void(0)" class="btn btn-success fchoose"> 反选</a>
          <a  href="javascript:void(0)" class="btn btn-success del"> 批量删除</a>
      </div>
  </div>
   <div class="mws-panel-body no-padding"> 
    <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
     <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info"> 
      <thead> 
       <tr role="row">
          <td class="checkbox-column"> </td>
        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 157px;">轮播图组ID</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 209px;">缩略图1</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 209px;">缩略图2</th>
          <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 209px;">缩略图3</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 209px;">缩略图4</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 209px;">状态</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 101px;">操作</th>
       </tr> 
      </thead> 
      <tbody role="alert" aria-live="polite" aria-relevant="all">
        @foreach($res as $row)
       <tr class="odd"> 
         <td class="checkbox-column"><input type="checkbox" value="{{$row->id}}"> </td>
        <td class="sorting_1">{{$row->id}}</td> 
        <td class=" "><img src="{{$row->pic1}}" alt=""></td> 
        <td class=" "><img src="{{$row->pic2}}" alt=""></td> 
        <td class=" "><img src="{{$row->pic3}}" alt=""></td> 
        <td class=" "><img src="{{$row->pic4}}" alt=""></td> 
        <td class=" "><button class="btn btn-info " id="status" >
          @if ( $row->status == 1 )
          上架
          @else
          下架
          @endif
        </button></td> 
        <td class=" ">
          <a href="/carousel/create" class="btn btn-success">添加</a>
          <form action="/carousel/{{$row->id}}" method="post">
            {{csrf_field()}}
            {{method_field("DELETE")}}
            <button class="btn btn-info">删除</button>
          </form>
        <a href="/carousel/{{$row->id}}/edit" class="btn btn-danger">修改</a>
        </td> 
       </tr>
       @endforeach
      </tbody>
     </table>
        
     <div class="dataTables_paginate paging_full_numbers" id="pages">
      
     </div>
    </div> 
   </div> 
  </div> 
<script type="text/javascript">
// alert($);
 //全选
 $(".allchoose").click(function(){
  $("#DataTables_Table_1").find("tr").each(function(){
    $(this).find(":checkbox").attr("checked",true);
  });
 });

  //全不选
 $(".nochoose").click(function(){
  $("#DataTables_Table_1").find("tr").each(function(){
    $(this).find(":checkbox").attr("checked",false);
  });
 });

 //反选
$(".fchoose").click(function(){
   $("#DataTables_Table_1").find("tr").each(function(){
    if($(this).find(":checkbox").attr("checked")){
      //设置为不选中
      $(this).find(":checkbox").attr("checked",false);
    }else{
      $(this).find(":checkbox").attr("checked",true);

    }
  });
});

//删除选中数据
$(".del").click(function(){
  a=[];
  //获取需要删除数据的id
  //遍历
  $(":checkbox").each(function(){
      if($(this).attr("checked")){
        id=$(this).val();
        // alert(id);
        //添加数组元素
        a.push(id);
      }
  });
  // alert(a);
  //Ajax操作
  $.get("/carousel/{delete}",{a:a},function(data){
    // alert(data);
    if(data==1){      
      //把选中数据所在tr从dom里移除 remove
      //遍历
      for(var i=0;i<a.length;i++){
        $("input[value='"+a[i]+"']").parents("tr").remove();
      }
    }else{
      alert(data);
    }
  });
});

// 更改上下架状态
$('#status').click( function( ) {
  if ( $(this).html() == '上架' ) {
     $(this).html('下架');
  } else  {
     $(this).html('上架');
  }
});
 </script>
 </body>
</html>


@endsection
@section('title','轮播图管理列表页')