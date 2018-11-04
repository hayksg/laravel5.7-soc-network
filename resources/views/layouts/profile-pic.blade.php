@if(Auth::user()->pic == 'boy.png' || Auth::user()->pic == 'girl.png')
    <img src="{{ asset('storage/profile-images/' . Auth::user()->pic) }}" alt="{{ onlyName() }}" class="img-fluid">
@else
    <img src="{{ asset('storage/users-images/' . Auth::user()->pic) }}" alt="{{ onlyName() }}" class="img-fluid">
@endif