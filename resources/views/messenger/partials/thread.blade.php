@php
    $class = $thread->isUnread(Auth::id()) ? 'alert-info' : ''; 
    $receiver= $thread->users()->whereNotIn('users.id',[Auth::user()->id])->first();
    $cadena= $receiver->name;
    $photo= $receiver->photo;
@endphp

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="media">
                <div class="media-left">
                    <img class="media-object img-circle" style="width: 9vh;" src="{{ $photo }}">
                </div>
                <div class="media-body">
                    <h4 class="media-heading">
                        <a href="{{ route('messages.show', $thread->id) }}">Chat con {{ $cadena }}</a>
                        @if($thread->userUnreadMessagesCount(Auth::id()) > 0 )
                        ({{ $thread->userUnreadMessagesCount(Auth::id()) }} mensaje(s) no leidos)
                        @endif
                    </h4>
                    <p>
                        {{ $thread->latestMessage->body }}
                    </p>
                    <a href="{{ route('messages.show', $thread->id) }}" role="button" class="btn btn-primary btn-sm" sty> Abrir chat </a>
                </div>
            </div>
        </div>
    </div>
</div>