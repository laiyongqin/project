@extends('Admin.AdminPublic.public')
@section("admin")
<form class="form-inline" role="form" action="/carousel/{{$res->id}}" method="post" enctype="multipart/form-data"  >
  <div class="form-group">
    <label class="mws-form-label" for="name">图片1</label>
  </div>
  <div class="form-group">
      <img src="{{session('imgurl')}}" alt="" with="216px" height="152px" >
    <label class="sr-only" for="inputfile">图片上传</label>
    <input type="file" id="inputfile" accept="image/jpeg,image/gif,image/png" multiple="multiple/form-data" type="file" name="pic1" >
  </div>
  <div class="form-group">
    <label class="mws-form-label" for="name">图片2</label>
  </div>
  <div class="form-group">
       <img src="{{session('imgurl')}}" alt="" with="216px" height="152px" >
    <label class="sr-only" for="inputfile">图片上传</label>
    <input type="file" id="inputfile" accept="image/jpeg,image/gif,image/png" multiple="multiple/form-data" type="file" name="pic2">
  </div><hr>

  <div class="form-group">
    <label class="mws-form-label" for="name">图片3</label>
  </div>
  <div class="form-group">
       <img src="{{session('imgurl')}}" alt="" with="216px" height="152px" >
    <label class="sr-only" for="inputfile">图片上传</label>
    <input type="file" id="inputfile" accept="image/jpeg,image/gif,image/png" multiple="multiple/form-data" type="file" name="pic3">
  </div>

  <div class="form-group">
    <label class="mws-form-label" for="name">图片4</label>
  </div>
  <div class="form-group">
       <img src="{{session('imgurl')}}" alt="" with="216px" height="152px" >
    <label class="sr-only" for="inputfile">图片上传</label>
    <input type="file" id="inputfile" accept="image/jpeg,image/gif,image/png" multiple="multiple/form-data" type="file" name="pic4">
  </div><br>
  <center><button type="submit" class="btn btn-default send-btn">提交</button></center>
  {{csrf_field()}}
  {{method_field("PATCH")}}
</form>
@endsection
@section('title','轮播图修改页')