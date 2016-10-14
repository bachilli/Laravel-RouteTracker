@extends('_layouts.cpanel')

@section('content')
  @include('cpanel.tags.partials.menu')
  <div class="card card-block">
    <h3 class="card-title">
      {{ trans('general.category') }}: <strong>{{ $tag->name }}</strong>
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
        <td class="value w-75">{{ $tag->id }}</td>
      </tr>
      <tr>
        <td class="field w-25 align-right">{{ trans('general.name') }}</td>
        <td class="value w-75">{{ $tag->name }}</td>
      </tr>
      <tr>
        <td class="field w-25 align-right">{{ trans('general.slug') }}</td>
        <td class="value w-75">{{ $tag->slug }}</td>
      </tr>
      <tr>
        <td class="field w-25 align-right">{{ trans('general.description') }}</td>
        <td class="value w-75">{{ $tag->description }}</td>
      </tr>
      <tr>
        <td class="field w-25 align-right">{{ trans('general.thumbnail') }}</td>
        <td class="value w-75">
          <div class="image">
            @if (storage('public')->exists($tag->thumbnail->location))
              <a class="fancybox" href="{{ storage('public')->url($tag->thumbnail->location) }}">
                <img src="{{ storage('public')->url($tag->thumbnail->location) }}">
              </a>
            @endif
          </div>
        </td>
      </tr>
      <tr>
        <td class="field w-25 align-right">{{ trans('general.created_at') }}</td>
        <td class="value w-75">{{ $tag->created_at }}</td>
      </tr>
      <tr>
        <td class="field w-25 align-right">{{ trans('general.updated_at') }}</td>
        <td class="value w-75">{{ $tag->updated_at }}</td>
      </tr>
      </tbody>
      <tfoot>
      <tr>
        <td colspan="2">
          <div class="pull-xs-right">
            <a class="btn btn-primary btn-lg"
               href="{{ action('CPanel\TagController@edit', $tag->id) }}"
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
               href="{{ action('CPanel\TagController@destroy', $tag->id) }}"
               data-toggle="tooltip" title="{{ trans('general.destroy') }}"><i class="fa fa-times"></i></a>
          </div>
        </td>
      </tr>
      </tfoot>
    </table>
  </div>
@endsection