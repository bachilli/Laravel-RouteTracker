@extends('_layouts.cpanel')

@section('content')
  @include('cpanel.tags.partials.menu')
  <div class="card card-block">
    @include('_layouts.partials.cpanel.alerts.default')
    @include('_layouts.partials.cpanel.alerts.validator')
    <h3 class="card-title">{{ __('general.tags') }}</h3>
    <hr>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th class="w-10 align-center">{{ __('general.id') }}</th>
          <th class="w-10 align-center">{{ __('general.is_visible') }}</th>
          <th class="w-60">{{ __('general.name') }}</th>
          <th class="w-20 align-center">{{ __('general.actions') }}</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($tags as $tag)
          <tr class="{{ str_swap('0|1', 'color-light-red|color-white', $tag->is_visible) }}"
              data-toggle="tooltip"
              data-placement="left"
              title="{{ sprintf('%s %s', __('general.is_visible'), human_val($tag->is_visible)->str()) }}">
            <td class="w-10 align-center">{{ $tag->id }}</td>
            <td class="w-10 align-center">
              {!! toggle_link('CPanel\TagController@visibility', $tag->id)->state($tag->is_visible)
              ->attrs([ 'class' => 'btn btn-secondary' ], [ 'class' => 'btn btn-secondary' ])
              ->icon('fa fa-compact fa-eye fa-lg fa-active', 'fa fa-compact fa-eye-slash fa-lg fa-disabled')->show() !!}
            </td>
            <td class="w-60">{{ $tag->name }}</td>
            <td class="w-20 align-center">
              <a class="btn btn-secondary"
                 href="{{ action('CPanel\TagController@show', $tag->id) }}"
                 title="{{ __('general.show') }}"
                 data-toggle="tooltip"><i class="fa fa-folder-open"></i></a>
              <a class="btn btn-primary"
                 href="{{ action('CPanel\TagController@edit', $tag->id) }}"
                 title="{{ __('general.edit') }}"
                 data-toggle="tooltip"><i class="fa fa-pencil-square"></i></a>
              <a class="btn btn-danger"
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
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="4">{{ __('tags.none_found') }}</td>
          </tr>
        @endforelse
      </tbody>
    </table>
    <div class="pull-xs-right">
      {{ $tags->links('vendor.pagination.bootstrap-4') }}
    </div>
  </div>
@endsection