@extends('_layouts.primary')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        @forelse($games as $game)
          <p>{{ $game->name }}</p>
        @empty
          <p>Nenhum jogo foi encontrado.</p>
        @endforelse
      </div>
    </div>
  </div>
@endsection