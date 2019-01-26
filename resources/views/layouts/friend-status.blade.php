@if (Auth::user()->hasFriendRequestPending($user))
    <div class="text-warning">Waiting for {{ $user->name }} to accept your request.</div>
@elseif (Auth::user()->hasFriendRequestReceived($user))
    <div><a href="{{ route('friends.accept', ['user' => $user]) }}" class="btn btn-warning btn-sm">Accept friend request</a></div>
@elseif (Auth::user()->isFriendsWith($user))
    @if ($delete)
        <form action="{{ route('friends.delete', ['user' => $user]) }}" method="post" class="confirm-plugin-delete">
            @csrf
            <button type="submit" class="btn btn-danger btn-sm">Remove from friend`s list</button>
        </form>
    @else
        <div class="text-success">You and {{ $user->name }} are friends.</div>
    @endif
@elseif (Auth::user()->id !== $user->id)
    <div><a href="{{ route('friends.add', ['user' => $user]) }}" class="btn btn-primary btn-sm">Add as friend</a></div>
@endif