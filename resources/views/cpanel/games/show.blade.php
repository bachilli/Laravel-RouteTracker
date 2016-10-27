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
          <td class="value w-75"><pre>{{ human_val($game->embed)->json() }}</pre></td>
        </tr>
        <tr>
          <td class="field w-25 align-right">{{ trans('general.instructions') }}</td>
          <td class="value w-75"><pre>{{ human_val($game->instructions)->json() }}</pre></td>
        </tr>
        <tr>
          <td class="field w-25 align-right">{{ trans('general.dimensions') }}</td>
          <td class="value w-75"><pre>{{ human_val($game->dimensions)->json() }}</pre></td>
        </tr>
        <tr>
          <td class="field w-25 align-right">{{ trans('general.age_range') }}</td>
          <td class="value w-75">{{ $game->age_range }}</td>
        </tr>
        <tr>
          <td class="field w-25 align-right">{{ trans('general.file') }}</td>
          <td class="value w-75"><pre>{{ human_val($game->file)->json() }}</pre></td>
        </tr>
        <tr>
          <td class="field w-25 align-right">{{ trans('general.thumbnail') }}</td>
          <td class="value w-75">
            @if (uplab($game->thumbnail)->exists())
              <div class="image">
                <a class="fancybox" href="{{ uplab($game->thumbnail)->url() }}">
                  <img src="{{ uplab($game->thumbnail)->url() }}">
                </a>
              </div>
              <hr>
            @endif
            <pre>{{ human_val($game->thumbnail)->json() }}</pre>
          </td>
        </tr>
        <tr>
          <td class="field w-25 align-right">{{ trans('general.is_visible') }}</td>
          <td class="value w-75">{{ human_val($game->is_visible)->yesOrNo() }}</td>
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
                 title="{{ trans('general.edit') }}"
                 data-toggle="tooltip"><i class="fa fa-pencil-square"></i></a>
              <a class="btn btn-danger btn-lg"
                 href="{{ action('CPanel\GameController@destroy', $game->id) }}"
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
            </div>
          </td>
        </tr>
      </tfoot>
    </table>
  </div>
@endsection