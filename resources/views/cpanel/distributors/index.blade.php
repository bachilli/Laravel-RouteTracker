@extends('_layouts.cpanel')

@section('content')
  @include('cpanel.distributors.partials.menu')
  <div class="card card-block">
    @include('_layouts.partials.cpanel.alerts.default')
    @include('_layouts.partials.cpanel.alerts.validator')
    <h3 class="card-title">{{ __('general.distributors') }}</h3>
    <hr>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th class="w-10 align-center">{{ __('general.id') }}</th>
          <th class="w-75">{{ __('general.name') }}</th>
          <th class="w-15 align-center">{{ __('general.actions') }}</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($distributors as $distributor)
          <tr>
            <td class="w-10 align-center">{{ $distributor->id }}</td>
            <td class="w-75">{{ $distributor->name }}</td>
            <td class="w-15 align-center">
              <a class="btn btn-secondary"
                 href="{{ action('CPanel\DistributorController@show', $distributor->id) }}"
                 title="{{ __('general.show') }}"
                 data-toggle="tooltip"><i class="fa fa-folder-open"></i></a>
              <a class="btn btn-primary"
                 href="{{ action('CPanel\DistributorController@edit', $distributor->id) }}"
                 title="{{ __('general.edit') }}"
                 data-toggle="tooltip"><i class="fa fa-pencil-square"></i></a>
              <a class="btn btn-danger"
                 href="{{ action('CPanel\DistributorController@destroy', $distributor->id) }}"
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
            <td colspan="3">{{ __('distributors.none_found') }}</td>
          </tr>
        @endforelse
      </tbody>
    </table>
    <div class="pull-xs-right">
      {{ $distributors->links('vendor.pagination.bootstrap-4') }}
    </div>
  </div>
@endsection