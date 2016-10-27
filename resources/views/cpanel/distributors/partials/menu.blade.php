<div class="btn-group">
  <a class="btn btn-lg btn-secondary" href="{{ action('CPanel\DistributorController@overview') }}">{{ trans('general.overview') }}</a>
  <a class="btn btn-lg btn-warning" href="{{ action('CPanel\DistributorController@index') }}">{{ trans('general.listing') }}</a>
  <a class="btn btn-lg btn-success" href="{{ action('CPanel\DistributorController@create') }}">{{ trans('general.create') }}</a>
</div>
<hr class="hidden">