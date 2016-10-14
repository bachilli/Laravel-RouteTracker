@extends('_layouts.cpanel')

@section('content')
  @include('cpanel.contents.partials.menu')
  <div class="card card-block">
    <h3 class="card-title">
      {{ trans('general.content') }}: <strong>{{ $content->name }}</strong>
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
        <td class="value w-75">{{ $content->id }}</td>
      </tr>
      <tr>
        <td class="field w-25 align-right">{{ trans('general.source') }}</td>
        <td class="value w-75">
          <a href="{{ action('CPanel\SourceController@show', $content->source_id) }}">{{ $content->source->name }}</a>
        </td>
      </tr>
      <tr>
        <td class="field w-25 align-right">{{ trans('general.key') }}</td>
        <td class="value w-75">{{ $content->key }}</td>
      </tr>
      <tr>
        <td class="field w-25 align-right">{{ trans('general.name') }}</td>
        <td class="value w-75">{{ $content->name }}</td>
      </tr>
      <tr>
        <td class="field w-25 align-right">{{ trans('general.type') }}</td>
        <td class="value w-75">{{ $content->type }}</td>
      </tr>
      <tr>
        <td class="field w-25 align-right">{{ trans('general.status') }}</td>
        <td class="value w-75">{{ $content->status }}</td>
      </tr>
      <tr>
        <td class="field w-25 align-right">{{ trans('general.data') }}</td>
        <td class="value w-75">
          <pre>{{ json_encode($content->data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) }}</pre>
        </td>
      </tr>
      <tr>
        <td class="field w-25 align-right">{{ trans('general.created_at') }}</td>
        <td class="value w-75">{{ $content->created_at }}</td>
      </tr>
      <tr>
        <td class="field w-25 align-right">{{ trans('general.updated_at') }}</td>
        <td class="value w-75">{{ $content->updated_at }}</td>
      </tr>
      </tbody>
      <tfoot>
      <tr>
        <td colspan="2">
          <div class="pull-xs-right">
            <a class="btn btn-primary btn-lg"
               href="{{ action('CPanel\ContentController@edit', $content->id) }}"
               data-toggle="tooltip"
               title="{{ trans('general.edit') }}"><i class="fa fa-pencil-square"></i></a>
            <a class="btn btn-danger btn-lg"
               data-formlink="DELETE"
               data-formlink-confirm-text="{{ trans('general.are_you_sure') }} {{ trans('general.destroy_warning') }}"
               data-formlink-sweat='{
                                      "type": "warning",
                                      "showCancelButton": "true",
                                      "confirmButtonColor": "#d9534f",
                                      "title": "{{ trans('general.are_you_sure') }}",
                                      "text": "{{ trans('general.destroy_warning') }}",
                                      "confirmButtonText": "{{ trans('general.yes_destroy_it') }}",
                                      "cancelButtonText": "{{ trans('general.no_keep_it') }}"
                                   }'
               href="{{ action('CPanel\ContentController@destroy', $content->id) }}"
               data-toggle="tooltip" title="{{ trans('general.destroy') }}"><i class="fa fa-times"></i></a>
          </div>
        </td>
      </tr>
      </tfoot>
    </table>
  </div>
@endsection