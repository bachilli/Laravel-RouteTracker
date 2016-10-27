@extends('_layouts.cpanel')

@section('content')
  @include('cpanel.tags.partials.menu')
  <div class="card card-block">
    @include('_layouts.partials.cpanel.alerts.default')
    @include('_layouts.partials.cpanel.alerts.validator')
    <h3 class="card-title">{{ trans('general.tags') }}</h3>
    <hr>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th class="w-10 align-center">{{ trans('general.id') }}</th>
          <th class="w-70">{{ trans('general.name') }}</th>
          <th class="w-20 align-center">{{ trans('general.actions') }}</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($tags as $tag)
          <tr>
            <td class="w-10 align-center">{{ $tag->id }}</td>
            <td class="w-70">{{ $tag->name }}</td>
            <td class="w-20 align-center">
              <a class="btn btn-secondary"
                 href="{{ action('CPanel\TagController@show', $tag->id) }}"
                 title="{{ trans('general.show') }}"
                 data-toggle="tooltip"><i class="fa fa-folder-open"></i></a>
              <a class="btn btn-primary"
                 href="{{ action('CPanel\TagController@edit', $tag->id) }}"
                 title="{{ trans('general.edit') }}"
                 data-toggle="tooltip"><i class="fa fa-pencil-square"></i></a>
              <a class="btn btn-danger"
                 href="{{ action('CPanel\TagController@destroy', $tag->id) }}"
                 title="{{ trans('general.destroy') }}"
                 data-toggle="tooltip"
                 data-formlink="DELETE"
                 data-formlink-confirm-text="{{ sprintf('%s %s', trans('general.are_you_sure'), trans('general.destroy_warning')) }}"
                 data-formlink-sweat='{
                    "type": "warning",
                    "showCancelButton": "true",
                    "confirmButtonColor": "#d9534f",
                    "title": "{{ trans('general.are_you_sure') }}",
                    "text": "{{ trans('general.destroy_warning') }}",
                    "confirmButtonText": "{{ trans('general.yes_destroy_it') }}",
                    "cancelButtonText": "{{ trans('general.no_keep_it') }}"
                 }'><i class="fa fa-times"></i></a>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="3">{{ trans('tags.none_found') }}</td>
          </tr>
        @endforelse
      </tbody>
    </table>
    <div class="pull-xs-right">
      {{ $tags->links('vendor.pagination.bootstrap-4') }}
    </div>
  </div>
@endsection