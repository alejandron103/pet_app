@php
    $types= App\Type::all();
    $breeds= App\Breed::all();
@endphp
@extends('layouts.app')

<style type="text/css">
    p.edad {
        width: 20px;
        float: right;
        font-weight: bold;
        padding: 4px 58px 0px 0px;
    }
    .form-control{
        width: 80% !important;
        display: inline-block !important;
    }
</style>
@section('content')
<div class="container" id="register">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Registro</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        @include('inputs.text-field', ['name' => 'name', 'text' => 'Nombre de la mascota'])

                        @include('inputs.text-field', ['name' => 'age', 'text' => 'Edad de la mascota'])

                        @include('inputs.email-field', ['name' => 'email', 'text' => 'Email del dueño'])

                        <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                            <label for="gender" class="col-md-4 control-label">Sexo de la mascota</label>
                            <div class="col-md-6">
                                <label class="radio-inline"><input @if(old('gender')== "M") checked @endif name="gender" type="radio" value="M">Macho</label>
                                <label class="radio-inline"><input @if(old('gender')== "F") checked @endif name="gender" type="radio" value="F">Hembra</label>
                             @include('layouts.error', ['input'=> 'gender'])
                            </div>
                        </div>    

                        <div class="form-group{{ $errors->has('type_id') ? ' has-error' : '' }}">
                            <label for="type_id" class="col-md-4 control-label">Tipo de mascota</label>
                            <div class="col-md-6">
                            @foreach($types as $type)
                                <label class="radio-inline"><input @if(old('type_id')==$type->id) checked @endif name="type_id" v-model="type_id" type="radio" value="{{$type->id}}">{{$type->name}}</label>
                            @endforeach
                                @include('layouts.error', ['input'=> 'type_id'])
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('breed_id') ? ' has-error' : '' }}">
                            <label for="type_id" class="col-md-4 control-label">raza</label>
                            <div class="col-md-6">
                                <select name="breed_id" v-model="breed_id" id="breed_id">       
                                    <option v-for="breed in breeds" :value="breed.id" v-if="breed.type_id == type_id">@{{breed.name}}</option>
                                </select>
                                @include('layouts.error', ['input'=> 'breed_id'])
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
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script>
        var app = new Vue({
          el: '#register',
          data: {
            type_id: 1,
            breeds: {!!json_encode($breeds)!!},
            breed_id: "{!! old('breed_id') !!}"
          }
        });
    </script>
@endsection