@extends('_layouts.cpanel')

@section('content')
    @include('cpanel.categories.partials.menu')
    <div class="card card-block">
        @include('_layouts.partials.cpanel.alerts.default')
        @include('_layouts.partials.cpanel.alerts.validator')
        <h3 class="card-title">{{ trans('categories.edit') }}</h3>
        <hr>
        {!! Form::model($category, [ 'method' => 'PATCH', 'action' => [ 'CPanel\CategoryController@update', $category->id, 'files' => true ] ]) !!}
            @include('cpanel.categories.partials.form', [ 'submitButtonText' => trans('general.update'), 'isUpdate' => true ])
        {!! Form::close() !!}
    </div>
@endsection


@section('js')
    <script type="text/javascript">
        var $thumbnail = $('#thumbnail_fake');

        $thumbnail.on('change', function(e) {
            $.each(e.target.files, function(key, file) {
                var data = new FormData();
                data.append('upload', file);
                data.append('_token', $('meta[name="_token"]').attr('content'));

                $.ajax({
                    url: '{{ action('\\GSMeira\LaravelUpLab\App\Http\Controllers\UpLabLocalController@index') }}',
                    type: 'POST',
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    beforeSend: function(xhr) {
                        // ...
                    },
                    success: function (response) {
                        if (response.success) {
                            $thumbnail.after('<input type="hidden" name="thumbnail" value="'+ response.upload.location + '">');
                            $thumbnail.after('<hr><img src="'+ response.upload.url + '" style="max-width: 255px;">');
                        }
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