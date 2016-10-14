@foreach($sourceContents->where('created_at', '>', \Carbon\Carbon::today()) as $sourceContent)
    {{ $sourceContent->id }} - {{ $sourceContent->key }} - {{ $sourceContent->type }} - {{ $sourceContent->name }} - {{ $sourceContent->created_at }}<br>
@endforeach