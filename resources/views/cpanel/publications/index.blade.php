@extends('_layouts.cpanel')

@section('content')
  @include('cpanel.publications.partials.menu')
  <div class="card card-block">
    @include('_layouts.partials.cpanel.alerts.default')
    @include('_layouts.partials.cpanel.alerts.validator')
    <h3 class="card-title">{{ __('general.publications') }}</h3>
    <hr>
    <table class="table table-bordered">
      <thead>
      <tr>
        <th class="w-10 align-center">{{ __('general.id') }}</th>
        <th class="w-55">{{ __('general.name') }}</th>
        <th class="w-20">{{ __('general.type') }}</th>
        <th class="w-15 align-center">{{ __('general.actions') }}</th>
      </tr>
      </thead>
      <tbody>
      @forelse ($publications as $publication)
        <tr>
          <td class="w-10 align-center">{{ $publication->id }}</td>
          <td class="w-55">{{ $publication->name }}</td>
          <td class="w-20">{{ $publication->type }}</td>
          <td class="w-15 align-center">
            <a class="btn btn-secondary"
               href="{{ action('CPanel\PublicationController@show', $publication->id) }}"
               title="{{ __('general.show') }}"
               data-toggle="tooltip"><i class="fa fa-folder-open"></i></a>
            <a class="btn btn-primary"
               href="{{ action('CPanel\PublicationController@edit', $publication->id) }}"
               title="{{ __('general.edit') }}"
               data-toggle="tooltip"><i class="fa fa-pencil-square"></i></a>
            <a class="btn btn-danger"
               href="{{ action('CPanel\PublicationController@destroy', $publication->id) }}"
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
          <td colspan="4">{{ __('publications.none_found') }}</td>
        </tr>
      @endforelse
      </tbody>
    </table>
    <div class="pull-xs-right">
      {{ $publications->links('vendor.pagination.bootstrap-4') }}
    </div>
  </div>
@endsection