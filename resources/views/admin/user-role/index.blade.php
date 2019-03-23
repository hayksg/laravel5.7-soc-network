@extends('layouts-admin.master')
@section('title', "| Users")

@section('content')

<div class="blog-post mx-3">
    <h4 class="mt-3 mb-4">Users</h4>

    @if(!$users->count())
        <h5>The list is empty</h5>
    @else
        <div class="form-group">
            <label for="users-filter">Filter users:</label>
            <input type="text" class="form-control" id="users-filter">
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-striped" id="admin-users-table">
                <tr>
                    <th>#</th>
                    <th>User Name</th>
                    <th>Created at</th>
                    <th>Picture</th>
                    <th>Action</th>
                </tr>
                @foreach($users as $user)
                <tr>
                    <td>{{ ++$cnt }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                        <div class="admin-user-table-thumbnail">
                            @include('layouts.profile-pic', ['user' => $user])
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('admin.role.user.edit', ['id' => $user->id]) }}">Edit</a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    @endif
</div>

@endsection
