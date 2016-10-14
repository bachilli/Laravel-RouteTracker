<div class="btn-group">
  <a class="btn btn-lg btn-secondary"
     href="{{ action('CPanel\ContentController@overview') }}">{{ trans('general.overview') }}</a>
  <a class="btn btn-lg btn-warning"
     href="{{ action('CPanel\ContentController@index') }}">{{ trans('general.listing') }}</a>
</div>
<hr class="hidden">