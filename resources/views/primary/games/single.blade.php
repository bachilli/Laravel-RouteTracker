@extends('_layouts.primary')

@section('content')
  <div class="container">
    <div class="row">
        <div class="col-xs-12">
          <h2>{{ $game->name }}</h2>
          <div class="game-player">
            <iframe src="{{ $game->embed->src }}"></iframe>
          </div>
        </div>
    </div>
  </div>
@endsection