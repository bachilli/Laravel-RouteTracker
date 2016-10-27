<div class="btn-group">
  <a class="btn btn-lg btn-secondary" href="{{ action('CPanel\TagController@overview') }}">{{ trans('general.overview') }}</a>
  <a class="btn btn-lg btn-warning" href="{{ action('CPanel\TagController@index') }}">{{ trans('general.listing') }}</a>
  <a class="btn btn-lg btn-success" href="{{ action('CPanel\TagController@create') }}">{{ trans('general.create') }}</a>
</div>
<hr class="hidden">