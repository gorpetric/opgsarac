@if($errors->count())
    <ul style='color: red'>
    @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
    </ul>
@endif
