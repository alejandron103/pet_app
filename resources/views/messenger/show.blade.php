@extends('layouts.app')

@section('content')
    <div class="col-md-8 col-md-offset-2">
    	@php
    		$users	= [];
    		foreach ($thread->users as $key => $user) {
    			$users[]=$user->name;
    		}
    		$cadena=implode(' y ', $users);
    	@endphp
        <h1>Chat <small>de {{ $cadena }}<small></h1>
        <div id="listMessage" style="height: 65vh; overflow-y: scroll;">
        	@each('messenger.partials.messages', $thread->messages, 'message')
    	</div>

       {{--  <div class="media">
		    <a class="pull-left" href="#">
		        <img src="//www.gravatar.com/avatar/{{ md5($message->user->email) }} ?s=64"
		             alt="{{ $message->user->name }}" class="img-circle">
		    </a>
		    <div class="media-body">
		        <h5 class="media-heading">{{ $message->user->name }}</h5>
		        <p>{{ $message->body }}</p>
		        <div class="text-muted">
		            <small>Posted {{ $message->created_at->diffForHumans() }}</small>
		        </div>
		    </div>
		</div> --}}

        <h2>Enviar nuevo mensaje</h2>		        
		    <!-- Message Form Input -->
		    <div class="form-group">
		        <textarea id="message" name="message" class="form-control">{{ old('message') }}</textarea>
		    </div>

		    <!-- Submit Form Input -->
		    <div class="form-group">
		        <button id="send" class="btn btn-primary form-control">Enviar</button>
		    </div>
		</form>
    </div>
@stop

@section('scripts')
    <script src="https://js.pusher.com/4.1/pusher.min.js"></script>
    <script>
        $("#send").click(function(event) {
            var msj = $("#message").val();
            $("#message").val('sending...');
            console.log('mess'+msj);
            $.ajax({
              method: "PUT",
              url: "{{ route('messages.update', $thread->id) }}",
              data: { message: msj},
              dataType: "json"
            })
              .done(function( msg ) {
                console.log( "message: " + JSON.stringify(msg.status));
              });
        });
        var elem = document.getElementById("listMessage");
        elem.scrollTop = elem.scrollHeight;

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('52eac2d8a951fbb04113', {
          cluster: 'us2',
          encrypted: true
        });

        var channel = pusher.subscribe('chat_{{$thread->id}}');
        channel.bind('new-message', function(data) {
        	var new_message= '<div class="media"><a class="pull-left" href="#"><img style="width: 3vw; height: 3vw;" src="'+data.message.user.photo+'" alt="'+data.message.user.name+'" class="img-circle"></a><div class="media-body"><h5 class="media-heading">'+data.message.user.name+'</h5><p>'+data.message.body+'</p><div class="text-muted"><small>Posted '+data.message.fecha+'</small></div></div></div>';
        	$('#listMessage').append(new_message);
        	$("#message").val('');
          var elem = document.getElementById("listMessage");
          elem.scrollTop = elem.scrollHeight;
          	//alert(data.message);
        });
    </script>
@endsection
