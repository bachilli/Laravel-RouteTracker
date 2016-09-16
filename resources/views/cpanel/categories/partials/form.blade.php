@if ($isUpdate)
    <div class="form-group">
        {!! Form::label('id', 'ID') !!} <span class="required-input">*</span>
        {!! Form::text('id', null, [ 'id' => 'id', 'class' => 'form-control', 'readonly', 'tabindex' => 1 ]) !!}
    </div>
@endif
<div class="row">
    <div class="col-xs-6">
        <div class="form-group">
            {!! Form::label('name', 'Nome') !!} <span class="required-input">*</span>
            {!! Form::text('name', null, [ 'id' => 'name', 'class' => 'form-control', 'tabindex' => 2 ]) !!}
        </div>
    </div>
    <div class="col-xs-6">
        <div class="form-group">
            {!! Form::label('slug', 'Slug') !!} <span class="required-input">*</span>
            {!! Form::text('slug', null, [ 'id' => 'slug', 'class' => 'form-control', 'readonly', 'tabindex' => 3 ]) !!}
        </div>
    </div>
</div>
<div class="form-group">
    {!! Form::label('description', 'Descrição') !!}
    {!! Form::textarea('description', null, [ 'id' => 'description', 'class' => 'form-control', 'tabindex' => 4 ]) !!}
</div>
<div class="form-group">
    {!! Form::label('thumbnail_fake', 'Miniatura') !!}
    {!! Form::file('thumbnail_fake', [ 'id' => 'thumbnail_fake', 'class' => 'form-control', 'tabindex' => 5 ]) !!}
</div>
<div class="form-group">
    {!! Form::submit($submitButtonText, [ 'class' => 'btn btn-lg btn-primary pull-xs-right', 'tabindex' => 6 ]) !!}
</div>