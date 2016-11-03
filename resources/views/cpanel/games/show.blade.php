@extends('_layouts.cpanel')

@section('content')
  @include('cpanel.games.partials.menu')
  <div class="card card-block">
    <h3 class="card-title">
      {{ __('general.game') }}: <strong>{{ $game->name }}</strong>
    </h3>
    <a href="{{ action('Primary\GameController@single', $game->slug) }}" target="_blank">&larr; {{ __('general.see_on_site') }}</a>
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
          <td class="column-value w-75">{{ $game->id }}</td>
        </tr>
        <tr>
          <td class="column-field w-25 align-right">{{ __('general.name') }}</td>
          <td class="column-value w-75">{{ $game->name }}</td>
        </tr>
        <tr>
          <td class="column-field w-25 align-right">{{ __('general.slug') }}</td>
          <td class="column-value w-75">{{ $game->slug }}</td>
        </tr>
        <tr>
          <td class="column-field w-25 align-right">{{ __('general.excerpt') }}</td>
          <td class="column-value w-75">{{ $game->excerpt }}</td>
        </tr>
        <tr>
          <td class="column-field w-25 align-right">{{ __('general.description') }}</td>
          <td class="column-value w-75">{{ $game->description }}</td>
        </tr>
        <tr>
          <td class="column-field w-25 align-right">{{ __('general.embed') }}</td>
          <td class="column-value w-75"><pre>{{ human_val($game->embed)->json() }}</pre></td>
        </tr>
        <tr>
          <td class="column-field w-25 align-right">{{ __('general.instructions') }}</td>
          <td class="column-value w-75"><pre>{{ human_val($game->instructions)->json() }}</pre></td>
        </tr>
        <tr>
          <td class="column-field w-25 align-right">{{ __('general.dimensions') }}</td>
          <td class="column-value w-75"><pre>{{ human_val($game->dimensions)->json() }}</pre></td>
        </tr>
        <tr>
          <td class="column-field w-25 align-right">{{ __('general.age_range') }}</td>
          <td class="column-value w-75">{{ human_val($game->age_range)->str() }}</td>
        </tr>
        <tr>
          <td class="column-field w-25 align-right">{{ __('general.thumbnail') }}</td>
          <td class="column-value w-75">
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
          <td class="column-field w-25 align-right">{{ __('general.is_visible') }}</td>
          <td class="column-value w-75">{{ human_val($game->is_visible)->str() }}</td>
        </tr>
        <tr>
          <td class="column-field w-25 align-right">{{ __('general.published_at') }}</td>
          <td class="column-value w-75">{{ $game->published_at }}</td>
        </tr>
        <tr>
          <td class="column-field w-25 align-right">{{ __('general.created_at') }}</td>
          <td class="column-value w-75">{{ $game->created_at }}</td>
        </tr>
        <tr>
          <td class="column-field w-25 align-right">{{ __('general.updated_at') }}</td>
          <td class="column-value w-75">{{ $game->updated_at }}</td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="2">
            <div class="pull-xs-right">
              <a class="btn btn-primary btn-lg"
                 href="{{ action('CPanel\GameController@edit', $game->id) }}"
                 title="{{ __('general.edit') }}"
                 data-toggle="tooltip"><i class="fa fa-pencil-square"></i></a>
              <a class="btn btn-danger btn-lg"
                 href="{{ action('CPanel\GameController@destroy', $game->id) }}"
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