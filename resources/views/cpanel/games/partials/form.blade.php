@if ($isUpdate)
  <div class="form-group">
    {!! Form::label('id', trans('general.id')) !!} <span class="required-input">*</span>
    {!! Form::text('id', null, [ 'id' => 'id', 'class' => 'form-control', 'readonly', 'tabindex' => 1 ]) !!}
  </div>
@endif
<div class="form-group">
  {!! Form::label('fake_published_at', trans('general.published_at')) !!}
  {!! Form::text('fake_published_at', null, [ 'id' => 'fake_published_at', 'class' => 'form-control', 'tabindex' => 2 ]) !!}
  {!! Form::hidden('published_at', null, [ 'id' => 'published_at' ]) !!}
</div>
<div class="row">
  <div class="col-xs-12 col-md-6">
    <div class="form-group">
      {!! Form::label('name', trans('general.name')) !!} <span class="required-input">*</span>
      {!! Form::text('name', null, [ 'id' => 'name', 'class' => 'form-control', 'tabindex' => 3 ]) !!}
    </div>
  </div>
  <div class="col-xs-12 col-md-6">
    <div class="form-group">
      {!! Form::label('slug', trans('general.slug')) !!} <span class="required-input">*</span>
      {!! Form::text('slug', null, [ 'id' => 'slug', 'class' => 'form-control', 'readonly', 'tabindex' => 4 ]) !!}
    </div>
  </div>
</div>
<div class="form-group">
  {!! Form::label('excerpt', trans('general.excerpt')) !!}
  {!! Form::text('excerpt', null, [ 'id' => 'excerpt', 'class' => 'form-control', 'tabindex' => 5 ]) !!}
</div>
<div class="row">
  <div class="col-xs-12 col-md-6">
    <div class="form-group">
      {!! Form::label('description', trans('general.description')) !!}
      {!! Form::textarea('description', null, [ 'id' => 'description', 'class' => 'form-control', 'tabindex' => 6 ]) !!}
    </div>
  </div>
  <div class="col-xs-12 col-md-6">
    <div class="form-group">
      {!! Form::label('instructions', trans('general.instructions')) !!}
      {!! Form::textarea('instructions', null, [ 'id' => 'instructions', 'class' => 'form-control', 'tabindex' => 7 ]) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="col-xs-12 col-md-4">
    <div class="form-group">
      {!! Form::label('width', trans('general.width')) !!}
      {!! Form::text('width', null, [ 'id' => 'width', 'class' => 'form-control', 'tabindex' => 8 ]) !!}
    </div>
  </div>
  <div class="col-xs-12 col-md-4">
    <div class="form-group">
      {!! Form::label('height', trans('general.height')) !!}
      {!! Form::text('height', null, [ 'id' => 'height', 'class' => 'form-control', 'tabindex' => 9 ]) !!}
    </div>
  </div>
  <div class="col-xs-12 col-md-4">
    <div class="form-group">
      {!! Form::label('aspect_ratio', trans('general.aspect_ratio')) !!}
      {!! Form::text('aspect_ratio', null, [ 'id' => 'aspect_ratio', 'class' => 'form-control', 'tabindex' => 10 ]) !!}
    </div>
  </div>
</div>
<div class="form-group">
  {!! Form::label('classification', trans('general.classification'), [ 'class' => 'control-label' ]) !!}
  {!! Form::select('classification', $gameClassifications, null, [ 'id' => 'classification', 'class' => 'form-control select2', 'placeholder' => 'Selecionar...', 'tabindex' => 11 ]) !!}
</div>
<div class="form-group">
  {!! Form::label('type', trans('general.type'), [ 'class' => 'control-label' ]) !!}
  {!! Form::select('type', $gameTypes, null, [ 'id' => 'type', 'class' => 'form-control select2', 'placeholder' => 'Selecionar...', 'tabindex' => 12 ]) !!}
</div>
<div class="row">
  <div class="col-xs-12 col-md-9">
    <div class="form-group">
      {!! Form::label('embed_src', trans('general.embed_src')) !!}
      {!! Form::text('embed_src', null, [ 'id' => 'embed_src', 'class' => 'form-control', 'tabindex' => 13 ]) !!}
    </div>
  </div>
  <div class="col-xs-12 col-md-3">
    <div class="form-group">
      {!! Form::label('embed_type', trans('general.embed_type'), [ 'class' => 'control-label' ]) !!}
      {!! Form::select('embed_type', $gameEmbedTypes, null, [ 'id' => 'embed_type', 'class' => 'form-control select2', 'placeholder' => 'Selecionar...', 'tabindex' => 14 ]) !!}
    </div>
  </div>
</div>
<div class="form-group">
  {!! Form::label('file', trans('general.file')) !!}
  <div class="form-group">
    <div data-uplab="file"
         data-uplab-trans-local="{{ trans('general.local') }}"
         data-uplab-trans-remote="{{ trans('general.remote') }}"
         data-uplab-trans-download="{{ trans('general.download') }}"
         data-uplab-value="{{ old('file') ? old('file') : ($isUpdate && ! empty($game->file) ? storage()->url($game->file->location) : '') }}"
         data-uplab-local-url="{{ action('\\GSMeira\LaravelUpLab\App\Http\Controllers\UpLabLocalController@index') }}"
         data-uplab-remote-url="{{ action('\\GSMeira\LaravelUpLab\App\Http\Controllers\UpLabRemoteController@index') }}"></div>
  </div>
</div>
<div class="form-group">
  {!! Form::label('thumbnail', trans('general.thumbnail')) !!}
  <div class="form-group">
    <div data-uplab="thumbnail"
         data-uplab-trans-local="{{ trans('general.local') }}"
         data-uplab-trans-remote="{{ trans('general.remote') }}"
         data-uplab-trans-download="{{ trans('general.download') }}"
         data-uplab-value="{{ old('thumbnail') ? old('thumbnail') : ($isUpdate && ! empty($game->thumbnail) ? storage()->url($game->thumbnail->location) : '') }}"
         data-uplab-local-url="{{ action('\\GSMeira\LaravelUpLab\App\Http\Controllers\UpLabLocalController@index') }}"
         data-uplab-remote-url="{{ action('\\GSMeira\LaravelUpLab\App\Http\Controllers\UpLabRemoteController@index') }}"></div>
  </div>
</div>
<div class="form-group">
  {!! Form::label('is_published', trans('general.is_published'), [ 'class' => 'control-label' ]) !!}
  {!! Form::select('is_published', $yesOrNo, null, [ 'id' => 'is_published', 'class' => 'form-control select2', 'placeholder' => 'Selecionar...', 'tabindex' => 15 ]) !!}
</div>
<div class="form-group">
  {!! Form::submit($submitButtonText, [ 'class' => 'btn btn-lg btn-primary pull-xs-right', 'tabindex' => 16 ]) !!}
</div>