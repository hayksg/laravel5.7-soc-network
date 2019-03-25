@extends('layouts-admin.master')
@section('title', "| Admin")

@section('content')

<div class="blog-post mx-3">
    <h4 class="mt-3 mb-4">Admin Info</h4>

    @if(!$admin)
        <h5>Admin not found</h5>
    @else
        <h5>Name: <strong><em>{{ $admin->name }}</em></strong></h5>
        <small>Created at: <strong><em>{{ $admin->created_at }}</em></strong></small>
        
        <div class="admin-user-pic my-4">
            @include('layouts.profile-pic', ['user' => $admin])
        </div>
        
        <hr>

        <p>Role: <strong><em ref="userRole">{{ $admin->role }}</em></strong></p>

        <vue-change-role route="{{ route('admin.role.admin.update', ['user' => $admin->id]) }}"></vue-change-role>

        <hr>

        <form
            action="{{ route('admin.role.user.delete', ['id' => $admin->id]) }}" 
            method="post" 
            onsubmit="return confirm('Are you sure?')"
        >
            @csrf
            <button class="btn btn-danger">Delete account</button>
        </form>
    @endif
    
</div>

@endsection
