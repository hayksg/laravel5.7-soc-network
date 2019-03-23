@extends('layouts-admin.master')
@section('title', "| User")

@section('content')

<div class="blog-post mx-3">
    <h4 class="mt-3 mb-4">User Info</h4>

    @if(!$user)
        <h5>User not found</h5>
    @else
        <h5>Name: <strong><em>{{ $user->name }}</em></strong></h5>
        <small>Created at: <strong><em>{{ $user->created_at }}</em></strong></small>
        
        <div class="admin-user-pic my-4">
            @include('layouts.profile-pic', ['user' => $user])
        </div>
        
        <hr>

        <p>Role: <strong><em ref="userRole">{{ $user->role }}</em></strong></p>

        <vue-change-role route="{{ route('admin.role.user.update', ['user' => $user->id]) }}"></vue-change-role>

        <hr>

        <form action="">
            <button class="btn btn-danger">Delete account</button>
        </form>
    @endif
    
</div>

@endsection
