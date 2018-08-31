@extends("Admin.AdminPublic.public")
@section("admin")

<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span><i class="icon-magic"></i> Default Wizard Form</span>
    </div>
    <div class="mws-panel-body no-padding">
        <form class="mws-form wzd-default wizard-form wizard-form-horizontal" action="/admingonggao/{{$res->gid}}" method="post">
            
            <fieldset class="wizard-step mws-form-inline" style="display: block;" data-wzd-id="wzd_1cm2vr1i51ojc1itc1s14_0">
                <legend class="wizard-label" style="display: none;"><i class="icol-accept"></i> Member Profile</legend>
                <div id="" class="mws-form-row">
                    <label class="mws-form-label">公告标题 <span class="required">*</span></label>
                    <div class="mws-form-item">
                        <input name="gname" class="required large" type="text" value="{{$res->gname}}">
                    </div>
                </div>
                
                <div class="mws-form-row">
                    <label class="mws-form-label">公告内容 <span class="required">*</span></label>
                    <div class="mws-form-item">
                        <textarea name="gcontent" rows="" cols="" class="required large" >
                            {{$res->gcontent}}
                        </textarea>
                    </div>
                </div>
            </fieldset>
            
        
        
    </form>
    </div>
</div>




@endsection
@section('title','公告添加页面')