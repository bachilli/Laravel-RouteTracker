@extends('_layouts.cpanel')

@section('content')
    @include('cpanel.categories.partials.menu')
    <div class="card card-block">
        @include('_layouts.partials.cpanel.alerts.default')
        @include('_layouts.partials.cpanel.alerts.validator')
        <h3 class="card-title">{{ trans('categories.create') }}</h3>
        <hr>
        {!! Form::open([ 'action' => 'CPanel\CategoryController@store', 'files' => true ]) !!}
            @include('cpanel.categories.partials.form', [ 'submitButtonText' => trans('general.add'), 'isUpdate' => false ])
        {!! Form::close() !!}
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $('#thumbnail').on('change', function(e) {
            $.each(e.target.files, function(key, file) {
                var data = new FormData();

                data.append('upload', file);
                data.append('_token', $('meta[name="_token"]').attr('content'));

                $.ajax({
                    url: '{{ action('\\GSMeira\LaravelFileManager\Controllers\UploadController@index') }}',
                    type: 'POST',
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    beforeSend: function(xhr) {

                    },
                    success: function (response) {
                        // ...
                    },
                    error: function(xhr, status, error) {
                        var response = xhr.responseJSON ? xhr.responseJSON : error;

                        console.log(response);
                    }
                });
            });
        }).on('click', function() {
            this.value = null;
        });
    </script>
@endsection