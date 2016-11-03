@extends('_layouts.primary')

@section('content')
  <div class="container">
    <div class="row">
        <div class="col-xs-12">
          <h2>{{ $game->name }}</h2>
          <a href="{{ action('CPanel\GameController@edit', $game->id) }}" target="_blank">{{ __('games.edit') }}</a>
          @if (! $game->dimensions->is_responsive)
            <div class="game-player">
              <iframe src="{{ $game->embed->url }}" width="{{ $game->dimensions->width }}" height="{{ $game->dimensions->height }}"></iframe>
            </div>
          @else
            <div class="game-player game-player--responsive">
              <iframe src="{{ $game->embed->url }}"></iframe>
            </div>
          @endif
        </div>
    </div>
  </div>
@endsection