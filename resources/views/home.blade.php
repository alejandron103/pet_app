@extends('layouts.app')

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
                        <a href="{{url('messages/create/'.$user->id)}}">{{ $user['name'] }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
