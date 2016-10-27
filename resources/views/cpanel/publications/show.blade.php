@extends('_layouts.cpanel')

@section('content')
  @include('cpanel.publications.partials.menu')
  <div class="card card-block">
    <h3 class="card-title">
      {{ trans('general.publication') }}: <strong>{{ $publication->name }}</strong>
    </h3>
    <hr>
    <table class="table table-show table-bordered">
      <thead>
        <tr>
          <th class="field w-25 align-right">{{ trans('general.field') }}</th>
          <th class="value w-75">{{ trans('general.value') }}</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="field w-25 align-right">{{ trans('general.id') }}</td>
          <td class="value w-75">{{ $publication->id }}</td>
        </tr>
        <tr>
          <td class="field w-25 align-right">{{ trans('general.distributor') }}</td>
          <td class="value w-75">
            <a href="{{ action('CPanel\DistributorController@show', $publication->distributor_id) }}">{{ $publication->distributor->name }}</a>
          </td>
        </tr>
        <tr>
          <td class="field w-25 align-right">{{ trans('general.key') }}</td>
          <td class="value w-75">{{ $publication->key }}</td>
        </tr>
        <tr>
          <td class="field w-25 align-right">{{ trans('general.name') }}</td>
          <td class="value w-75">{{ $publication->name }}</td>
        </tr>
        <tr>
          <td class="field w-25 align-right">{{ trans('general.type') }}</td>
          <td class="value w-75">{{ $publication->type }}</td>
        </tr>
        <tr>
          <td class="field w-25 align-right">{{ trans('general.status') }}</td>
          <td class="value w-75">{{ $publication->status }}</td>
        </tr>
        <tr>
          <td class="field w-25 align-right">{{ trans('general.data') }}</td>
          <td class="value w-75">
            <pre>{{ json_encode($publication->data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) }}</pre>
          </td>
        </tr>
        <tr>
          <td class="field w-25 align-right">{{ trans('general.created_at') }}</td>
          <td class="value w-75">{{ $publication->created_at }}</td>
        </tr>
        <tr>
          <td class="field w-25 align-right">{{ trans('general.updated_at') }}</td>
          <td class="value w-75">{{ $publication->updated_at }}</td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="2">
            <div class="pull-xs-right">
              <a class="btn btn-primary btn-lg"
                 href="{{ action('CPanel\PublicationController@edit', $publication->id) }}"
                 data-toggle="tooltip"
                 title="{{ trans('general.edit') }}"><i class="fa fa-pencil-square"></i></a>
              <a class="btn btn-danger btn-lg"
                 href="{{ action('CPanel\PublicationController@destroy', $publication->id) }}"
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
            </div>
          </td>
        </tr>
      </tfoot>
    </table>
  </div>
@endsection