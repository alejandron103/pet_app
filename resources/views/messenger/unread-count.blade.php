@if(Auth::check())
	@if(Auth::user()->newThreadsCount() > 0)
	    <span class="label label-danger">{{ Auth::user()->newThreadsCount() }}</span>
	@endif
@endif
