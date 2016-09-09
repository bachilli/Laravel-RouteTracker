@extends('_layouts.cpanel')

@section('content')
    @include('cpanel.categories.partials.menu')
    <div class="card card-block">
        @include('_layouts.partials.cpanel.alerts.default')
        @include('_layouts.partials.cpanel.alerts.validator')
        <h3 class="card-title">{{ trans('general.categories') }}</h3>
        <hr>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="w-10 align-center">{{ trans('general.id') }}</th>
                    <th class="w-75">{{ trans('general.name') }}</th>
                    <th class="w-15 align-center">{{ trans('general.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <td class="w-10 align-center">{{ $category->id }}</td>
                        <td class="w-75">{{ $category->name }}</td>
                        <td class="w-15 align-center">
                            <a class="btn btn-secondary" href="{{ action('CPanel\CategoryController@show', $category->id) }}" data-toggle="tooltip" title="{{ trans('general.show') }}"><i class="fa fa-folder-open"></i></a>
                            <a class="btn btn-primary" href="{{ action('CPanel\CategoryController@edit', $category->id) }}" data-toggle="tooltip" title="{{ trans('general.edit') }}"><i class="fa fa-pencil-square"></i></a>
                            <a class="btn btn-danger"
                               href="{{ action('CPanel\CategoryController@destroy', $category->id) }}"
                               title="{{ trans('general.destroy') }}"
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
                               data-toggle="tooltip"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">{{ trans('categories.none_found') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="pull-xs-right">
            {{ $categories->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@endsection