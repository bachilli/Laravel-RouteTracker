@if ($isUpdate)
    <div class="form-group">
        {!! Form::label('id', trans('general.id')) !!} <span class="required-input">*</span>
        {!! Form::text('id', null, [ 'id' => 'id', 'class' => 'form-control', 'readonly', 'tabindex' => 1 ]) !!}
    </div>
@endif
<div class="row">
    <div class="col-xs-6">
        <div class="form-group">
            {!! Form::label('name', trans('general.name')) !!} <span class="required-input">*</span>
            {!! Form::text('name', null, [ 'id' => 'name', 'class' => 'form-control', 'tabindex' => 2 ]) !!}
        </div>
    </div>
    <div class="col-xs-6">
        <div class="form-group">
            {!! Form::label('slug', trans('general.slug')) !!} <span class="required-input">*</span>
            {!! Form::text('slug', null, [ 'id' => 'slug', 'class' => 'form-control', 'readonly', 'tabindex' => 3 ]) !!}
        </div>
    </div>
</div>
<div class="form-group">
    {!! Form::label('description', trans('general.description')) !!}
    {!! Form::textarea('description', null, [ 'id' => 'description', 'class' => 'form-control', 'tabindex' => 4 ]) !!}
</div>
<div class="form-group">
    {!! Form::label('thumbnail', 'Thumbnail') !!}
    <div class="form-group">
        <div data-uplab="thumbnail"
             data-uplab-trans-local="{{ trans('general.local') }}"
             data-uplab-trans-remote="{{ trans('general.remote') }}"
             data-uplab-trans-download="{{ trans('general.download') }}"
             data-uplab-value="{{ old('thumbnail') ? old('thumbnail') : ($isUpdate && ! empty($category->thumbnail) ? storage()->url($category->thumbnail->location) : '') }}"
             data-uplab-local-url="{{ action('\\GSMeira\LaravelUpLab\App\Http\Controllers\UpLabLocalController@index') }}"
             data-uplab-remote-url="{{ action('\\GSMeira\LaravelUpLab\App\Http\Controllers\UpLabRemoteController@index') }}"></div>
    </div>
</div>
<div class="form-group">
    {!! Form::submit($submitButtonText, [ 'class' => 'btn btn-lg btn-primary pull-xs-right', 'tabindex' => 5 ]) !!}
</div>