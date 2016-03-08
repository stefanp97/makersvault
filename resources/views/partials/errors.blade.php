@if (count($errors) > 0)

<div class="callout alert">
<p>
  <strong>S#!t</strong> there were some problems with your infomartion!
</p>
<ul>
  @foreach($errors->all()as $error)
  <li>{{ $error }}</li>
  @endforeach
</ul>
</div>
@endif
