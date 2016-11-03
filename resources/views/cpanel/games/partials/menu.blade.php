<div class="btn-group">
  <a class="{{ route_tracker([ 'CPanel\GameController@overview' ])->ifIsCurrentOutput('active', 'btn btn-lg btn-secondary') }}"
     href="{{ action('CPanel\GameController@overview') }}">{{ __('general.overview') }}</a>
  <a class="{{ route_tracker([ 'CPanel\GameController@index' ])->ifIsCurrentOutput('active', 'btn btn-lg btn-warning') }}"
     href="{{ action('CPanel\GameController@index') }}">{{ __('general.listing') }}</a>
  <a class="{{ route_tracker([ 'CPanel\GameController@create' ])->ifIsCurrentOutput('active', 'btn btn-lg btn-success') }}"
     href="{{ action('CPanel\GameController@create') }}">{{ __('games.create') }}</a>
</div>
<hr class="hidden">