@if ($errors->any())
    <div class="alert alert-danger">
        <p>Ops...ocorreu um erro no formulário!</p>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{!! $error !!}</li>
            @endforeach
        </ul>
    </div>
@endif