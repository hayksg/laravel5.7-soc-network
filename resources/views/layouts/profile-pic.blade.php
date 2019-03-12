@if($user->pic == 'boy.png' || $user->pic == 'girl.png')
    <img src="{{ asset('storage/profile-images/' . $user->pic) }}" alt="{{ onlyName($user->name) }}" class="img-fluid">
@else
    <img src="{{ asset('storage/users-images/' . $user->pic) }}" alt="{{ onlyName($user->name) }}" class="img-fluid">
@endif