@extends('_layouts.cpanel')

@section('content')
  @include('cpanel.games.partials.menu')
  <div class="card card-block">
    <h3 class="card-title">
      {{ trans('general.game') }}: <strong>{{ $game->name }}</strong>
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
          <td class="value w-75">{{ $game->id }}</td>
        </tr>
        <tr>
          <td class="field w-25 align-right">{{ trans('general.name') }}</td>
          <td class="value w-75">{{ $game->name }}</td>
        </tr>
        <tr>
          <td class="field w-25 align-right">{{ trans('general.slug') }}</td>
          <td class="value w-75">{{ $game->slug }}</td>
        </tr>
        <tr>
          <td class="field w-25 align-right">{{ trans('general.excerpt') }}</td>
          <td class="value w-75">{{ $game->excerpt }}</td>
        </tr>
        <tr>
          <td class="field w-25 align-right">{{ trans('general.description') }}</td>
          <td class="value w-75">{{ $game->description }}</td>
        </tr>
        <tr>
          <td class="field w-25 align-right">{{ trans('general.type') }}</td>
          <td class="value w-75">{{ $game->type }}</td>
        </tr>
        <tr>
          <td class="field w-25 align-right">{{ trans('general.embed') }}</td>
          <td class="value w-75"><pre>{{ pretty_json($game->embed) }}</pre></td>
        </tr>
        <tr>
          <td class="field w-25 align-right">{{ trans('general.instructions') }}</td>
          <td class="value w-75"><pre>{{ pretty_json($game->instructions) }}</pre></td>
        </tr>
        <tr>
          <td class="field w-25 align-right">{{ trans('general.dimensions') }}</td>
          <td class="value w-75"><pre>{{ pretty_json($game->dimensions) }}</pre></td>
        </tr>
        <tr>
          <td class="field w-25 align-right">{{ trans('general.classification') }}</td>
          <td class="value w-75">{{ $game->classification }}</td>
        </tr>
        <tr>
          <td class="field w-25 align-right">{{ trans('general.file') }}</td>
          <td class="value w-75"><pre>{{ pretty_json($game->file) }}</pre></td>
        </tr>
        <tr>
          <td class="field w-25 align-right">{{ trans('general.thumbnail') }}</td>
          <td class="value w-75">
            @if (storage_exists($game->thumbnail))
              <div class="image">
                <a class="fancybox" href="{{ storage_url($game->thumbnail) }}">
                  <img src="{{ storage_url($game->thumbnail) }}">
                </a>
              </div>
              <hr>
            @endif
            <pre>{{ pretty_json($game->thumbnail) }}</pre>
          </td>
        </tr>
        <tr>
          <td class="field w-25 align-right">{{ trans('general.is_published') }}</td>
          <td class="value w-75">{{ $game->is_published ? 'Y' : 'N' }}</td>
        </tr>
        <tr>
          <td class="field w-25 align-right">{{ trans('general.published_at') }}</td>
          <td class="value w-75">{{ $game->published_at }}</td>
        </tr>
        <tr>
          <td class="field w-25 align-right">{{ trans('general.created_at') }}</td>
          <td class="value w-75">{{ $game->created_at }}</td>
        </tr>
        <tr>
          <td class="field w-25 align-right">{{ trans('general.updated_at') }}</td>
          <td class="value w-75">{{ $game->updated_at }}</td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="2">
            <div class="pull-xs-right">
              <a class="btn btn-primary btn-lg"
                 href="{{ action('CPanel\GameController@edit', $game->id) }}"
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
                 href="{{ action('CPanel\GameController@destroy', $game->id) }}"
                 data-toggle="tooltip" title="{{ trans('general.destroy') }}"><i class="fa fa-times"></i></a>
            </div>
          </td>
        </tr>
      </tfoot>
    </table>
  </div>
@endsection