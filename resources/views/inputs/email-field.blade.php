<div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
    <label for="$name" class="col-md-4 control-label">{{$text}}</label>

    <div class="col-md-6">
        <input id="{{$name}}" type="email" class="form-control" name="{{$name}}" value="{{ old($name) }}" required {!! isset($disabled) ? 'disabled = "disabled"' : '' !!}>

        @include('layouts.error', ['input'=> $name])
    </div>
</div>