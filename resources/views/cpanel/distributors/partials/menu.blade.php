<div class="btn-group">
  <a class="{{ route_tracker([ 'CPanel\DistributorController@overview' ])->ifIsCurrentOutput('active', 'btn btn-lg btn-secondary') }}"
     href="{{ action('CPanel\DistributorController@overview') }}">{{ __('general.overview') }}</a>
  <a class="{{ route_tracker([ 'CPanel\DistributorController@index' ])->ifIsCurrentOutput('active', 'btn btn-lg btn-warning') }}"
     href="{{ action('CPanel\DistributorController@index') }}">{{ __('general.listing') }}</a>
  <a class="{{ route_tracker([ 'CPanel\DistributorController@create' ])->ifIsCurrentOutput('active', 'btn btn-lg btn-success') }}"
     href="{{ action('CPanel\DistributorController@create') }}">{{ __('distributors.create') }}</a>
</div>
<hr class="hidden">