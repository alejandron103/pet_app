<div class="box box-primary admin-image">
    <div class="box-header with-border">
        <h3 class="box-title">{{title_case(str_replace('_', ' ',$input['name']))}}</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <div class="col-xs-12">
            <label class="btn btn-primary pull-right"><span>Upload<input type="file" class="hidden upload-admin-image"></span></label>
        </div>
        <div class="col-md-4 col-md-offset-4 col-xs-8 col-xs-offset-2 col-sm-6 col-sm-offset-3">           
            <div class="container-admin-image">
                <input required="" class="image-input" type="hidden" name="{{$input['name']}}" value="{{old($input['name'])}}">
                <div class="admin-image-item" style="background-image: url('{{old($input['name'])}}');"></div>
            </div>
        </div>
        <div class="col-xs-12 form-group {{$errors->has($input['name'])?'has-error':''}}">
            @include('HTML.error', ['name' => $input['name'] ])
        </div>
    </div>
</div>