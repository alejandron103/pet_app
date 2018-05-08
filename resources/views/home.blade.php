@extends('layouts.app')

@section('styles')

    <style type="text/css">
        .container-user{
            text-align: center;
            color: #000;
            text-decoration: none;
            margin: 5vh 0;
        }
        .container-user:hover{
            transform: scale(1.1);
            text-decoration: none;
        }
    </style>

@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Bienvenido <b>{{ $user->name }}</b></div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @foreach($users as $user)
                    <a href="{{url('messages/create/'.$user->id)}}">
                        <div class="container-user">
                            <div class="photo-profile">
                                <img class="img-circle" style="width: 9vw; height: 9vw" src="{{ $user['photo'] }}" alt="">
                            </div>
                            <div class="cont-text-user">
                                <p class="name-user"><b>Nombre : </b>{{ $user['name'] }}</p>
                                <p class="type-user"><b>Tipo :</b>{{ $user['type']['name'] }}</p>
                                {{-- <p class="type-user"><b>Tipo :</b>{{ $user}}</p> --}}
                                <p class="description-user"><b>Descripción : </b>{{ $user['description'] }}</p>
                                <button class="btn btn-primary">
                                    Comezar Chat
                                </button>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
