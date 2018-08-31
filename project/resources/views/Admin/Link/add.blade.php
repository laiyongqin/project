@extends('Admin.AdminPublic.public')
@section("admin")
<html>
 <head></head>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span>友情链接添加</span> 
   </div> 
   <div class="mws-panel-body no-padding">
    <form class="mws-form" action="/adminlink" method="post"> 
     <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">友情链接名</label> 
       <div class="mws-form-item"> 
        <input type="text" name="yqname" class="large" /> 
       </div> 
      </div> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">友情链接url</label> 
       <div class="mws-form-item"> 
        <input type="text" name="yq_url" class="large" /> 
       </div> 
      </div> 
     </div> 
     <div class="mws-button-row"> 
      {{csrf_field()}}
      <input type="submit" value="Submit" class="btn btn-danger" /> 
      <input type="reset" value="Reset" class="btn " /> 
     </div> 
    </form> 
   </div> 
  </div>
 </body>
</html>
@endsection
@section('title','后台友情链接列表页')