<div class="btn-group">
  <a class="btn btn-lg btn-secondary"
     href="{{ action('CPanel\SourceController@overview') }}">{{ trans('general.overview') }}</a>
  <a class="btn btn-lg btn-warning"
     href="{{ action('CPanel\SourceController@index') }}">{{ trans('general.listing') }}</a>
  <a class="btn btn-lg btn-success"
     href="{{ action('CPanel\SourceController@create') }}">{{ trans('general.create') }}</a>
</div>
<hr class="hidden">