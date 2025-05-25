@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-4xl font-bold serif-title mb-2">Scoreboard</h1>
    <div class="divider mb-8"></div>
    
    <div id="scoreboard-content" hx-get="{{ route('scoreboard.data') }}" hx-trigger="every 5s">
        @include('scoreboard.partials.scores')
    </div>
</div>
@endsection
