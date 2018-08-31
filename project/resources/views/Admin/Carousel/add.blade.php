@extends('Admin.AdminPublic.public')
@section("admin")


<form class="form-inline" role="form" action="/carousel" method="post" enctype="multipart/form-data"  name="form1">
  <div class="form-group">
    <label class="mws-form-label" for="name">图片1</label>
    <!-- <input type="text" class="form-control" id="name" placeholder="请输入名称"> -->
  </div>
  <div class="form-group">
    <label class="sr-only" for="inputfile">图片上传</label>
    <input type="file" id="inputfile" accept="image/jpeg,image/gif,image/png" multiple="multiple/form-data" type="file" name="pic1"  >
  </div><br>
  <div class="form-group">
    <label class="mws-form-label" for="name">图片2</label>
    <!-- <input type="text" class="form-control" id="name" placeholder="请输入名称"> -->
  </div>
  <div class="form-group">
    <label class="sr-only" for="inputfile">图片上传</label>
    <input type="file" id="inputfile" accept="image/jpeg,image/gif,image/png" multiple="multiple/form-data" type="file" name="pic2">
  </div><br>
  <div class="form-group">
    <label class="mws-form-label" for="name">图片3</label>
    <!-- <input type="text" class="form-control" id="name" placeholder="请输入名称"> -->
  </div>
  <div class="form-group">
    <label class="sr-only" for="inputfile">图片上传</label>
    <input type="file" id="inputfile" accept="image/jpeg,image/gif,image/png" multiple="multiple/form-data" type="file" name="pic3">
  </div><br>
  <div class="form-group">
    <label class="mws-form-label" for="name">图片4</label>
    <!-- <input type="text" class="form-control" id="name" placeholder="请输入名称"> -->
  </div>
  <div class="form-group">
    <label class="sr-only" for="inputfile">图片上传</label>
    <input type="file" id="inputfile" accept="image/jpeg,image/gif,image/png" multiple="multiple/form-data" type="file" name="pic4">
  </div><br>
 
  <button type="submit" class="btn btn-default">提交</button>
  {{csrf_field()}}

</form>




@endsection
@section('title','轮播图添加列表页')