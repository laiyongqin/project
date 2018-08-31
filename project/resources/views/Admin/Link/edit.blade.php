@extends('Admin.AdminPublic.public')
@section("admin")
<html>
 <head></head>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span>友情链接修改</span> 
   </div> 
   <div class="mws-panel-body no-padding">
    <form class="mws-form" action="/adminlink/{{$link->id}}" method="post">
     <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">友情链接名</label> 
       <div class="mws-form-item"> 
        <input type="text" name="yqname" class="large" value="{{$link->yqname}}" /> 
       </div> 
      </div> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">友情链接url</label> 
       <div class="mws-form-item"> 
        <input type="text" name="yq_url" class="large" value="{{$link->yq_url}}"/> 
       </div> 
      </div>  

       <div class="mws-form-row"> 
       <label class="mws-form-label">状态</label> 
       <div class="mws-form-item"> 
       

<form>
<select name="status">
<option value="{{$link->status}}">
                @if ( $link->status ) 
                上架
                @else
                下架
                @endif
              
            </option>
            <option value="  
            @if ( !$link->status ) 
                1
                @else
                0
                @endif ">
             @if ( !$link->status ) 
                上架
                @else
                下架
                @endif
        </option>
</select>
</form>



     
     </div> 
     <div class="mws-button-row"> 
      {{csrf_field()}}
      {{method_field("PUT")}}
      <input type="submit" value="Submit" class="btn btn-danger" /> 
      <input type="reset" value="Reset" class="btn " /> 
     </div> 
    </form> 
   </div> 
  </div>
 </body>
</html>
@endsection
@section('title','友情链接修改页')