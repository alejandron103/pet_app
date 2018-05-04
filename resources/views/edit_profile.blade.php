@extends('layouts.app')

@section('styles')
    <style type="text/css">
        .photo-profile{
            max-height: 100%;
            max-width: 100%;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Editar Perfil</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('profile.update', ['user' => $user->id]) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">
                        <div class="row">
                            <div class="cont-image col-md-4 col-md-offset-4">
                                <img src="{{$user->photo?:''}}" class="photo-profile" alt="">
                            </div>
                        </div>  
                         <div class="form-group">
                            <label class="col-md-4 control-label" for="photo">photo</label>
                            <input type="file" name="photo" id="photo" class="photo col-md-6">
                        </div>

                        @include('inputs.text-field', ['name' => 'name', 'text' => 'Nombre de la mascota'])

                        @include('inputs.text-field', ['name' => 'age', 'text' => 'Edad de la mascota'])

                        @include('inputs.email-field', ['name' => 'email', 'text' => 'Email del dueño', 'disabled' => ""])

                        <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                            <label for="gender" class="col-md-4 control-label">Sexo de la mascota</label>
                            <div class="col-md-6">
                                <label class="radio-inline"><input @if(old('gender')== "M") checked @endif name="gender" type="radio" value="M" disabled>Macho</label>
                                <label class="radio-inline"><input @if(old('gender')== "F") checked @endif name="gender" type="radio" value="F" disabled>Hembra</label>
                             @include('layouts.error', ['input'=> 'gender'])
                            </div>
                        </div>    

                        <div class="form-group{{ $errors->has('type_id') ? ' has-error' : '' }}">
                            <label for="type_id" class="col-md-4 control-label">Tipo de mascota</label>
                            <div class="col-md-6">
                            @foreach($types as $type)
                                <label class="radio-inline"><input @if(old('type_id')==$type->id) checked @endif name="type_id" type="radio" value="{{$type->id}}" disabled>{{$type->name}}</label>
                            @endforeach
                                @include('layouts.error', ['input'=> 'type_id'])
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}" required >

                                @include('layouts.error', ['input'=> 'password'])
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirmar contraseña</label>

                            <div class="col-md-6">
                                <input id="password-confirmation" type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" required >
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Descripción</label>
                            <div class="col-md-6">
                                <textarea style="resize: vertical;" class="form-control " id="description" name="description" rows="3">{{ old('description') }}</textarea>
                            </div>
                             @include('layouts.error', ['input'=> 'description'])
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Registrarse
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){

            function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                  $('.photo-profile').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
              }
            }

            $("#photo").change(function() {
              readURL(this);
            });
        });
    </script>
@endsection