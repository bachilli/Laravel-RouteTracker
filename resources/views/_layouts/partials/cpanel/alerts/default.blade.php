@foreach (multi_alerts()->all() as $level => $alerts)
  <div class="alert alert-{{ $level }}">
    <ul>
      @foreach ($alerts as $alert)
        <li>{!! $alert['message'] !!}</li>
      @endforeach
    </ul>
  </div>
@endforeach