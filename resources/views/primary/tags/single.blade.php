@extends('_layouts.primary')

@section('content')
  <div class="container">
    <div class="imgrid hide js-imgrid-loader">
      <div class="row">
        <div class="col-xs-12">
          <h2>{{ $tag->name }}</h2>
          <a href="{{ action('CPanel\TagController@edit', $tag->id) }}" target="_blank">{{ __('games.edit') }}</a>
        </div>
        @forelse($tag->games as $game)
          <div class="col-xs-6 col-md-4 col-lg-3">
            <a href="{{ action('Primary\GameController@single', $game->slug)  }}"></a>
            <img src="{{ thumb_maker($game->thumbnail, 288, 216) }}">
            <div class="overlay">
              <div class="wrapper">
                <h3>{{ $game->name }}</h3>
              </div>
            </div>
          </div>
        @empty
          <div class="col-xs-12">
            <p>Nenhum jogo foi encontrado...</p>
          </div>
        @endforelse
      </div>
    </div>
  </div>
@endsection

@section('js')
  <script type="text/javascript">
    var $imgrids = $('.js-imgrid-loader');

    $imgrids.each(function() {
      var $imgrid = $(this);

      $imgrid.imagesLoaded(function() {
        $imgrid.removeClass('hide');
      });
    });
  </script>
@endsection