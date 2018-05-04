<div class="media">
    <a class="pull-left" href="#">
        <img style="width: 3vw; height: 3vw;" src="{{$message->user->photo?:''}}"
             alt="{{ $message->user->name }}" class="img-circle">
    </a>
    <div class="media-body">
        <h5 class="media-heading">{{ $message->user->name }}</h5>
        <p>{{ $message->body }}</p>
        <div class="text-muted">
            <small>Posted {{ $message->created_at->diffForHumans() }}</small>
        </div>
    </div>
</div>