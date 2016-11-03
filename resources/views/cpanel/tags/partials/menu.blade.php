<div class="btn-group">
  <a class="{{ route_tracker([ 'CPanel\TagController@overview' ])->ifIsCurrentOutput('active', 'btn btn-lg btn-secondary') }}"
     href="{{ action('CPanel\TagController@overview') }}">{{ __('general.overview') }}</a>
  <a class="{{ route_tracker([ 'CPanel\TagController@index' ])->ifIsCurrentOutput('active', 'btn btn-lg btn-warning') }}"
     href="{{ action('CPanel\TagController@index') }}">{{ __('general.listing') }}</a>
  <a class="{{ route_tracker([ 'CPanel\TagController@create' ])->ifIsCurrentOutput('active', 'btn btn-lg btn-success') }}"
     href="{{ action('CPanel\TagController@create') }}">{{ __('tags.create') }}</a>
</div>
<hr class="hidden">