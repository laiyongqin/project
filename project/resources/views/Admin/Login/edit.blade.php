@extends('Admin.AdminPublic.public')
@section("admin")
<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Inline Form</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <form class="mws-form" action="/adminlogin/{update}"  method="post">
                          
                    		<div class="mws-form-inline">
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">管理员</label>
                    				<div class="mws-form-item">
                    					<input class="small" type="text" name="name" value="{{$user->name}}">
                    				</div>
                    			</div>
                    	        <div class="mws-form-row">
                    				<label class="mws-form-label">密码</label>
                    				<div class="mws-form-item">
                                        <input class="small" name="password" type="password">
                                      
                    				</div>
                    			</div>
                    		</div>
                    		<div class="mws-button-row">
                    			<input value="Submit" class="btn btn-danger" type="submit">
                    			<input value="Reset" class="btn " type="reset">
                            </div>
                             {{csrf_field()}}
                            {{method_field("PATCH")}}
                    	</form>
                    </div>    	
                </div>
@endsection
@section('title','后台管理员密码修改页')