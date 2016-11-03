@extends('_layouts.cpanel')

@section('content')
  @include('cpanel.tags.partials.menu')
  <div class="card card-block">
    <h3 class="card-title">
      {{ __('general.tag') }}: <strong>{{ $tag->name }}</strong>
    </h3>
    <a href="{{ action('Primary\TagController@single', $tag->slug) }}" target="_blank">&larr; {{ __('general.see_on_site') }}</a>
    <hr>
    <table class="table table-show table-bordered">
      <thead>
        <tr>
          <th class="column-field w-25 align-right">{{ __('general.field') }}</th>
          <th class="column-value w-75">{{ __('general.value') }}</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="column-field w-25 align-right">{{ __('general.id') }}</td>
          <td class="column-value w-75">{{ $tag->id }}</td>
        </tr>
        <tr>
          <td class="column-field w-25 align-right">{{ __('general.name') }}</td>
          <td class="column-value w-75">{{ $tag->name }}</td>
        </tr>
        <tr>
          <td class="column-field w-25 align-right">{{ __('general.slug') }}</td>
          <td class="column-value w-75">{{ $tag->slug }}</td>
        </tr>
        <tr>
          <td class="column-field w-25 align-right">{{ __('general.excerpt') }}</td>
          <td class="column-value w-75">{{ $tag->excerpt }}</td>
        </tr>
        <tr>
          <td class="column-field w-25 align-right">{{ __('general.description') }}</td>
          <td class="column-value w-75">{{ $tag->description }}</td>
        </tr>
        <tr>
          <td class="column-field w-25 align-right">{{ __('general.thumbnail') }}</td>
          <td class="column-value w-75">
            @if (uplab($tag->thumbnail)->exists())
              <div class="image">
                <a class="fancybox" href="{{ uplab($tag->thumbnail)->url() }}">
                  <img src="{{ uplab($tag->thumbnail)->url() }}">
                </a>
              </div>
              <hr>
            @endif
            <pre>{{ human_val($tag->thumbnail)->json() }}</pre>
          </td>
        </tr>
        <tr>
          <td class="column-field w-25 align-right">{{ __('general.is_visible') }}</td>
          <td class="column-value w-75">{{ human_val($tag->is_visible)->str() }}</td>
        </tr>
        <tr>
          <td class="column-field w-25 align-right">{{ __('general.created_at') }}</td>
          <td class="column-value w-75">{{ $tag->created_at }}</td>
        </tr>
        <tr>
          <td class="column-field w-25 align-right">{{ __('general.updated_at') }}</td>
          <td class="column-value w-75">{{ $tag->updated_at }}</td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="2">
            <div class="pull-xs-right">
              <a class="btn btn-primary btn-lg"
                 href="{{ action('CPanel\TagController@edit', $tag->id) }}"
                 data-toggle="tooltip"
                 title="{{ __('general.edit') }}"><i class="fa fa-pencil-square"></i></a>
              <a class="btn btn-danger btn-lg"
                 href="{{ action('CPanel\TagController@destroy', $tag->id) }}"
                 title="{{ __('general.destroy') }}"
                 data-toggle="tooltip"
                 data-formlink="DELETE"
                 data-formlink-confirm-text="{{ sprintf('%s %s', __('general.are_you_sure'), __('general.destroy_warning')) }}"
                 data-formlink-sweat='{
                  "type": "warning",
                  "showCancelButton": "true",
                  "confirmButtonColor": "#d9534f",
                  "title": "{{ __('general.are_you_sure') }}",
                  "text": "{{ __('general.destroy_warning') }}",
                  "confirmButtonText": "{{ __('general.yes_destroy_it') }}",
                  "cancelButtonText": "{{ __('general.no_keep_it') }}"
                 }'><i class="fa fa-times"></i></a>
            </div>
          </td>
        </tr>
      </tfoot>
    </table>
  </div>
@endsection