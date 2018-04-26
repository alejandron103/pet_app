 <div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
    <label for="$name" class="col-md-4 control-label">{{$text}}</label>

    <div class="col-md-6">
        <input id="{{$name}}" type="text" class="form-control" name="{{$name}}" value="{{ old($name) }}" required autofocus>

        @include('layouts.error', ['input'=> $name])
    </div>
</div>